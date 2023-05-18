<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Galerias extends Model
{

    protected $table = 'galerias';

    protected $fillable = ['titulo', 'foto', 'categoria','autor','descripcion', 'usureg', 'usumod'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {


        $select = $this->from('galerias as g')
            ->select('g.*', 'c.nombre as categoriades')
            ->selectRaw("(select name from users as u where u.id = g.usureg) as creador")
            ->join('categoria_galerias as c', 'c.id', 'g.categoria')
            ->orderBy('g.id', 'desc');

        if (array_key_exists('categoria', $params)) {
            $select->where('g.categoria', $params['categoria']);
        }
        $select->orderByRaw('g.titulo');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('galerias as g');

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
        $select = $this->from('galerias as g')
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
            $delete = DB::table('galerias')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
