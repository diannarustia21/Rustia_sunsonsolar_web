<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function authenticate()
    {
        $user = (new UserModel())
            ->where('Username', trim((string) $this->request->getPost('Uname')))
            ->where('Status', 'Active')
            ->first();

        if (! $user || ! password_verify((string) $this->request->getPost('Pwd'), $user['Password'])) {
            return redirect()->to('/?page=login')->with('error', 'Invalid username or password.');
        }

        session()->regenerate();
        session()->set([
            'user_id' => $user['ID'],
            'name' => $user['Firstname'] . ' ' . $user['Lastname'],
            'role' => $user['Role'],
            'logged_in' => true
        ]);

        return redirect()->to(match ($user['Role']) {
            'Customer' => '/customer',
            'Technician' => '/technician',
            default => '/admin'
        });
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
