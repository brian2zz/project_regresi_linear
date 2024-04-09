<?php

namespace App\Http\Controllers;

use App\Models\input;
use App\Models\type_input;
use Illuminate\Http\Request;

class forecastingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_type = type_input::get();
        return view('pages.forecasting.index', ['data_type' => $data_type, 'forecasting' => false]);
    }

    public function forecast(Request $request)
    {
        $data = input::where('id_type', $request->jenis)->get();
        $data_type = type_input::get();
        $jenis = type_input::where('id_type_input', $request->jenis)->first();
        $total_x = 0;
        $total_y = 0;
        $total_xy = 0;
        $total_x_kuadrat = 0;
        $n = 0;
        foreach ($data as $key => $value) {
            $total_x += $value->x;
            $total_y += $value->y;
            $total_xy += $value->x * $value->y;
            $total_x_kuadrat += pow($value->x, 2);
            $n += 1;
        }
        $b = (($n * $total_xy) - ($total_x * $total_y)) / (($n * $total_x_kuadrat) - (pow($total_x, 2)));
        $a = ($total_y - ($b * $total_x)) / $n;

        $hasil = ($b * $request->x_input) + $a;
        $hasil = round($hasil, 2);
        return view('pages.forecasting.index', [
            'total_x' => $total_x,
            'total_y' => $total_y,
            'total_xy' => $total_xy,
            'total_x_kuadrat' => $total_x_kuadrat,
            'n' => $n,
            'b' => round($b, 2),
            'a' => round($a, 2),
            'X' => $request->x_input,
            'hasil' => $hasil,
            'data_type' => $data_type,
            'forecasting' => true,
            'jenis' => $jenis->name,
        ]);

        // dd($total_x, $total_y, $total_xy, $total_x_kuadrat, $n, $b, $a, $hasil);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
