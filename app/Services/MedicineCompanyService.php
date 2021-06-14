<?php


namespace App\Services;


use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Filters\MedicineCompany\MedicineCompanyListFilters;
use App\Http\Requests\MedicineCompany\MedicineCompanyListRequest;
use App\Http\Requests\MedicineCompany\MedicineCompanyStoreRequest;
use App\Models\MedicineCompany;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use App\Services\Contracts\MedicineCompanyServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MedicineCompanyService implements MedicineCompanyServiceContract
{
    private MedicineCompanyRepositoryContract $medicineCompanyRepository;

    public function __construct(MedicineCompanyRepositoryContract $medicineCompanyRepository)
    {
        $this->medicineCompanyRepository=$medicineCompanyRepository;
    }

    public function list(MedicineCompanyListRequest $request)
    {
        /** @var MedicineCompanyListFilters $medCompFilter */
       $medCompFilter= app(MedicineCompanyListFilters::class);
       $medCompFilter->setFilters($request->all());

        $this->medicineCompanyRepository->parseRequest($request->all());
        $this->medicineCompanyRepository
            ->with([
                //'relations',
            ])->withFilters($medCompFilter);

        return $this->medicineCompanyRepository->getAll(['*']);

    }

    public function show(Request $request, int $medicineCompanyId): ?Model
    {
        $this->medicineCompanyRepository->parseRequest($request->all());
        $this->medicineCompanyRepository->with(['medicine']);

        return $this->medicineCompanyRepository->getById($medicineCompanyId);
    }

    public function store(MedicineCompanyStoreRequest $request): ?Model
    {
        //check if already exists
        /** @var MedicineCompanyListFilters $medicineCompanyFilter */
        $medicineCompanyFilter = app(MedicineCompanyListFilters::class);
        $medicineCompanyFilter->setFilters(['name' => $request->input('name')]);

        /** @var ?MedicineCompany $medicineCompany */
        $medicineCompany = $this->medicineCompanyRepository
            ->withFilters($medicineCompanyFilter)
            ->withTrashed()
            ->getAll(['*'])->first();

        if ($medicineCompany) {

            if ($medicineCompany->trashed()) {
                $medicineCompany->restore();
                return $medicineCompany;
            }
            abort(
                prepareCustomResponse(
                    ExceptionMessages::MEDICINE_COMPANY_ALREADY_EXISTS,
                    409,
                    ResponseCodes::MEDICINE_COMPANY_ALREADY_EXISTS
                )
            );
        }
        return $this->medicineCompanyRepository->create($request->validated());
    }

    public function update(MedicineCompanyStoreRequest $request, MedicineCompany $medicineCompany): ?Model
    {
       return $this->medicineCompanyRepository->update($medicineCompany,$request->validated());
    }

    public function delete(?Model $medicineCompany): ?bool
    {
       return $this->medicineCompanyRepository->delete($medicineCompany);
    }
}
