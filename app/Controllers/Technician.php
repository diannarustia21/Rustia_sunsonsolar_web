<?php

namespace App\Controllers;

use App\Models\{
    BookingModel,
    AnnouncementModel,
    ServiceReportModel
};

class Technician extends BaseController
{
    private function ok()
    {
        return session('logged_in') && session('role') === 'Technician';
    }

    public function dashboard()
    {
        if (! $this->ok()) {
            return redirect()->to('/?page=login');
        }

        $db = db_connect();

        return view('technician/Dashboard', [
            'jobs' => $db->table('bookings b')
                ->select('b.*,u.Firstname,u.Lastname,u.Address,s.name service_name')
                ->join('users u', 'u.ID=b.customer_id')
                ->join('services s', 's.ID=b.service_id')
                ->where('b.technician_id', session('user_id'))
                ->orderBy('b.ID', 'DESC')
                ->get()
                ->getResultArray(),
            'announcements' => (new AnnouncementModel())
                ->groupStart()
                ->where('audience', 'All')
                ->orWhere('audience', 'Technician')
                ->groupEnd()
                ->orderBy('ID', 'DESC')
                ->findAll()
        ]);
    }

    public function checkIn($id)
    {
        if (! $this->ok()) {
            return $this->response->setStatusCode(403)->setJSON(['message' => 'Technician login required.']);
        }

        $m = new BookingModel();
        $b = $m->find($id);

        if (! $b || $b['technician_id'] != session('user_id')) {
            return $this->response->setStatusCode(403)->setJSON(['message' => 'This job is not assigned to you.']);
        }

        $m->update($id, [
            'checkin_time' => date('Y-m-d H:i:s'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'status' => 'In Progress'
        ]);

        return $this->response->setJSON(['message' => 'Check-in recorded with your name, time, and coordinates.']);
    }

    public function submitReport($id)
    {
        if (! $this->ok()) {
            return redirect()->to('/');
        }

        (new ServiceReportModel())->insert([
            'booking_id' => $id,
            'technician_id' => session('user_id'),
            'problem' => $this->request->getPost('problem'),
            'action_taken' => $this->request->getPost('action_taken'),
            'status' => 'Submitted'
        ]);

        return redirect()->to('/technician')->with('message', 'Service report submitted to admin.');
    }
}
