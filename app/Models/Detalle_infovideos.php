<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detalle_infovideos extends Model
{
    protected $table = 'detalle_infovideos';

    protected $fillable = ['id','subservicio_id','tapa','video','titulo','titulo_ingles','descripcion','descripcion_ingles','estado','tipo','link','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('detalle_infovideos as d')
        ->selectRaw("(select name from users as u where u.id = d.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = d.usumod) as editor")
         ->selectRaw('d.*');

        $select->where('subservicio_id', $params['id']); 

        $select->orderByRaw('d.created_at desc');
        //dd($select);
        return $select->get();
    }
    public function obtener(array $params = array())
    {

        $select = $this->from('detalle_infovideos as d');

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
            $delete = DB::table('detalle_infovideos')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
