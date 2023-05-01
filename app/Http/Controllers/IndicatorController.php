<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicators = Indicator::get();
        return response()->json($indicators, 200);
    }

    public function filter($date_init, $date_end)
    {
        $date_init = Carbon::parse($date_init)->format('Y-m-d');
        $date_end = Carbon::parse($date_end)->format('Y-m-d');
        $indicators = Indicator::whereBetween('date_indicator', [$date_init, $date_end])->get();
        return response()->json($indicators, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indicator = Indicator::create($request->all());
        return response()->json($indicator, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indicator = Indicator::find($id);
        return response()->json($indicator, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Indicator::where('id', $id)->update($request->all());
        $indicator = Indicator::find($id);
        return response()->json($indicator, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicator = Indicator::where('id', $id)->delete();
        return response()->json([], 200);
    }
}
