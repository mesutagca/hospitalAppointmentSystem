<?php


namespace App\Services;


use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Filters\Medicine\MedicinelistFilters;
use App\Http\Requests\Medicine\MedicineListRequest;
use App\Http\Requests\Medicine\MedicineStoreRequest;
use App\Models\Medicine;
use App\Repositories\Contracts\MedicineRepositoryContract;
use App\Services\Contracts\MedicineServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;

class MedicineService implements MedicineServiceContract
{
    private MedicineRepositoryContract $medicineRepository;

    public function __construct(MedicineRepositoryContract $medicineRepository)
    {
        $this->medicineRepository=$medicineRepository;
    }

    public function list(MedicineListRequest $request)
    {
        /** @var MedicinelistFilters $medicineFilter */
        $medicineFilter= app(MedicinelistFilters::class);
        $medicineFilter->setFilters($request->all());

        $this->medicineRepository->parseRequest($request->all());
        $this->medicineRepository
            ->with(['medicineCompany'])->withFilters($medicineFilter);

        return $this->medicineRepository->getAll(['*']);
    }

    public function show(Request $request, int $medicineId): ?Model
    {

        $this->medicineRepository->parseRequest($request->all());
        $this->medicineRepository
            ->with(['medicineCompany']);

        return $this->medicineRepository->getById($medicineId);
    }

    /**
     * @param MedicineStoreRequest $request
     * @return Model|null
     * @throws Throwable
     */
    public function store(MedicineStoreRequest $request): ?Model
    {
        //check if already exists
        /** @var MedicineListFilters $medicineFilter */
        $medicineFilter = app(MedicineListFilters::class);
        $medicineFilter->setFilters(['name' => $request->input('name')]);

        /** @var ?Medicine $medicine */
        $medicine = $this->medicineRepository
            ->withFilters($medicineFilter)
            ->withTrashed()
            ->getAll(['*'])->first();

        if ($medicine) {

            if ($medicine->trashed()) {
                $medicine->restore();
                return $medicine;
            }
            abort(
                prepareCustomResponse(
                    ExceptionMessages::MEDICINE_ALREADY_EXISTS,
                    409,
                    ResponseCodes::MEDICINE_ALREADY_EXISTS
                )
            );
        }
        return $this->medicineRepository->create($request->validated());
    }

    /**
     * @param MedicineStoreRequest $request
     * @param Medicine $medicine
     * @return Model|null
     * @throws Throwable
     */
    public function update(MedicineStoreRequest $request, Medicine $medicine): ?Model
    {
       return $this->medicineRepository->update($medicine,$request->validated());
    }

    public function delete(?Model $medicine): ?bool
    {
       return $this->medicineRepository->delete($medicine);

    }
}
