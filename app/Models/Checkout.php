<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'camp_id',
        'discount_id',
        'discount_percentage',
        'total',
        'payment_status',
        'midtrans_url',
        'midtrans_booking_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
