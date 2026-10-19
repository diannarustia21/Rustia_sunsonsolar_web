<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'description', 'price', 'is_active'];
}
