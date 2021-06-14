<?php

namespace App\Models;

use App\Filters\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Medicine extends Model
{
    use HasFactory, SoftDeletes;
    use Filterable;

    protected $fillable=['name','medicine_company_id','active_ingredient','barcode'];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function medicineCompany(): BelongsTo
    {
        return $this->belongsTo(MedicineCompany::class);
    }
}
