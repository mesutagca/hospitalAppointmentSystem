<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }

    public function medicineCompany()
    {
        return $this->belongsTo(MedicineCompany::class);
    }
}
