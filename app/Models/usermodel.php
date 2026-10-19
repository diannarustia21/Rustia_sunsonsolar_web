<?php

namespace App\Models;

use CodeIgniter\Models;

class UserModel extends Models
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields =  [
        'FirstName'     
        'LastName'      
        'MiddleName'       
        'BirthDate'      
        'Gender'       
        'PhoneNumber'   
        'EmailAddress'   
        'Address'        
        'Departments'    
        'Username'       
        'Password'    
    ];
}