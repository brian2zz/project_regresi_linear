<?php

namespace App\Http\Controllers;

use App\Models\input;
use App\Models\phonska;
use App\Models\type_input;
use App\Models\urea;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_type = type_input::get();
        return view('pages.dashboard.index', ['data_type' => $data_type]);
    }
    public function getDataAll($selectedValue)
    {

        if ($selectedValue == 1) {
            $data_input = urea::all();
            $total = urea::count();
        } else {
            $data_input = phonska::all();
            $total = phonska::count();
        }

        return response()->json($data_input);
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
