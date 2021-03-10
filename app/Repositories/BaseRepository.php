<?php
namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function GetModel();

    public function find($id)
    {
        return $this->GetModel()->find($id);
    }

    public function GetAll()
    {
        return $this->GetModel()->all();
    }

    public function GetStatus($status)
    {
        return $this->GetModel()->where('status', $status)->get();
    }

    public function create($request)
    {
        return $this->GetModel()->create($request);
    }
    public function update($object, $data)
    {
        $object->fill($data);
        $object->save();
        return $object;
    }
    public function destroy($object)
    {
        $object->delete();
    }
}
