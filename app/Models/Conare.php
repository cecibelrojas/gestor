<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conare extends Model
{
    protected $table = 'conare';

    protected $fillable = ['id', 'banner_principal','titulo_principal','titulo_principal_ingles','subtitulo','subtitulo_ingles','descripcion','descripcion_ingles','titulo_des','titulo_des_ingles','descripcion_ubicacion','descripcion_ubicacion_ingles','imagen','parallax','titulo_pllx','titulo_pllx_ingles','des_pllx','des_pllx_ingles','usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('conare as ca')
            ->select('ca.*');

        $select->orderByRaw('ca.id');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('conare as ca')
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
            $delete = DB::table('conare')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('conare as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
