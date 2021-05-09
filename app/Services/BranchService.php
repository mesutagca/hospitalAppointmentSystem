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
    {
        /** @var BranchListFilters $branchFilter */
        $branchFilter = app(BranchListFilters::class);
        $branchFilter->setFilters($request->all());

        //checks if with_trashed or sorting or some other params
        $this->branchRepository->parseRequest($request->all());

        $this->branchRepository
            ->with([
                //
            ])   ;
          //sıkıntılı  ->withFilters($branchFilter);

        return $this->branchRepository->getAll(['*']);
    }

    public function show(Request $request, int $branchId): ?Model
    {
        $this->branchRepository->parseRequest($request->all());
        $this->branchRepository
            ->with(['features']);

        return json_encode($this->branchRepository->getById($branchId));
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
           // ->withFilters($branchFilter)
          // ->withTrashed()
            ->getAll(['*'])->first();

        if (!$branch) {
            $this->branchRepository->transaction(function () use ($request, &$branch) {
                /** @var ?Branch $branch */
                $branch =  $this->branchRepository->create($request->validated());

                if ($branch->name != $request->input('name')) {
                    abort(
                        prepareCustomResponse(
                            ExceptionMessages::BRANCH_ALREADY_EXISTS,
                            409,
                            ResponseCodes::BRANCH_ALREADY_EXISTS
                        )
                    );
                }

                if ($branch->trashed()) {
                    $branch->restore();
                }

                return $this->branchRepository->update($branch, ['re-active' => true]);
            });
        }
        return $branch;

    }

    /**
     * @param BranchStoreRequest $request
     * @param Branch $branch
     * @return Model|null
     * @throws Throwable
     */
    public function update(BranchStoreRequest $request, Branch $branch): ?Model
    {
        $this->branchRepository->transaction(function () use ($request, &$branch) {
            /** @var  Branch $branch*/
            $branch = $this->branchRepository->update($branch, $request->validated());
        });

        return $branch;
    }

    public function delete(?Model $branch): ?bool
    {
        return $this->branchRepository->delete($branch);
    }
}
