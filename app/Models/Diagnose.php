<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    public function folder()
    {
       return $this->belongsTo(Folder::class);
    }
}
