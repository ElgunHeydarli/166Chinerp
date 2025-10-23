<?php

namespace App\Services;


class MainService
{
    protected $model;

    public function getFirstOfData()
    {
        return $this->model::first();
    }

    public function createOrUpdate(array $data)
    {
        $model = $this->getFirstOfData();
        if (is_null($model)) {
            $model = $this->create($data);
            $model->addTranslation($data);
        } else {
            $model = $this->update($model->id, $data);
            $model->updateTranslation($data);
        }
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function getAll()
    {
        return $this->model::orderBy('created_at', 'desc')->get();
    }

    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $model = $this->getById($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id)
    {
        $this->model::destroy($id);
    }

    public function paginate($limit, $sortBy = 'sort', $dir = 'asc')
    {
        return $this->model::orderBy($sortBy, $dir)->paginate($limit);
    }
}
