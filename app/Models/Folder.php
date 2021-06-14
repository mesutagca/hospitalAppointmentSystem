<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    protected $fillable=[
        'disease_detail'
    ];

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

    public function diagnose(): BelongsTo
    {
       return $this->belongsTo(Diagnose::class);
    }

    public function treatment(): HasOne
    {
        return $this->hasOne(Treatment::class);
    }

    public function patientDocuments(): HasMany
    {
        return $this->hasMany(PatientDocument::class);
    }
}
