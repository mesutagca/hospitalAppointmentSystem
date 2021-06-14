<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    protected $fillable=[ 'doctor_id', 'patient_id', 'appointment_time'];

//    protected $casts=[
//        'appointment_time'=>'datetime:d/m/Y H:i:s'
//    ];

    /**
     * Get the doctor associated with the appointment.
     *
     * @return BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the patient associated with the appointment.
     *
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function folder(): HasOne
    {
      return   $this->hasOne(Folder::class);
    }
}
