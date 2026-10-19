<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'message', 'audience', 'created_by'];
}
