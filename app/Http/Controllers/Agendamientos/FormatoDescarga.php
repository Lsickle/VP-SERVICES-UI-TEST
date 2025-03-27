<?php

namespace App\Http\Controllers\Agendamientos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormatoDescarga extends Controller
{
    /**
     * Muestra la vista del formulario de Agendamiento (Formato Descarga).
     */
    public function index()
    {
        return view('agendamientos.formato-descarga');
    }

    /**
     * Procesa el envío del formulario de agendamiento y lo envía a la API del microservicio.
     */
    public function enviar(Request $request)
    {
        $data = $request->validate([
            'fecha_entrega'            => 'required|date',
            'bodega'                   => 'required|string|max:100',
            'op'                       => 'required|string|max:50',
            'proveedor'                => 'required|string|max:255',
            'codigo_articulo'          => 'required|string|max:100',
            'nombre_articulo'          => 'required|string|max:255',
            'cantidades_pedidas'       => 'required|integer|min:1',
            'placa'                    => 'required|string|max:50',
            'conductor'                => 'required|string|max:255',
            'cedula'                   => 'required|string|max:50',
            'correo_solicitante'       => 'required|email|max:255',
            'celular'                  => 'required|string|max:20',
        ]);

        // URL de la API del microservicio
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga';

        // Enviar datos a la API
        $response = Http::post($apiUrl, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Tu solicitud de agendamiento ha sido enviada.');
        } else {
            return redirect()->back()->withErrors('Error al enviar la solicitud. Inténtalo nuevamente.');
        }
    }
}
