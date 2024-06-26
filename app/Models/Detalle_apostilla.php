<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detalle_apostilla extends Model
{
    protected $table = 'detalle_apostilla';

    protected $fillable = ['id','subservicio_id','titulo1','titulo2','titulo1_ingles','titulo2_ingles','descripcion1','descripcion2','descripcion1_ingles','descripcion2_ingles','titulo_infografia','titulo_infografia_ingles','infografia','fotoslae','link','parallax','','titulo_parallax','titulo_parallax_ingles','des_parallax','des_parallax_ingles','imgmap','imgpago','titulomap','titulomap_ingles','titulopago','titulopago_ingles','desmapa','desmapa_ingles','despago','despago_ingles','linkna','linkin','linkpago','infopagos','imgextra','textoextra','textoextra_ingles','link3','imgfaq','usureg','usumod','created_at','updated_at'];

    protected $hidden = [
        '_token'
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('detalle_apostilla as d')
        ->selectRaw("(select name from users as u where u.id = d.usureg) as creador")
        ->selectRaw("(select name from users as u where u.id = d.usumod) as editor")
         ->selectRaw('d.*');

        $select->where('subservicio_id', $params['id']); 

        $select->orderByRaw('d.created_at desc');
        //dd($select);
        return $select->get();
    }
    public function obtener(array $params = array())
    {

        $select = $this->from('detalle_apostilla as d');

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
            $delete = DB::table('detalle_apostilla')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
