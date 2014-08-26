<?php namespace GenSend\Repositories;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentRepository
 * @package GenSend\Repositories
 */
abstract class EloquentRepository {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $entity;

    /**
     * @param Model $entity
     */
    function __construct(Model $entity)
    {
        $this->entity = $entity;
    }
}