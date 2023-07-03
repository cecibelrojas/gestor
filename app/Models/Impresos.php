<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Impresos extends Model
{
    protected $table = 'impresos';

    protected $fillable = ['id', 'titulo', 'url', 'foto_impreso','estado','tipo','foto_portada_libro','descripcion_especulador','usureg', 'usumod', 'created_at', 'updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*');

        $select->orderByRaw('i.titulo');

        return $select->get();
    }

    public function listar_campanas(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*')
            ->where('tipo','=', 'A');

        $select->orderByRaw('i.titulo');

        return $select->get();
    }
    public function listar_libros(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*')
            ->where('tipo','=', 'B');

        $select->orderByRaw('i.titulo');

        return $select->get();
    }
    public function listar_biblioteca(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*')
            ->where('tipo','=', 'D');

        $select->orderByRaw('i.titulo');

        return $select->get();
    }
    public function listar_tratados(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*')
            ->where('tipo','=', 'C');

        $select->orderByRaw('i.titulo');

        return $select->get();
    }

    public function obtener(array $params = array())
    {

        $select = $this->from('impresos as i')
            ->select('i.*');

        if (array_key_exists('id', $params)) {
            $select->where('i.id', $params['id']);
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
            $delete = DB::table('impresos')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerId()
    {
        $select = $this->from('impresos as i')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }
}
