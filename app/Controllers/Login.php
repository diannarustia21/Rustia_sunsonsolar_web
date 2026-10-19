<?php

namespace App\Controllers;

use App\Models\UserModels;

class Main extends BaseController
{
    public function index()
    {
        return view('Main')
    }

    public function register()
    {
        $UserModel = new UserModel();

        $data = [
            'FirstName'      => $this->request->getPost('Fname'),
            'LastName'       => $this->request->getPost('Lname'),
            'MiddleName'     => $this->request->getPost('Mname'),    
            'BirthDate'      => $this->request->getPost('Bday'),
            'Gender'         => $this->request->getPost('Gender'),
            'PhoneNumber'    => $this->request->getPost('PhNo'),
            'EmailAddress'   => $this->request->getPost('EmAdd'),
            'Address'        => $this->request->getPost('Addrs'),
            'Departments'    => $this->request->getPost('Departments'),
            'Username'       => $this->request->getPost('Uname'),
            'Password'       => $this->request->getPost('Pwd'),

        ];

        $UserModel->insert($data);

        return 'Registration successful';
    }

    public function Logincon()
    {
        return view('Loginhome')
    }

    public function login()
    {
        $username = $this->request->getPost('Uname'),
        $password = $this->request->getPost('Pwd'),

        $userModel = new UserModel();
        $user = $userModel->where('Username', $username)->first()

        if ($user && password_verify($password, $user['Password'])) {
            return 'Login successfull';
        } else {
            return 'Invalid username or password.';
        }


    }
}