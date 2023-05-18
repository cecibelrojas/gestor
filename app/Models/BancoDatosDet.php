<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BancoDatosDet extends Model
{
    protected $table = 'banco_datos_det';

    protected $fillable = ['id', 'item', 'nombre', 'created_at', 'updated_at', 'usureg', 'usumod'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('banco_datos_det as d')
            ->select('d.*');

        if (array_key_exists('id', $params)) {
            $select->where('d.id', $params['id']);
        }

        $select->orderByRaw('d.nombre');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('banco_datos_det as d')
            ->select('d.*');

        if (array_key_exists('id', $params)) {
            $select->where('d.id', $params['id']);
        }

        if (array_key_exists('item', $params)) {
            $select->where('d.item', $params['item']);
        }
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
            die($e->getMessage());
            //DB::rollBack();
            return $e->getMessage();
        }
    }

    public function actualizar(array $params, array $where)
    {
        try {
            $this::where($where)
                ->update($params);
            return $where['id'];
        } catch (\Exception $e) {
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    public function eliminar(array $params)
    {
        try {
            $delete = DB::table('banco_datos_det')->where($params)->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
