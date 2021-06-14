<?php


namespace App\Services;


use App\Filters\Doctor\DoctorListFilters;
use App\Http\Requests\Doctor\DoctorListRequest;
use App\Http\Requests\Doctor\DoctorStoreRequest;
use App\Models\Doctor;
use App\Repositories\Contracts\DoctorRepositoryContract;
use App\Services\Contracts\DoctorServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;

class DoctorService implements DoctorServiceContract
{
    private DoctorRepositoryContract $doctorRepository;

    public function __construct(DoctorRepositoryContract $doctorRepository)
    {
        $this->doctorRepository=$doctorRepository;
    }

    public function list(DoctorListRequest $request)
    {
        /** @var DoctorListFilters $doctorFilter */
        $doctorFilter = app(DoctorListFilters::class);
        $doctorFilter->setFilters($request->all());

        $this->doctorRepository->parseRequest($request->all());
        $this->doctorRepository
            ->with([
                'user','branch', 'appointments','doctorDocuments'
            ])->withFilters($doctorFilter);

        return $this->doctorRepository->getAll(['*']);
    }

    public function show(Request $request, int $doctorId): ?Model
    {
        $this->doctorRepository->parseRequest($request->all());
        $this->doctorRepository->with(['user','branch', 'appointments','doctorDocuments']);

        return $this->doctorRepository->getById($doctorId);
    }

    public function store(DoctorStoreRequest $request): ?Model
    {
        // TODO: Implement store() method.
    }

    public function update(DoctorStoreRequest $request, Doctor $doctor): ?Model
    {
        // TODO: Implement update() method.
    }

    public function delete(?Model $doctor): ?bool
    {
        // TODO: Implement delete() method.
    }
}
