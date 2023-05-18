<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Waika extends Model
{
    protected $table = 'waika';

    protected $fillable = ['id', 'imagen_waika', 'usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {


        $select = $this->from('waika as w')
            ->selectRaw("(select name from users as u where u.id = w.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = w.usumod) as editor")
            ->selectRaw('w.*')
            ->orderBy('w.id', 'desc');


        $select->orderByRaw('w.id');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('waika as w')
            ->select('w.*');

        if (array_key_exists('id', $params)) {
            $select->where('w.id', $params['id']);
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
            $delete = DB::table('waika')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('waika as w')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
