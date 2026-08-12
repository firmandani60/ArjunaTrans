<?php

namespace App\Http\Controllers;

use App\Models\RouteHargaDetail;
use Illuminate\Http\Request;

class RouteHargaDetailController extends Controller
{
    public function index()
    {
        $data = RouteHargaDetail::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_route'      => 'required|string|max:250',
            'titik_drop_off'  => 'required|string|max:250',
            'harga'           => 'required|string|max:250',
            'pilih_destinasi' => 'required|string|max:250',
        ]);

        $data = RouteHargaDetail::create($validated);

        return response()->json($data, 201);
    }

    public function show(RouteHargaDetail $routeHargaDetail)
    {
        return response()->json($routeHargaDetail);
    }

    public function update(Request $request, RouteHargaDetail $routeHargaDetail)
    {
        $validated = $request->validate([
            'nama_route'      => 'sometimes|required|string|max:250',
            'titik_drop_off'  => 'sometimes|required|string|max:250',
            'harga'           => 'sometimes|required|string|max:250',
            'pilih_destinasi' => 'sometimes|required|string|max:250',
        ]);

        $routeHargaDetail->update($validated);

        return response()->json($routeHargaDetail);
    }

    public function destroy(RouteHargaDetail $routeHargaDetail)
    {
        $routeHargaDetail->delete();

        return response()->json(['message' => 'Route & harga detail berhasil dihapus']);
    }
}
