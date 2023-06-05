<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ajustes extends Model
{
    protected $table = 'ajustes';

    protected $fillable = ['id','img1', 'img2', 'img3', 'feed', 'ubicacion','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('ajustes as a')
            ->select('a.*');

        $select->orderByRaw('a.id');

        return $select->get();
    }

    public function listar_feed(array $params = array())
    {

        $select = $this->from('ajustes as a')
            ->selectRaw("(select name from users as u where u.id = a.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = a.usumod) as editor")
            ->selectRaw('a.*');

        $select->orderByRaw('a.id');

        return $select->get();
    }    

    public function obtener(array $params = array())
    {

        $select = $this->from('ajustes as a')
            ->select('a.*');

        if (array_key_exists('id', $params)) {
            $select->where('a.id', $params['id']);
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
            $delete = DB::table('ajustes')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('ajustes as a')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
