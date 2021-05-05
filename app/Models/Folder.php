<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['appointment'];

    public function appointment()
    {
       return $this->belongsTo(Appointment::class);
    }

    public function diagnose()
    {
       return $this->hasOne(Diagnose::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function patientDocuments(): HasMany
    {
        return $this->hasMany(PatientDocument::class);
    }
}
