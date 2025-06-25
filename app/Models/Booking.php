<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'terrain_id', 'renter_id', 'start_date',
        'end_date', 'total_price', 'status'
    ];

    public function terrain()
    {
        return $this->belongsTo(Terrain::class);
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
