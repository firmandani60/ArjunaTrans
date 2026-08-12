<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return response()->json($fasilitas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:250',
            'id_fasilitas'   => 'required|integer|unique:fasilitas,id_fasilitas',
        ]);

        $fasilitas = Fasilitas::create($validated);

        return response()->json($fasilitas, 201);
    }

    public function show(Fasilitas $fasilitas)
    {
        return response()->json($fasilitas);
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'sometimes|required|string|max:250',
        ]);

        $fasilitas->update($validated);

        return response()->json($fasilitas);
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return response()->json(['message' => 'Fasilitas berhasil dihapus']);
    }
}
