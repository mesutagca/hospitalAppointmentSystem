<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Patient extends Model
{
    use HasFactory;
    use Filterable;

    /**
     * Get the user associated with the patient.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointment associated with the patient.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }


}
