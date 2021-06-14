<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Treatment extends Model
{
    use HasFactory;
    use Filterable;

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function recipe(): HasOne
    {
        return $this->hasOne(Recipe::class);
    }
}
