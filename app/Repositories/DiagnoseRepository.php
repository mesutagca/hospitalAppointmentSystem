<?php


namespace App\Repositories;


use App\Models\Diagnose;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class DiagnoseRepository extends BaseEloquentRepository implements DiagnoseRepositoryContract
{
    /**
     * @var Model|Builder
     */
    protected $model=Diagnose::class;

}
