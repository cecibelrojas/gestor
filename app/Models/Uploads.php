<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Uploads extends Model
{
    protected $table = 'medios';

    protected $fillable = ['id','tipo', 'archivo', 'estado', 'exclusivo', 'usureg', 'usumod', 'padre', 'extension', 'titulo', 'descripcion', 'orden', 'originalname', 'usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('medios as t')
            ->select('t.*');

        if (array_key_exists('tipo', $params)) {
            $select->where('tipo', $params['tipo']);
        }

        $select->orderByRaw('t.id');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('medios as t')
            ->select('t.*');

        if (array_key_exists('id', $params)) {
            $select->where('t.id', $params['id']);
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
            $delete = DB::table('medios')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('medios as t')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
