<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    protected $table = 'team';

    protected $fillable = ['id', 'nombre', 'entidad', 'usureg', 'usumod', 'created_at', 'updated_at', 'estado', 'logo', 'abreviatura', 'sede', 'ciudad'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('team as t')
            ->select('t.*')
            ->selectRaw("(select nombre from banco_datos_det as bd where bd.id = '002' and bd.item = t.entidad) as entidaddes");

        if (array_key_exists('entidad', $params)) {
            $select->where('t.entidad', $params['entidad']);
        }

        $select->orderByRaw('t.nombre');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('team as t')
            ->select('t.*');

        if (array_key_exists('id', $params)) {
            $select->where('t.id', $params['id']);
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
            //DB::rollBack();
            return $e->getMessage();
        }
    }

    public function actualizar(array $params, array $where)
    {
        try {
            $this::where('id', $where['id'])
                ->update($params);
            return $where['id'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function eliminar(array $params)
    {
        try {
            $delete = DB::table('team')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('team as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
