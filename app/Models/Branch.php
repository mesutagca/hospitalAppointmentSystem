<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    protected $fillable=['name'];

    /**
     * Get the doctor associated with the Branch.
     */
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
