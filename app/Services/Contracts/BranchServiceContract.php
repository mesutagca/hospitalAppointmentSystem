<?php


namespace App\Services\Contracts;

use App\Http\Requests\Branch\BranchListRequest;
use App\Http\Requests\Branch\BranchStoreRequest;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BranchServiceContract
{
    public function list(BranchListRequest $request);

    public function show(Request $request, int $branchId): ?Model;

    public function store(BranchStoreRequest $request): ?Model;

    public function update(BranchStoreRequest $request, Branch $branch): ?Model;

    public function delete(?Model $branch): ?bool;
}
