<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

abstract class ServiceAbstract
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll() : ?Collection {
        return $this->model->all();
    }

    /**
     * 
     * @param array $data
     * 
     * @return Model $model
     * @throws Exception
    */
    public function store(array $data){
        try{
            DB::beginTransaction();
            $model = $this->model->create($data);  
            DB::commit();
            return $model;
        }catch(QueryException $e){
            DB::rollBack();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function get($id) : ?Model {
        return $this->model->find($id);
    }

    public function update(array $data, int $id){
        try{
            DB::beginTransaction();
            $model = $this->model->find($id);
            $model = $model->update($data);
            $model = $this->model->find($id);
            DB::commit();
            return $model;
        }catch(QueryException $e){
            DB::rollBack();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function delete(int $id) {
        try{
            DB::beginTransaction();
            $model = $this->model->destroy($id);
            DB::commit();
            return $model;
        }catch(QueryException $e){
            DB::rollBack();
        }
    }

    abstract public static function getModel() : Model;
}
