<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class InsertController extends Controller
{
    public function viewInsert()
    {
        $token = $this->getToken();

        if (!$token) {
            return view('welcome');
        }

        $data = $this->getData($token);
        $this->insertData($data);

        return view('home');
    }

    public function getToken()
    {
        $response = Http::post('https://postulaciones.solutoria.cl/api/acceso', [
            'userName' => 'alexmd166nwtio_565@indeedemail.com',
            'flagJson' => true
        ]);

        $data = $response->json();

        if ($response->ok()) {

            Session::put('token', $data['token']);
            return $data['token'];
        } else {

            return false;
        }
    }

    public function getData($token)
    {
        $response = Http::withToken($token)->get('https://postulaciones.solutoria.cl/api/indicadores');
        if ($response->ok()) {
            return $response->json();
        } else {
            return false;
        }
    }

    public function insertData($data)
    {
        $new_data = array_map(function ($dat) {
            return  [
                'name_indicator' => $dat['nombreIndicador'],
                'code_indicator' => $dat['codigoIndicador'],
                'unit_measure_indicator' => $dat['unidadMedidaIndicador'],
                'value' => $dat['valorIndicador'],
                'date_indicator' => $dat['fechaIndicador'],
                'time_indicator' => $dat['tiempoIndicador'],
                'origin_indicator' => $dat['origenIndicador'],
            ];
        }, $data);

        Indicator::insert($new_data);
    }
}
