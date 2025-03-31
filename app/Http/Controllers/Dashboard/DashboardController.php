<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard correspondiente según el rol del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('Administrador')) {
            return view('dashboard.administrador');
        } elseif ($user->hasRole('Autorizador')) {
            // Definir la URL del microservicio
            $apiUrl = config('services.microservice.url') . '/api/agendamientos/formato-descarga/todas';

            // Realizar la solicitud GET al microservicio
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                // Extraer el array de solicitudes de la clave "agendamientos"
                $solicitudes = $response->json()['agendamientos'] ?? [];
            } else {
                $solicitudes = [];
            }

            return view('dashboard.autorizador', compact('solicitudes'));
        } else {
            return redirect('/')->with('error', 'Acceso Denegado.');
        }
    }
}
