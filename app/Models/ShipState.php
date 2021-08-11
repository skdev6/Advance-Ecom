<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
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
}
