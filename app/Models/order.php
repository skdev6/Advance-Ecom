<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function division()
    {
        return $this->belongsTo(ShipDev::class, 'division_id');
    }
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id');
    }
    public function state()
    {
        return $this->belongsTo(ShipState::class, 'state_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}