<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servicios_turismo extends Model
{
    protected $table = 'servicios_turismo';

    protected $fillable = ['id','icono','nombre_servicio','nombre_servicio_ingles','tipo','estado','papelera','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('servicios_turismo as s')
            ->select('s.*','b.nombre')
            ->leftJoin('banco_datos_det as b', 'b.item', 's.tipo')
             ->orderBy('id', 'DESC');

        $select->orderByRaw('s.id');

        if (array_key_exists('papelera', $params)) {
            $select->where('s.papelera', '=','P');
        }
        
        return $select->get();
    }

   
    public function obtener(array $params = array())
    {

        $select = $this->from('servicios_turismo as s')
            ->select('s.*');

        if (array_key_exists('id', $params)) {
            $select->where('s.id', $params['id']);
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
            $delete = DB::table('servicios_turismo')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('servicios_turismo as s')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
