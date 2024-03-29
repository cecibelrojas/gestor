<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Casa_amarilla extends Model
{
    protected $table = 'casa_amarilla';

    protected $fillable = ['id', 'banner_principal','titulo','titulo_ingles','titulo2','titulo2_ingles','contenido1','contenido1_ingles','titulo3','contenido2','titulo3_ingles','contenido2_ingles','titulo4','titulo4_ingles','contenido3','contenido3_ingles','item1','item2','item3','item4','item5','item6','item1_ingles','item2_ingles','item3_ingles','item4_ingles','item5_ingles','item6_ingles','img1','estado','parallax1','parallax2','titulo_pllx1','titulo_pllx1_ingles','titulo_pllx2','titulo_pllx2_ingles','contenido_pllx2','contenido_pllx2_ingles','direccion','direccion_ingles','correo1','correo2','correo3','horario','horario_ingles','usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('casa_amarilla as ca')
            ->select('ca.*');

        $select->orderByRaw('ca.id');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('casa_amarilla as ca')
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
            $delete = DB::table('casa_amarilla')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('casa_amarilla as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
