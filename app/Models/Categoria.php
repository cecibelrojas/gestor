<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{

    protected $table = 'categoria';

    protected $fillable = ['nombre', 'padre', 'descripcion', 'estado', 'orden', 'usureg', 'usumod'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('categoria as c');

        $select->orderByRaw('c.padre,c.orden');

        return $select->get();
    }

    function obtenerhijos(array $params = array())
    {
        $select = DB::select("SELECT id,nombre,padre FROM ( SELECT * FROM categoria) categorias,
        (SELECT @pv := ?) init
        WHERE find_in_set(padre, @pv) AND length(@pv := concat(@pv, ',', id))", array($params['id']));
        return $select;
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('categoria as c');

        $select->where($params);

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
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('categoria as c')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
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
            $delete = DB::table('categoria')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
