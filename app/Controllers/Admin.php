<?php

namespace App\Controllers;

use App\Models\{
    UserModel,
    BookingModel,
    NotificationModel,
    ServiceModel,
    AnnouncementModel,
    TicketModel,
    PaymentModel,
    ServiceReportModel
};

class Admin extends BaseController
{
    private function ok()
    {
        return session('logged_in') && in_array(session('role'), ['Admin', 'HR', 'Dispatcher'], true);
    }

    public function dashboard()
    {
        if (! $this->ok()) {
            return redirect()->to('/?page=login');
        }

        $db = db_connect();

        return view('admin/Dashboard', [
            'users' => (new UserModel())->orderBy('ID', 'DESC')->findAll(),
            'bookings' => $db->table('bookings b')
                ->select('b.*,u.Firstname,u.Lastname,s.name service_name,t.Firstname tech_first,t.Lastname tech_last')
                ->join('users u', 'u.ID=b.customer_id')
                ->join('services s', 's.ID=b.service_id')
                ->join('users t', 't.ID=b.technician_id', 'left')
                ->orderBy('b.ID', 'DESC')
                ->get()
                ->getResultArray(),
            'technicians' => (new UserModel())->where('Role', 'Technician')->where('Status', 'Active')->findAll(),
            'tickets' => (new TicketModel())->orderBy('ID', 'DESC')->findAll(),
            'reports' => (new ServiceReportModel())->orderBy('ID', 'DESC')->findAll(),
            'services' => (new ServiceModel())->orderBy('ID', 'DESC')->findAll(),
            'stats' => [
                'customers' => $db->table('users')->where('Role', 'Customer')->countAllResults(),
                'employees' => $db->table('users')->whereIn('Role', ['Admin', 'HR', 'Dispatcher', 'Technician'])->countAllResults(),
                'bookings' => $db->table('bookings')->countAllResults(),
                'revenue' => (float) ($db->table('payments')->selectSum('amount')->where('status', 'Paid')->get()->getRow('amount') ?? 0)
            ]
        ]);
    }

    public function createEmployee()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new UserModel())->insert([
            'Firstname' => $this->request->getPost('Firstname'),
            'Lastname' => $this->request->getPost('Lastname'),
            'Middlename' => $this->request->getPost('Middlename'),
            'Birthdate' => $this->request->getPost('Birthdate'),
            'Gender' => $this->request->getPost('Gender'),
            'Phonenumber' => $this->request->getPost('Phonenumber'),
            'Email' => $this->request->getPost('Email'),
            'Address' => $this->request->getPost('Address'),
            'Departments' => $this->request->getPost('Departments'),
            'Username' => $this->request->getPost('Username'),
            'Password' => password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT),
            'Role' => $this->request->getPost('Role'),
            'Status' => 'Active'
        ]);

        return redirect()->to('/admin')->with('message', 'Employee account created.');
    }

    public function changeStatus($id)
    {
        if ($this->ok()) {
            (new UserModel())->update($id, ['Status' => $this->request->getPost('Status')]);
        }

        return redirect()->to('/admin');
    }

    public function updateBooking($id)
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        $m = new BookingModel();
        $m->update($id, [
            'status' => $this->request->getPost('status'),
            'technician_id' => $this->request->getPost('technician_id') ?: null,
            'admin_notes' => $this->request->getPost('admin_notes')
        ]);
        $b = $m->find($id);

        (new NotificationModel())->insert([
            'user_id' => $b['customer_id'],
            'title' => 'Schedule update',
            'message' => 'Your service request is now ' . $b['status'] . '.',
            'type' => 'Schedule'
        ]);

        return redirect()->to('/admin');
    }

    public function sendNotification()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        $m = new NotificationModel();
        $aud = $this->request->getPost('audience');
        $users = (new UserModel())->when($aud !== 'All', fn ($q) => $q->where('Role', $aud))->findAll();

        foreach ($users as $u) {
            $m->insert([
                'user_id' => $u['ID'],
                'title' => $this->request->getPost('title'),
                'message' => $this->request->getPost('message'),
                'type' => $this->request->getPost('type')
            ]);
        }

        return redirect()->to('/admin')->with('message', 'Notification sent.');
    }

    public function saveService()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new ServiceModel())->save([
            'ID' => $this->request->getPost('ID') ?: null,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('/admin')->with('message', 'Service settings saved.');
    }

    public function postAnnouncement()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new AnnouncementModel())->insert([
            'title' => $this->request->getPost('title'),
            'message' => $this->request->getPost('message'),
            'audience' => $this->request->getPost('audience'),
            'created_by' => session('user_id')
        ]);

        return redirect()->to('/admin')->with('message', 'Announcement posted.');
    }
}
