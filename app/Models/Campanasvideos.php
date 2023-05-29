<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campanasvideos extends Model
{
    protected $table = 'campanasvideos';

    protected $fillable = ['id', 'img_video','url_video', 'titulo' , 'estado','usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {


        $select = $this->from('campanasvideos as c')
            ->selectRaw("(select name from users as u where u.id = c.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = c.usumod) as editor")
            ->selectRaw('c.*')
            ->orderBy('c.id', 'desc');


        $select->orderByRaw('c.id');

        return $select->get();
    }



    public function obtener(array $params = array())
    {

        $select = $this->from('campanasvideos as c')
            ->select('c.*');

        if (array_key_exists('id', $params)) {
            $select->where('c.id', $params['id']);
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
            $delete = DB::table('campanasvideos')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('campanasvideos as c')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
