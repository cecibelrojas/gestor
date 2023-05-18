<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BancoDatos extends Model
{
    protected $table = 'banco_datos';

    protected $fillable = ['id', 'nombre', 'descripcion', 'usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('banco_datos as d')
            ->select('d.*');

        $select->orderByRaw('d.nombre');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('banco_datos as d')
            ->select('d.*');

        if (array_key_exists('id', $params)) {
            $select->where('d.id', $params['id']);
        }

        return $select->first();
    }


    public function insertar(array $params)
    {

        try {
            DB::beginTransaction();

            $params['id'] = $this->obtenerId();

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
            $delete = DB::table('banco_datos')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('banco_datos as d')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        $ultimo = $data ? $data['ultimo'] + 1 : 1;

        return str_pad($ultimo, 3, '0', STR_PAD_LEFT);
    }
}
