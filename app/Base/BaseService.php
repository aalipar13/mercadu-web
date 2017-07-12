<?php namespace App\Base;


/**
 * Base class for Services
 *
 * Class BaseService
 * @package App\Base
 */
abstract class BaseService
{
    /**
     * @var ResourceRepository
     */
    protected $repository;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->repository = $this->repository();
    }

    /**
     * Specify Repository class
     *
     * @return Model
     */
    public function repository()
    {
        return new BaseRepository();
    }

    public function resetScope()
    {
        $this->repository->resetScope();
    }
}