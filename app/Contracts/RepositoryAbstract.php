<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Instantiate a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = $this->modelUse();
    }

    public function createRecord(array $data)
    {
        return $this->model::create($data);
    }

    public function findRecord($id)
    {
        return $this->model::find($id);
    }

    public function updateRecord(int $id,array $data)
    {
        $product_c = $this->findRecord($id);
        $product_c->fill($data);
        return $product_c->save();
    }

    public function RestoreRecord(int $id)
    {
        return $this->model::withTrashed()->where('id', $id)->restore();
    }

    abstract public function modelUse();
}
