<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productolog extends Model
{

    protected $table = 'producto_log';

    protected $fillable = ['id_log','usuario_id','producto','fecha','nombre', 'descripcion', 'estado', 'precio', 'categoria', 'usureg', 'usumod', 'precio_ant', 'extra', 'extradesc', 'moneda', 'imgdestacado', 'preview', 'trailer', 'etiquetas', 'sumario', 'estdestacado', 'id_parroquia', 'fotovisible', 'fecini', 'fecfin','programable','created_at','updated_at'];

    protected $hidden = [
        '_token'
    ];

public function listar(array $params = array())
    {
        $select = $this->from('producto_log as p')
            ->select('p.*', 'c.nombre as categoriades')
            ->selectRaw("(select name from users as u where u.id = p.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = p.trabajando) as escritor")
            ->join('categoria as c', 'c.id', 'p.categoria')
            ->orderBy('p.id_log', 'desc');

        if (array_key_exists('nombre', $params)) {
            $select->where('p.nombre', 'like', '%' . $params['nombre'] . '%');
        }

        if (array_key_exists('categoria', $params)) {
            $select->where('p.categoria', $params['categoria']);
        }
        if (array_key_exists('producto', $params)) {
            $select->where('p.producto', $params['producto']);
        }
        if (array_key_exists('usuario_id', $params)) {
            $select->where('p.usuario_id', $params['usuario_id']);
        }

        if (array_key_exists('papelera', $params)) {
            $select->where('p.papelera', '=','P');
        }

        return $select->get();
    }

    public function listar_trabajador(array $params = array())
    {
        $select = $this->from('producto_log as p')
            ->select('p.id_log','p.nombre', 'u.rol', 'p.created_at', 'p.estado', 'c.nombre as categoriades')
            ->selectRaw("(select name from users as u where u.id = p.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = p.trabajando) as escritor")
            ->join('categoria as c', 'c.id', 'p.categoria')
            ->join('users as u', 'u.id', 'p.usureg')
            ->orderBy('p.created_at', 'desc');

        if (array_key_exists('nombre', $params)) {
            $select->where('p.nombre', 'like', '%' . $params['nombre'] . '%');
        }

        if (array_key_exists('categoria', $params)) {
            $select->where('p.categoria', $params['categoria']);
        }
        if (array_key_exists('created_at', $params)) {
            $select->where('p.created_at', $params['created_at']);
        }
        if (array_key_exists('rol', $params)) {
            $select->where('u.rol', '=','C');
        }
        if (array_key_exists('limite', $params)) {
            if (!empty($params['limite'])) {
                $select->limit($params['limite']);
            }
        }

        if (array_key_exists('paginate', $params)) {
            return  $select->paginate($params['paginate']);
        } else {
            return $select->get();
        }
    }


    public function obtener(array $params = array())
    {

        $select = $this->from('producto_log as p')
            ->select('*')
            ->selectRaw("(select name from users as u where u.id = p.usureg) as creador")
            ->selectRaw("(select name from users as u where u.id = p.trabajando) as escritor")
            ->selectRaw("(select name from users as u where u.id = p.usumod) as editor");

        $select->where($params);

        return $select->first();
    }


    public function insertar(array $params)
    {

        try {
            DB::beginTransaction();
            $params['id_log'] = $this->obtenerId();
            $this->fill($params);
            $this->push();

            DB::commit();
            return $this->id_log;
        } catch (\Exception $e) {
            //DB::rollBack();
            die($e->getMessage());
            return $e->getMessage();
        }
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

    public function obtenerId()
    {
        $select = $this->from('producto_log as a')
            ->selectRaw('MAX(id_log) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }

    public function eliminar(array $params)
    {
        try {
            $delete = DB::table('producto_log')->where('id_log', $params['id_log'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
