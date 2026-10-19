<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'support_tickets';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['customer_id', 'subject', 'message', 'status', 'admin_reply'];
}
