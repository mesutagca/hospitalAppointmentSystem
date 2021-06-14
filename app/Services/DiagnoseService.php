<?php


namespace App\Services;


use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Filters\Diagnose\DiagnoseListFilters;
use App\Http\Requests\Diagnose\DiagnoseListRequest;
use App\Http\Requests\Diagnose\DiagnoseStoreRequest;
use App\Models\Diagnose;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use App\Services\Contracts\DiagnoseServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;


class DiagnoseService implements DiagnoseServiceContract
{
    private DiagnoseRepositoryContract $diagnoseRepository;

    public function __construct(DiagnoseRepositoryContract $diagnoseRepository)
    {
        $this->diagnoseRepository=$diagnoseRepository;
    }

    public function list(DiagnoseListRequest $request)
    {    /** @var DiagnoseListFilters $diagnoseFilter */
        $diagnoseFilter = app(DiagnoseListFilters::class);
        $diagnoseFilter->setFilters($request->all());

        $this->diagnoseRepository->parseRequest($request->all());
        $this->diagnoseRepository
            ->with([
                //'relations',
              ])->withFilters($diagnoseFilter);

        return $this->diagnoseRepository->getAll(['*']);
    }

    public function show(Request $request, int $diagnoseId): ?Model
    {
        $this->diagnoseRepository->parseRequest($request->all());
        $this->diagnoseRepository->with(['folders','folders.appointment']);

        return $this->diagnoseRepository->getById($diagnoseId);
    }

    /**
     * @param DiagnoseStoreRequest $request
     * @return Model|null
     * @throws Throwable
     */
    public function store(DiagnoseStoreRequest $request): ?Model
    {
        //check if already exists
        /** @var DiagnoseListFilters $diagnoseFilter */
        $diagnoseFilter = app(DiagnoseListFilters::class);
        $diagnoseFilter->setFilters(['name' => $request->input('name')]);

        /** @var ?Diagnose $diagnose */
        $diagnose = $this->diagnoseRepository
            ->withFilters($diagnoseFilter)
            ->withTrashed()
            ->getAll(['*'])->first();

        if ($diagnose) {

            if ($diagnose->trashed()) {
                $diagnose->restore();
                return $diagnose;
            }
            abort(
                prepareCustomResponse(
                    ExceptionMessages::DIAGNOSE_ALREADY_EXISTS,
                    409,
                    ResponseCodes::DIAGNOSE_ALREADY_EXISTS
                )
            );
        }
        return $this->diagnoseRepository->create($request->validated());
    }

    /**
     * @param DiagnoseStoreRequest $request
     * @param Diagnose $diagnose
     * @return Model|null
     * @throws Throwable
     */
    public function update(DiagnoseStoreRequest $request, Diagnose $diagnose): ?Model
    {
        return $this->diagnoseRepository->update($diagnose, $request->validated());
    }

    public function delete(?Model $diagnose): ?bool
    {
        return $this->diagnoseRepository->delete($diagnose);
    }



}
