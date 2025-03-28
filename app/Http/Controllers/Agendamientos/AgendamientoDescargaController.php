<?php

namespace App\Http\Controllers\Agendamientos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AgendamientoDescargaController extends Controller
{
    /**
     * Muestra la lista de solicitudes obtenidas desde el microservicio.
     */
    public function index()
    {
        // Construir la URL del microservicio
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga';
        
        // Realizar la solicitud GET al microservicio
        $response = Http::get($apiUrl);
        
        if ($response->successful()) {
            $solicitudes = $response->json();
        } else {
            $solicitudes = [];
        }
        
        // Pasar las solicitudes a la vista
        return view('solicitudes.formato-descarga.index', compact('solicitudes'));
    }

    /**
     * Actualiza una solicitud (por ejemplo, para aprobar o rechazar) y 
     * envía la información actualizada al microservicio.
     */
    public function update(Request $request, $id)
    {
        // Validar campos en función de la acción (aprobada o rechazada)
        $data = $request->validate([
            'estatus' => 'required|in:aprobada,rechazada',
            'autorizador' => $request->estatus == 'aprobada' ? 'required|string|max:255' : 'nullable',
            'fecha_programada_entrega' => $request->estatus == 'aprobada' ? 'required|date' : 'nullable',
            'texto_respuesta_correo' => $request->estatus == 'rechazada' ? 'required|string' : 'nullable',
        ]);

        // Agregar el ID de la solicitud a los datos (si es necesario)
        $data['id'] = $id;

        // Enviar la información actualizada al microservicio
        $apiUrl = config('services.microservice.url') . '/api/actualizar-solicitud';
        $microResponse = Http::post($apiUrl, $data);

        if ($microResponse->successful()) {
            return redirect()->back()->with('success', 'La solicitud ha sido actualizada correctamente.');
        } else {
            return redirect()->back()->withErrors('Error al sincronizar la actualización con el microservicio.');
        }
    }
}
