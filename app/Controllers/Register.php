<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function create()
    {
        $rules = [
            'Fname' => 'required|min_length[2]',
            'Lname' => 'required|min_length[2]',
            'Bday' => 'required',
            'Gender' => 'required',
            'PhNo' => 'required|regex_match[/^[0-9]{11}$/]',
            'EmAdd' => 'required|valid_email|is_unique[users.Email]',
            'Addrs' => 'required',
            'Uname' => 'required|min_length[4]|is_unique[users.Username]',
            'Pwd' => 'required|min_length[8]',
            'CPwd' => 'required|matches[Pwd]',
            'Terms' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/?page=registration')->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'Firstname' => trim($this->request->getPost('Fname')),
            'Lastname' => trim($this->request->getPost('Lname')),
            'Middlename' => trim((string) $this->request->getPost('Mname')),
            'Birthdate' => $this->request->getPost('Bday'),
            'Gender' => $this->request->getPost('Gender'),
            'Phonenumber' => $this->request->getPost('PhNo'),
            'Email' => strtolower(trim($this->request->getPost('EmAdd'))),
            'Address' => trim($this->request->getPost('Addrs')),
            'Departments' => null,
            'Username' => trim($this->request->getPost('Uname')),
            'Password' => password_hash($this->request->getPost('Pwd'), PASSWORD_DEFAULT),
            'Role' => 'Customer',
            'Status' => 'Active'
        ]);

        return redirect()->to('/?page=login')->with('message', 'Account created. Please log in.');
    }
}
