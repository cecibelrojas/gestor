<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parroquias extends Model
{
    protected $table = 'parroquias';

    public function listar(array $params = array())
    {

        $select = $this->from('parroquias as p')
            ->select('p.*');

        if (array_key_exists('id_municipio', $params)) {
            $select->where('p.id_municipio', $params['id_municipio']);
        }

        $select->orderByRaw('p.parroquia');

        return $select->get();
    }
}
