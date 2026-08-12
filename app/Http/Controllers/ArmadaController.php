<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    public function index()
    {
        $armada = Armada::all();
        return response()->json($armada);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_armada'  => 'required|string|max:250',
            'jenis_armada' => 'required|string|max:250',
            'vasilitas'    => 'required|string|max:250',
            'kapasitas'    => 'required|string|max:250',
            'jumlah'       => 'required|string|max:250',
            'status'       => 'required|string|max:250',
        ]);

        $armada = Armada::create($validated);

        return response()->json($armada, 201);
    }

    public function show(Armada $armada)
    {
        return response()->json($armada);
    }

    public function update(Request $request, Armada $armada)
    {
        $validated = $request->validate([
            'nama_armada'  => 'sometimes|required|string|max:250',
            'jenis_armada' => 'sometimes|required|string|max:250',
            'vasilitas'    => 'sometimes|required|string|max:250',
            'kapasitas'    => 'sometimes|required|string|max:250',
            'jumlah'       => 'sometimes|required|string|max:250',
            'status'       => 'sometimes|required|string|max:250',
        ]);

        $armada->update($validated);

        return response()->json($armada);
    }

    public function destroy(Armada $armada)
    {
        $armada->delete();

        return response()->json(['message' => 'Armada berhasil dihapus']);
    }
}
