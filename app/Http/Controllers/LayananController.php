<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return response()->json($layanan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'jenis_layanan' => 'required|string|max:250',
            'gambar'        => 'required|string|max:250',
            'deskripsi'     => 'required|string|max:250',
        ]);

        $layanan = Layanan::create($validated);

        return response()->json($layanan, 201);
    }

    public function show(Layanan $layanan)
    {
        return response()->json($layanan);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'jenis_layanan' => 'sometimes|required|string|max:250',
            'gambar'        => 'sometimes|required|string|max:250',
            'deskripsi'     => 'sometimes|required|string|max:250',
        ]);

        $layanan->update($validated);

        return response()->json($layanan);
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return response()->json(['message' => 'Layanan berhasil dihapus']);
    }
}
