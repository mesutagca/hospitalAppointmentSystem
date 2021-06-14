<?php


namespace App\Services\Contracts;


use App\Http\Requests\Treatment\TreatmentListRequest;
use App\Http\Requests\Treatment\TreatmentStoreRequest;
use App\Models\Folder;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface TreatmentserviceContract
{
    public function treatPatient(TreatmentStoreRequest $request, Folder $folder): ?Model;

    public function downloadRecipeMedicines(TreatmentListRequest $request, Treatment $treatment, $recipe_id);

    public function deleteRecipeMedicines(Request $request,Treatment $treatment, $recipe_id);

}
