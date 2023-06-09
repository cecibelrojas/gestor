<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empleos extends Model
{
    protected $table = 'empleos';

    protected $fillable = ['id','canciller_id','empresa','detalle','cargo','fecha_inicio', 'fecha_fin','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];
    public function listar(array $params = array())
    {

        $select = $this->from('empleos as e')
        ->selectRaw("(select name from users as u where u.id = e.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = e.usumod) as editor")
         ->selectRaw('e.*');
         
        $select->where('canciller_id', $params['id']);

        $select->orderByRaw('e.created_at desc');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('empleos as e');

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
            $delete = DB::table('empleos')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
