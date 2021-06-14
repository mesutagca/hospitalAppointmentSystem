<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['treatment'];

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class);
    }

}
