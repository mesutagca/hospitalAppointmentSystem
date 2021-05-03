<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
