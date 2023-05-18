<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductoMultimedia extends Model
{

    protected $table = 'producto_multimedia';

    protected $fillable = ['producto_id', 'tipo', 'archivo', 'estado', 'exclusivo', 'usureg', 'usumod', 'padre', 'extension', 'titulo', 'descripcion', 'orden', 'originalname'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('producto_multimedia as p');

        $select->where('producto_id', $params['id']);

        if (array_key_exists('tipo', $params)) {
            $select->where('tipo', $params['tipo']);
        }

        $select->orderByRaw('p.created_at desc');

        return $select->get();
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('producto_multimedia as p');

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
            $delete = DB::table('producto_multimedia')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
