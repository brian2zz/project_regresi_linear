<?php

namespace App\Http\Controllers;

use App\Models\input;
use App\Models\phonska;
use App\Models\type_input;
use App\Models\urea;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input as InputInput;

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
        if ($selectedValue == 1) {
            $data_input = urea::all();
        } else {
            $data_input = phonska::all();
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
        $type = $request->id_type;

        if ($type == 1) {
            urea::truncate();
            foreach ($request->input_x as $key => $value) {
                urea::create([
                    'id' => $key + 1,
                    'x' => $value,
                    'y' => $request->input_y[$key],

                ]);
            }
        } else {
            phonska::truncate();
            foreach ($request->input_x as $key => $value) {
                phonska::create([
                    'id' => $key + 1,
                    'x' => $value,
                    'y' => $request->input_y[$key],

                ]);
            }
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
