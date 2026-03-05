<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerRegistration extends Model
{
    protected $fillable = [
        'company_name', 'contact_person', 'phone', 'email',
        'address', 'city', 'products_interested', 'message',
        'status', 'admin_notes',
    ];
}
