<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function index()
    {
        $rute = Rute::all();
        return response()->json($rute);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_rute' => 'required|string|max:250',
        ]);

        $rute = Rute::create($validated);

        return response()->json($rute, 201);
    }

    public function show(Rute $rute)
    {
        return response()->json($rute);
    }

    public function update(Request $request, Rute $rute)
    {
        $validated = $request->validate([
            'jenis_rute' => 'sometimes|required|string|max:250',
        ]);

        $rute->update($validated);

        return response()->json($rute);
    }

    public function destroy(Rute $rute)
    {
        $rute->delete();

        return response()->json(['message' => 'Rute berhasil dihapus']);
    }
}
