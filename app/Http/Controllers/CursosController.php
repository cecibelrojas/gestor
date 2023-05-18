<?php

namespace App\Http\Controllers;

use App\Models\FastEvent;
use Exception;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $fastEvents = FastEvent::all();
        return view('cursos.home', ['fastEvents' => $fastEvents]);
    }

}
