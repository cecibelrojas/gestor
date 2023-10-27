<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ubicacion_geoestrategica extends Model
{
    protected $table = 'ubicacion_geoestrategica';

    protected $fillable = ['id', 'titulo','titulo_ingles','direccion','direccion_ingles','jurisdiccion','jurisdiccion_ingles','horario','telefono','estado','usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('ubicacion_geoestrategica as ca')
            ->select('ca.*');

        $select->orderByRaw('ca.id');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('ubicacion_geoestrategica as ca')
            ->select('ca.*');

        if (array_key_exists('id', $params)) {
            $select->where('ca.id', $params['id']);
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
            $delete = DB::table('ubicacion_geoestrategica')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('ubicacion_geoestrategica as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
