<?php

namespace App\Http\Controllers;
use App\Exceptions\DatosInvalidosException;

use App\Models\Personas;
use Illuminate\Http\Request;

class PersonasController extends Controller
{

    public function index()
    {
        //pagina de inicio
        $datos = Personas::orderBy('paterno', 'desc')->paginate(5);
        return view('inicio', compact('datos'));
    }

    public function create()
    {
        //el formulario donde
        //nosotros agregamos datos
        return view('agregar');
    }

    public function store(Request $request)
    {
        try {

            //sirve para guardar datos en la bd
            $personas = new Personas();
            $personas->paterno = $request->post('paterno');
            $personas->materno = $request->post('materno');
            $personas->nombre = $request->post('nombre');
            $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
            $personas->save();


        } catch (\Exception $exception) {
            $message= " Excepción general ". $exception->getMessage();
            return view('exceptions.exceptions', compact('message'));
        }catch (QueryException $queryException){
            $message= " Excepción de SQL ". $queryException->getMessage();
            return view('errors.404', compact('message'));
        }catch (ModelNotFoundException $modelNotFoundException){
            $message=" Excepción del Sistema ".$modelNotFoundException->getMessage();
            return view('errors.404', compact('message'));
        }

        return redirect()->route("personas.index")->with("success", "Agregado con éxito!");

    }

    public function show($id)
    {
        //servira para obtener un registro de nuestra tabla
        $personas = Personas::find($id);
        return view("eliminar" , compact('personas'));
    }

    public function edit($id)
    {
        //este metodo nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario

        $personas = Personas::find($id);
        return view("actualizar" , compact('personas'));

    }


    public function update(Request $request, $id)
    {
        //este metodo actualiza los datos en la bd
        $personas = Personas::find($id);
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success", "Actualizado con exito!");

    }

    public function destroy($id)
    {
        $personas = Personas::find($id);
        $personas->delete();
        return redirect()->route("personas.index")->with("success", "Eliminado con exito!");
    }
}
