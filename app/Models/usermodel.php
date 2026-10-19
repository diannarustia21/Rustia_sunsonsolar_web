<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['Firstname', 'Lastname', 'Middlename', 'Birthdate', 'Gender', 'Phonenumber', 'Email', 'Address', 'Departments', 'Username', 'Password', 'Role', 'Status'];
}
