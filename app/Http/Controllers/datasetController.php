<?php

namespace App\Http\Controllers;

use App\Models\input;
use App\Models\phonska;
use App\Models\type_input;
use App\Models\urea;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input as InputInput;
use Illuminate\Support\Facades\Log;

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

    public function getData(Request $request, $selectedValue)
    {
        $page = $request->query('page');
        $limit = 10;
        $skip = ($page - 1) * $limit;
        // dd($page);
        if ($selectedValue == 1) {
            $data_input = urea::skip($skip)->take($limit)->get();
            $total = urea::count();
        } else {
            $data_input = phonska::skip($skip)->take($limit)->get();
            $total = phonska::count();
        }
        $totalPages = ceil($total / $limit);
        $previousPageUrl = ($page > 1) ? ($page - 1) : null;
        $nextPageUrl = ($page < $totalPages) ?  ($page + 1) : null;
        return response()->json([
            'data' => $data_input,
            'totalPage' => $totalPages,
            'previousPageUrl' => $previousPageUrl,
            'nextPageUrl' => $nextPageUrl,
            'currentPage' => $page,
        ]);
    }

    public function getKet(Request $request)
    {
        $type = $request->query('jenis');
        if ($type == 1) {
            $data = urea::all();
        } else {
            $data = phonska::all();
        }
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

        return response()->json([
            'total_x' => $total_x,
            'total_y' => $total_y,
            'total_xy' => $total_xy,
            'total_x_kuadrat' => $total_x_kuadrat,
            'n' => $n,
            'b' => round($b, 2),
            'a' => round($a, 2),
            'data_type' => $data_type,
            'forecasting' => true,
            'jenis' => $jenis->name,
        ]);
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
        try {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            $type = $request->input('type');
            $updateData = $request->input('update_data');

            if ($type == 1) {
                foreach ($updateData as $data) {
                    if ($data['status'] == 'update') {
                        // Update data
                        Urea::where('id', $data['id'])->update([
                            'x' => $data['input_x'],
                            'y' => $data['input_y'],
                        ]);
                    } elseif ($data['status'] == 'new') {
                        // Create new data
                        Urea::create([
                            'x' => $data['input_x'],
                            'y' => $data['input_y'],
                        ]);
                    } elseif ($data['status'] == 'delete') {
                        // Delete data
                        Urea::where('id', $data['id'])->delete();
                    }
                }
            } else {
                foreach ($updateData as $data) {
                    if ($data['status'] == 'update') {
                        // Update data
                        Phonska::where('id', $data['id'])->update([
                            'x' => $data['input_x'],
                            'y' => $data['input_y'],
                        ]);
                    } elseif ($data['status'] == 'new') {
                        // Create new data
                        Phonska::create([
                            'x' => $data['input_x'],
                            'y' => $data['input_y'],
                        ]);
                    } elseif ($data['status'] == 'delete') {
                        // Delete data
                        Phonska::where('id', $data['id'])->delete();
                    }
                }
            }

            return response()->json(['message' => 'Data successfully processed'], 200);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error processing data: ' . $e->getMessage(), ['exception' => $e]);

            // Return a JSON response with error message
            return response()->json(['message' => 'Error processing data', 'error' => $e->getMessage()], 500);
        }
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
