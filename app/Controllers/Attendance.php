<?php

namespace App\Controllers;

use App\Models\AttendanceModel;

class Attendance extends BaseController
{
    public function timeIn()
    {
        if (! session()->get('logged_in') || session()->get('role') !== 'Employee') {
            return $this->response->setStatusCode(403)->setJSON(['message' => 'Employee login required.']);
        }
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');
        if (! is_numeric($latitude) || ! is_numeric($longitude)) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'Valid location coordinates are required.']);
        }
        (new AttendanceModel())->insert([
            'user_id' => session()->get('user_id'),
            'time_in' => date('Y-m-d H:i:s'),
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
        return $this->response->setJSON([
            'employeeName' => session()->get('name'),
            'date' => date('m/d/Y'),
            'time' => date('h:i:s A'),
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
