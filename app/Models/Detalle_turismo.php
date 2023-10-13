<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detalle_turismo extends Model
{
    protected $table = 'detalle_turismo';

    protected $fillable = ['id','turismo_id','imagen_principal','descripcion','descripcion_ingles','sumario','sumario_ingles','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('detalle_turismo as s')
        ->selectRaw("(select name from users as u where u.id = s.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = s.usumod) as editor")
         ->selectRaw('s.*');

        $select->where('turismo_id', $params['id']);
        $select->orderByRaw('s.created_at desc');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('detalle_turismo as s');

        $select->where($params);

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
            DB::rollBack();
            die($e->getMessage());
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
            $delete = DB::table('detalle_turismo')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
