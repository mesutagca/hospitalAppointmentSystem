<?php


namespace App\Services\Contracts;


use App\Http\Requests\Diagnose\DiagnoseListRequest;
use App\Http\Requests\Diagnose\DiagnoseStoreRequest;
use App\Models\Diagnose;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface DiagnoseServiceContract
{
    public function list(DiagnoseListRequest $request);

    public function show(Request $request, int $diagnoseId): ?Model;

    public function store(DiagnoseStoreRequest $request): ?Model;

    public function update(DiagnoseStoreRequest $request, Diagnose $branch): ?Model;

    public function delete(?Model $diagnose): ?bool;
}
