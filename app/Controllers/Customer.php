<?php

namespace App\Controllers;

use App\Models\{
    UserModel,
    BookingModel,
    NotificationModel,
    TicketModel,
    PaymentModel,
    ServiceModel
};

class Customer extends BaseController
{
    private function ok()
    {
        return session('logged_in') && session('role') === 'Customer';
    }

    public function dashboard()
    {
        if (! $this->ok()) {
            return redirect()->to('/?page=login');
        }

        $id = session('user_id');

        return view('customer/Dashboard', [
            'user' => (new UserModel())->find($id),
            'bookings' => (new BookingModel())->where('customer_id', $id)->orderBy('ID', 'DESC')->findAll(),
            'notifications' => (new NotificationModel())->where('user_id', $id)->orderBy('ID', 'DESC')->findAll(),
            'tickets' => (new TicketModel())->where('customer_id', $id)->orderBy('ID', 'DESC')->findAll(),
            'payments' => (new PaymentModel())->where('customer_id', $id)->orderBy('ID', 'DESC')->findAll(),
            'services' => (new ServiceModel())->where('is_active', 1)->findAll()
        ]);
    }

    public function createBooking()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new BookingModel())->insert([
            'customer_id' => session('user_id'),
            'service_id' => $this->request->getPost('service_id'),
            'preferred_date' => $this->request->getPost('preferred_date'),
            'address' => $this->request->getPost('address'),
            'notes' => $this->request->getPost('notes'),
            'status' => 'Pending'
        ]);

        return redirect()->to('/customer')->with('message', 'Service request submitted.');
    }

    public function cancelBooking($id)
    {
        $m = new BookingModel();
        $b = $m->find($id);

        if ($this->ok() && $b && $b['customer_id'] == session('user_id') && $b['status'] === 'Pending') {
            $m->update($id, ['status' => 'Cancelled']);
        }

        return redirect()->to('/customer');
    }

    public function updateProfile()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new UserModel())->update(session('user_id'), [
            'Firstname' => $this->request->getPost('Firstname'),
            'Lastname' => $this->request->getPost('Lastname'),
            'Phonenumber' => $this->request->getPost('Phonenumber'),
            'Address' => $this->request->getPost('Address')
        ]);

        return redirect()->to('/customer')->with('message', 'Profile updated.');
    }

    public function changePassword()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        $m = new UserModel();
        $u = $m->find(session('user_id'));

        if (! password_verify($this->request->getPost('current_password'), $u['Password'])) {
            return redirect()->to('/customer')->with('error', 'Current password is incorrect.');
        }

        if (strlen($this->request->getPost('new_password')) < 8) {
            return redirect()->to('/customer')->with('error', 'New password must have at least 8 characters.');
        }

        $m->update($u['ID'], [
            'Password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/customer')->with('message', 'Password changed.');
    }

    public function createTicket()
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new TicketModel())->insert([
            'customer_id' => session('user_id'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'status' => 'Open'
        ]);

        return redirect()->to('/customer')->with('message', 'Support ticket submitted.');
    }
}
