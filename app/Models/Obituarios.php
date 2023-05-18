<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Obituarios extends Model
{
    protected $table = 'obituarios';

    protected $fillable = ['id','titulo',  'foto_aviso', 'estado', 'fecha','usureg','created_at','usumod','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('obituarios as a')
            ->selectRaw("(select name from users as u where u.id = a.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = a.usumod) as editor")
            ->selectRaw('a.*')
            ->orderBy('a.id', 'desc');


        $select->orderByRaw('a.titulo');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('obituarios as a')
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
            $delete = DB::table('obituarios')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('obituarios as a')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
