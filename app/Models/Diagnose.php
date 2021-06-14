<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Diagnose extends Model
{
    use HasFactory, SoftDeletes ;
    use Filterable;

    protected $fillable=['name'];

    /**
     * Get the doctor associated with the Branch.
     */
    public function folders(): hasMany
    {
       return $this->hasMany(Folder::class);
    }
}
