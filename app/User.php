<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','password','rol','foto','last_seen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function listar(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*');

        $select->orderByRaw('u.name');

        return $select->get();
    }
    public function listar_inactivos(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*')
            ->where('estado','=','I');

        $select->orderByRaw('u.name');

        return $select->get();
    }
    public function listar_admin(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*')
            ->where('rol','=','A');

        $select->orderByRaw('u.name');

        return $select->get();
    }
    public function listar_jprensa(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*')
            ->where('rol','=','E');

        $select->orderByRaw('u.name');

        return $select->get();
    }
 public function listar_redactores(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*')
            ->where('rol','=','C');

        $select->orderByRaw('u.name');

        return $select->get();
    }
    public function listar_correctores(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*')
            ->where('rol','=','D');

        $select->orderByRaw('u.name');

        return $select->get();
    }
    
    public function obtener(array $params = array())
    {

        $select = $this->from('users as u')
            ->select('u.*');

        if (array_key_exists('id', $params)) {
            $select->where('u.id', $params['id']);
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
            $delete = DB::table('users')->where('id', $params['id'])->delete();
            return $delete;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function obtenerId()
    {
        $select = $this->from('users as u')
            ->selectRaw('MAX(id) as ultimo');

        $data = $select->first();

        return $data ? $data['ultimo'] + 1 : 1;
    }

}
