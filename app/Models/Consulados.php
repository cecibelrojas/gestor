<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consulados extends Model
{

    protected $table = 'consulados';

    protected $fillable = ['pais', 'consul', 'concurren', 'direccion', 'telefono','web','correo','twitter','instagram','facebook','imagen','lat','lng','usureg', 'usumod'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('consulados as e')
            ->selectRaw("(select name from users as u where u.id = e.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = e.usumod) as editor")
            ->selectRaw('e.*')
            ->orderBy('e.id', 'desc');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('consulados as e');

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
        $select = $this->from('consulados as e')
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
            $delete = DB::table('consulados')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
