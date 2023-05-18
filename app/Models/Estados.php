<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = 'estados';

    public function listar(array $params = array())
    {

        $select = $this->from('estados as e')
            ->select('e.*');

        $select->orderByRaw('e.estado');

        return $select->get();
    }
}
