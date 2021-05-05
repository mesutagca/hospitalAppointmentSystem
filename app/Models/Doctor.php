<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doctor extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Doctor.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch associated with the doctor.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the doctorDocuments associated with the doctor.
     */
    public function doctorDocument(): HasMany
    {
        return $this->hasMany(DoctorDocument::class);
    }

    /**
     * Get the appointment associated with the doctor.
     */
    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
