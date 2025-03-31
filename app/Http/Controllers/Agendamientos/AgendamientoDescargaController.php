<?php

namespace App\Http\Controllers\Agendamientos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AgendamientoDescargaController extends Controller
{
    /**
     * Muestra la lista de todas las solicitudes obtenidas desde el microservicio.
     */
    public function index()
    {
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga';
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            // Extraemos el array de solicitudes de la clave "agendamientos"
            $solicitudes = $response->json()['agendamientos'] ?? [];
        } else {
            $solicitudes = [];
        }
        
        return view('solicitudes.formato-descarga.index', compact('solicitudes'));
    }

    /**
     * Muestra solo las solicitudes pendientes.
     */
    public function pendientes()
    {
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga';
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $solicitudes = $response->json()['agendamientos'] ?? [];
            // Filtrar para obtener solo las solicitudes con estatus "pendiente"
            $pendientes = collect($solicitudes)->filter(function ($solicitud) {
                return $solicitud['estatus'] === 'pendiente';
            })->values()->all();
        } else {
            $pendientes = [];
        }

        return view('solicitudes.formato-descarga.pendientes', compact('pendientes'));
    }

    /**
     * Actualiza una solicitud (para aprobar o rechazar) y envía la información actualizada al microservicio.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'estatus' => 'required|in:aprobada,rechazada',
            'autorizador' => $request->estatus == 'aprobada' ? 'required|string|max:255' : 'nullable',
            'fecha_programada_entrega' => $request->estatus == 'aprobada' ? 'required|date' : 'nullable',
            'texto_respuesta_correo' => $request->estatus == 'rechazada' ? 'required|string' : 'nullable',
        ]);

        $data['id'] = $id;

        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga/' . $id;
        $microResponse = Http::put($apiUrl, $data);

        if ($microResponse->successful()) {
            return redirect()->back()->with('success', 'La solicitud ha sido actualizada correctamente.');
        } else {
            return redirect()->back()->withErrors('Error al sincronizar la actualización con el microservicio.');
        }
    }
}