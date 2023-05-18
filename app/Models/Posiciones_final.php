<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Posiciones_final extends Model
{
    protected $table = 'posiciones_final';

    protected $fillable = ['id', 'id_team', 'jj', 'jg', 'jp','jv','created_at', 'updated_at', 'usureg','usumod'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('posiciones_final as p')
            ->select('p.*')
            ->selectRaw("(select nombre2 from team as t where t.id = p.id_team) as nombreteam")
            ->selectRaw("(select logo from team as t where t.id = p.id_team) as logo")
            ->selectRaw("(select name from users as u where u.id = p.usumod) as editor");

        if (array_key_exists('periodo', $params)) {
            $select->where('p.periodo', $params['periodo']);
        }
        
        if (array_key_exists('estado', $params)) {
            $select->where('p.estado', $params['estado']);
        }

        $select->orderByRaw('p.id');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('posiciones_final as p')
            ->select('p.*');

        if (array_key_exists('id', $params)) {
            $select->where('p.id', $params['id']);
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
            $delete = DB::table('posiciones_final')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('posiciones_final as p')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
