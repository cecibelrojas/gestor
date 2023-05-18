<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionDet extends Model
{
    protected $table = 'programacion_det';

    protected $fillable = ['id', 'item', 'team', 'descripcion', 'usureg', 'usumod', 'casa', 'resultado'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('programacion_det as p')
            ->select('p.*')
            ->selectRaw("(select nombre2 from team as t where t.id = p.team) as nombreteam")
            ->selectRaw("(select logo from team as t where t.id = p.team) as logo")
            ->selectRaw("(select name from users as u where u.id = p.usumod) as editor");


        if (array_key_exists('id', $params)) {
            $select->where('p.id', $params['id']);
        }

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('programacion_det as p')
            ->select('p.*')
            ->selectRaw("(select nombre from team as t where t.id = p.team) as nombreteam")
            ->selectRaw("(select abreviatura from team as t where t.id = p.team) as abreviatura")
            ->selectRaw("(select logo from team as t where t.id = p.team) as logo")
            ->selectRaw("(select name from users as u where u.id = p.usumod) as editor");


        if (array_key_exists('id', $params)) {
            $select->where('p.id', $params['id']);
        }

        if (array_key_exists('casa', $params)) {
            $select->where('p.casa', $params['casa']);
        }

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
            //DB::rollBack();
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    public function obtenerItem($id)
    {
        $select = $this->from('programacion_det as t')
            ->where('id', $id)
            ->selectRaw('MAX(item) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }

    public function actualizar(array $params, array $where)
    {
        try {
            $this::where($where)
                ->update($params);
        } catch (\Exception $e) {
            die($e->getMessage());
            return $e->getMessage();
        }
    }

    public function eliminar(array $params)
    {
        try {
            $delete = DB::table('programacion_det')->where(array('id' => $params['id'], 'item' => $params['item']))->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
