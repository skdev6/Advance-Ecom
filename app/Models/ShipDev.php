<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDev extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function districts()
    {
        return $this->hasMany(ShipDistrict::class, 'division_id', 'id');
    }
}
