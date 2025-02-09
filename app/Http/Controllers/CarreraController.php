<?php
namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{ 

    public function index()
    {
        $carreras = Carrera::all(); // O usar un paginador, si tienes muchas carreras
        return view('admin.carreras.index', compact('dashboard')); // Vista para mostrar las carreras
    }
    
    public function create()
    {
        return view('admin.create'); // Vista para crear carrera
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Carrera::create($request->all());

        return redirect()->route('admin.carreras.index');
    }

    public function destroy($id)
    {
        $carrera = Carrera::find($id);
        $carrera->delete();

        return redirect()->route('admin.carreras.index');
    }
}
