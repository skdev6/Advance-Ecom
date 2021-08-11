<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistrict extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function division()
    {
        return $this->belongsTo(ShipDev::class, 'division_id');
    }
    public function States()
    {
        return $this->hasMany(ShipState::class, 'district_id', 'id');
    }
}
