<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            return view('dashboard.autorizador');
        } else {
            return redirect('/')->with('error', 'Acceso Denegado.');
        }
    }
}