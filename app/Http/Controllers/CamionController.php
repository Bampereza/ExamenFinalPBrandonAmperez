<?php

namespace App\Http\Controllers;
use App\Exceptions\TransporteNoAsignadoException;

use App\Models\Camion;
use Illuminate\Http\Request;
class CamionController extends Controller
{
    public function indexc()
    {

        $datos = Camion::orderBy('id', 'asc')->paginate(3);
        return view('inicio-camion', compact('datos'));
    }

    public function createc()
    {
        //el formulario donde nosotros agregamos datos
        return view('agregar-camion');
    }

    public function storec(Request $request)
    {
        try {




            // Si llegamos a este punto, significa que el transporte está asignado
            $camiones = new Camion();
            $camiones->id = $request->post('id');
            $camiones->placa_camion = $request->post('placa_camion');
            $camiones->marca = $request->post('marca');
            $camiones->color = $request->post('color');
            $camiones->modelo = $request->post('modelo');
            $camiones->capacidad_toneladas = $request->post('capacidad_toneladas');
            $camiones->transporte_codigo = $request->post('transporte_codigo');
            $camiones->save();

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

        return redirect()->route("camiones.indexc")->with("success", "Agregado con éxito!");

    }


    public function showc($id)
    {
        //Servira para obtener un registro de nuestra tabla
        $camiones = Camion::find($id);
        return view("eliminar-camion", compact('camiones'));
    }

    public function editc($id)
    {
        //Este método nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario"
        $camiones = Camion::find($id);
        return view("actualizar-camion", compact('camiones'));
        //echo $id;
    }

    public function updatec(Request $request, $id)
    {
        //Este método actualiza los datos en la base de datos
        $camiones = Camion::find($id);
        $camiones->id = $request->post('id');
        $camiones->placa_camion = $request->post('placa_camion');
        $camiones->marca = $request->post('marca');
        $camiones->color = $request->post('color');
        $camiones->modelo = $request->post('modelo');
        $camiones->capacidad_toneladas = $request->post('capacidad_toneladas');
        $camiones->transporte_codigo = $request->post('transporte_codigo');
        $camiones->save();

        return redirect()->route("camiones.indexc")->with("success", "Actualizado con exito!");
    }

    public function destroyc($id)
    {
        //Elimina un registro
        $camiones = Camion::find($id);
        $camiones->delete();
        return redirect()->route("camiones.indexc")->with("success", "Eliminado con exito!");
    }


}
