<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'title', 'message', 'type', 'is_read'];
}
