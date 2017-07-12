<?php namespace App\Base;


use Illuminate\Support\Collection;

use Infrastructure\Repositories\Repository;


/**
 * Base class for Services
 *
 * Class BaseService
 * @package App\Base
 */
class BaseRepository extends Repository
{

    /**
     * BaseRepository Constructor
     */
    public function __construct()
    {
        parent::__construct(app(), new Collection());
    }

    /**
     * @return mixed
     */
    public function model()
    {
        return BaseModel::class;
    }
}