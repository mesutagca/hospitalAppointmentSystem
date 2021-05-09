<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Branch extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    /**
     * Get the doctor associated with the Branch.
     */
    public function doctor(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
