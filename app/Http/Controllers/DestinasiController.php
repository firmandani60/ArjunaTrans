<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::with(['rute', 'armada'])->get();
        return response()->json($destinasi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_destinasi' => 'required|string|max:250',
            'rute_id'        => 'required|integer|exists:rute,id_rute',
            'harga'          => 'required|string|max:250',
            'armada_id'      => 'required|integer|exists:armada,id_armada',
        ]);

        $destinasi = Destinasi::create($validated);

        return response()->json($destinasi->load(['rute', 'armada']), 201);
    }

    public function show(Destinasi $destinasi)
    {
        return response()->json($destinasi->load(['rute', 'armada']));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'nama_destinasi' => 'sometimes|required|string|max:250',
            'rute_id'        => 'sometimes|required|integer|exists:rute,id_rute',
            'harga'          => 'sometimes|required|string|max:250',
            'armada_id'      => 'sometimes|required|integer|exists:armada,id_armada',
        ]);

        $destinasi->update($validated);

        return response()->json($destinasi->load(['rute', 'armada']));
    }

    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();

        return response()->json(['message' => 'Destinasi berhasil dihapus']);
    }
}
