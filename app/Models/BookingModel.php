<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['customer_id', 'service_id', 'preferred_date', 'address', 'notes', 'status', 'technician_id', 'admin_notes', 'checkin_time', 'latitude', 'longitude'];
}
