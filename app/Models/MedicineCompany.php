<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicineCompany extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    protected $fillable = ['name','address'];

    public function medicine(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
