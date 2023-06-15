<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Programacion extends Model
{
    protected $table = 'programacion';

    protected $fillable = ['titulo', 'fecha', 'descripcion', 'estado', 'lugar', 'sede', 'usureg', 'usumod', 'entidad'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('programacion as p')
            ->select('p.*');

        if (array_key_exists('entidad', $params)) {
            $select->where('p.entidad', $params['entidad']);
        }

        if (array_key_exists('fecha', $params)) {
            $select->where('p.fecha', $params['fecha']);
        }
        $select->orderByRaw('p.fecha desc');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('programacion as p')
            ->select('p.*');

        if (array_key_exists('entidad', $params)) {
            $select->where('p.entidad', $params['entidad']);
        }

        if (array_key_exists('fecha', $params)) {
            $select->where('p.fecha', $params['fecha']);
        }

        if (array_key_exists('id', $params)) {
            $select->where('p.id', $params['id']);
        }

        $select->orderByRaw('p.fecha desc');

        return $select->first();
    }

    public function insertar(array $params)
    {

        try {
            DB::beginTransaction();
            $this->fill($params);
            $this->push();

            DB::commit();
            return $this->id;
        } catch (\Exception $e) {
            //DB::rollBack();
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('programacion as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }


    public function actualizar(array $params, array $where)
    {
        try {
            $this::where($where)
                ->update($params);
        } catch (\Exception $e) {
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    public function eliminar(array $params)
    {
        try {
            $delete = DB::table('programacion')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
