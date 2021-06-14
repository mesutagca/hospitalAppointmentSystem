<?php


namespace App\Services;


use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Filters\Branch\BranchListFilters;
use App\Http\Requests\Branch\BranchListRequest;
use App\Http\Requests\Branch\BranchStoreRequest;
use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryContract;
use App\Services\Contracts\BranchServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Throwable;

class BranchService implements BranchServiceContract
{
    private BranchRepositoryContract $branchRepository;

    public function __construct(BranchRepositoryContract $branchRepository)
    {
        $this->branchRepository=$branchRepository;
    }

    public function list(BranchListRequest $request)
    {    /** @var BranchListFilters $branchFilter */
        $branchFilter = app(BranchListFilters::class);
        $branchFilter->setFilters($request->all());

        $this->branchRepository->parseRequest($request->all());
        $this->branchRepository
            ->with([
            //'relations',
        ])->withFilters($branchFilter);

        return $this->branchRepository->getAll(['*']);
    }

    public function show(Request $request, int $branchId): ?Model
    {
        $this->branchRepository->parseRequest($request->all());
        $this->branchRepository->with(['doctors','doctors.user']);

        return $this->branchRepository->getById($branchId);
    }

    /**
     * @param BranchStoreRequest $request
     * @return Model|null
     * @throws Throwable
     */
    public function store(BranchStoreRequest $request): ?Model
    {
        //check if already exists
        /** @var BranchListFilters $branchFilter */
        $branchFilter = app(BranchListFilters::class);
        $branchFilter->setFilters(['name' => $request->input('name')]);

        /** @var ?Branch $branch */
        $branch = $this->branchRepository
            ->withFilters($branchFilter)
            ->withTrashed()
            ->getAll(['*'])->first();

        if ($branch) {

            if ($branch->trashed()) {
                 $branch->restore();
                 return $branch;
            }
            abort(
                prepareCustomResponse(
                    ExceptionMessages::BRANCH_ALREADY_EXISTS,
                    409,
                    ResponseCodes::BRANCH_ALREADY_EXISTS
                )
            );
        }
        return $this->branchRepository->create($request->validated());
    }

    /**
     * @param BranchStoreRequest $request
     * @param Branch $branch
     * @return Model|null
     * @throws Throwable
     */
    public function update(BranchStoreRequest $request, Branch $branch): ?Model
    {
       return $this->branchRepository->update($branch, $request->validated());
    }

    public function delete(?Model $branch): ?bool
    {
        return $this->branchRepository->delete($branch);
    }
}
