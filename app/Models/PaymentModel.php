<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['customer_id', 'booking_id', 'amount', 'status', 'receipt_number', 'paid_at'];
}
