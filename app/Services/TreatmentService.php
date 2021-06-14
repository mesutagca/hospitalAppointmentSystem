<?php


namespace App\Services;


use App\Filters\Treatment\TreatmentListFilters;
use App\Http\Requests\Treatment\TreatmentListRequest;
use App\Http\Requests\Treatment\TreatmentStoreRequest;
use App\Models\Folder;
use App\Models\Medicine;
use App\Models\Recipe;
use App\Models\Treatment;
use App\Repositories\Contracts\TreatmentRepositoryContract;
use App\Services\Contracts\TreatmentserviceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\Null_;

class TreatmentService implements TreatmentserviceContract
{
    private TreatmentRepositoryContract $treatmentRepository;

    public function __construct(TreatmentRepositoryContract $treatmentRepository)
    {
        $this->treatmentRepository = $treatmentRepository;
    }

    public function show(Request $request, int $treatmentId): ?Model
    {
        $this->treatmentRepository->parseRequest($request->all());
        $this->treatmentRepository->with([
            'recipe', 'recipe.medicines', 'recipe.medicines.medicineCompany'
        ]);
        $treatment = $this->treatmentRepository->getById($treatmentId);

        return $treatment->load(['recipe', 'recipe.medicines', 'recipe.medicines.medicineCompany']);
    }

    public function list(TreatmentListRequest $request)
    {
        /** @var TreatmentListFilters $treatmentFilter */
        $treatmentFilter = app(TreatmentListFilters::class);
        $treatmentFilter->setFilters($request->all());

        $this->treatmentRepository->parseRequest($request->all());
        $this->treatmentRepository
            ->with([
                'folder', 'folder.patientDocuments', 'recipe', 'recipe.medicines', 'recipe.medicines.medicineCompany'
            ])->withFilters($treatmentFilter);

        return $this->treatmentRepository->getAll(['*']);
    }

    public function treatPatient(TreatmentStoreRequest $request, Folder $folder): ?Model
    {
        /** @var Treatment|null $treatment */
        $treatment = null;

        $this->treatmentRepository->transaction(function () use ($request, &$folder) {


            /** @var Treatment $treatment */
            $treatment = $folder->treatment()->create();

            /** @var Recipe $recipe */
            $recipe = $treatment->recipe()->create();
            $recipe->medicines()->syncWithoutDetaching([$request->medicine_id]);

        });
        return $treatment;
    }

    public function updateTreatPatient(TreatmentStoreRequest $request, Folder $folder): ?Model
    {
        /** @var Treatment|null $treatment */
        $treatment = null;

        $this->treatmentRepository->transaction(function () use ($request, &$folder) {


            /** @var Treatment $treatment */
            $treatment = $folder->treatment();

            /** @var Recipe $recipe */
            $recipe = $treatment->recipe();
            $recipe->medicines()->syncWithoutDetaching([$request->medicine_id]);

        });
        return $treatment;
    }

    public function downloadRecipeMedicines(TreatmentListRequest $request, Treatment $treatment, $recipe_id)
    {
        /** @var Recipe $recipe */
        $recipe = $treatment->recipe()->find($recipe_id);
        return $medicines = $recipe->medicines;
    }

    public function deleteRecipeMedicines(Request $request,Treatment $treatment, $recipe_id)
    {
        /** @var Recipe|null $recipe */
        $recipe=null;

        $this->treatmentRepository->transaction(function () use ($recipe_id, $treatment, $request, &$recipe) {


            /** @var Recipe $recipe */
            $recipe = $treatment->recipe()->find($recipe_id);

            foreach ($recipe->medicines() as $medicine){
                $medicine->delete();
            }

          return $this->treatmentRepository->delete($recipe);
        });
return $recipe;
    }


}
