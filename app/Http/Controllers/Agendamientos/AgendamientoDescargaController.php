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
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga/otros';
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            // Extraemos el arreglo de solicitudes de la clave "agendamientos"
            $solicitudes = $response->json()['agendamientos'] ?? [];
        } else {
            $solicitudes = [];
        }
        
        return view('Solicitudes.Formato-Descarga.index', compact('solicitudes'));
    }

    /**
     * Muestra solo las solicitudes pendientes obtenidas desde el microservicio.
     */
    public function pendientes()
    {
        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga/pendientes';
        $response = Http::get($apiUrl);

        // El endpoint ya retorna solo pendientes
        $pendientes = $response->successful() 
            ? $response->json()['agendamientos'] ?? [] 
            : [];

        return view('Solicitudes.Formato-Descarga.pendientes', compact('pendientes'));
    }

    /**
     * Actualiza una solicitud (para aprobar o rechazar) y envía la información actualizada al microservicio.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all(); // Obtener todos los datos del request

        $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga/' . $id;
        $microResponse = Http::put($apiUrl, $data);
    
        if ($microResponse->successful()) {
            return redirect()->route('Solicitudes.Formato-Descarga.pendientes')->with('success', '.Actualización realizada con exito.');
        } else {
            return back()->withErrors('Error al sincronizar la actualización con el microservicio.');
        }
    }    
}