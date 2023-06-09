<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Idiomas extends Model
{
    protected $table = 'idiomas';

    protected $fillable = ['id','canciller_id','idioma','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];
    public function listar(array $params = array())
    {

        $select = $this->from('idiomas as i')
        ->selectRaw("(select name from users as u where u.id = i.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = i.usumod) as editor")
         ->selectRaw('i.*');
         
        $select->where('canciller_id', $params['id']);

        $select->orderByRaw('i.created_at desc');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('idiomas as i');

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
            $delete = DB::table('idiomas')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
