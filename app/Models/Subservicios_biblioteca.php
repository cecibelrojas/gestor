<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subservicios_biblioteca extends Model
{
    protected $table = 'subservicios_biblioteca';

    protected $fillable = ['id','servicio_id','nombre_subservicio','nombre_subservicio_ingles','icono','estado','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('subservicios_biblioteca as s')
        ->selectRaw("(select name from users as u where u.id = s.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = s.usumod) as editor")
         ->selectRaw('s.*');

        $select->where('servicio_id', $params['id']);

        $select->orderByRaw('s.created_at desc');

        return $select->get();
    }
    public function obtener(array $params = array())
    {

        $select = $this->from('subservicios_biblioteca as s');

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
            $delete = DB::table('subservicios_biblioteca')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
