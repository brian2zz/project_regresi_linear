<?php

namespace App\Http\Controllers;

use App\Models\input;
use App\Models\type_input;
use Illuminate\Http\Request;

class datasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_type = type_input::get();
        return view('pages.dataset.index', ['data_type' => $data_type, 'type' => 1]);
    }

    public function phonska()
    {
        $data_type = type_input::get();
        return view('pages.dataset.index', ['data_type' => $data_type, 'type' => 2]);
    }

    public function getData($selectedValue)
    {
        $data_input = Input::where('id_type', $selectedValue)->get();
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
        input::where('id_type', $request->id_type)->delete();
        foreach ($request->input_x as $key => $value) {
            input::create([
                'id_input' => $key + 1,
                'x' => $value,
                'y' => $request->input_y[$key],
                'id_type' => $request->id_type,
            ]);
        }
        return redirect()->back();
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
