<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'municipios';

    public function listar(array $params = array())
    {

        $select = $this->from('municipios as m')
            ->select('m.*');

        $select->orderByRaw('m.municipio');

        return $select->get();
    }
}
