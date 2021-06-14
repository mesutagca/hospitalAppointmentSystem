<?php


namespace App\Repositories;


use App\Models\Diagnose;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\DiagnoseRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class DiagnoseRepository extends BaseEloquentRepository implements DiagnoseRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model=Diagnose::class;

    protected array $relationships = [ 'folders', 'folders.appointment' ];
}
