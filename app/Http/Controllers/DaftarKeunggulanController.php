<?php

namespace App\Http\Controllers;

use App\Models\DaftarKeunggulan;
use Illuminate\Http\Request;

/**
 * PERHATIAN: tabel `daftar_keunggulan` tidak memiliki primary key.
 * Karena itu, route model binding (Laravel otomatis mencari baris
 * berdasarkan ID di URL) tidak bisa dipakai di sini. show/update/destroy
 * di bawah ini memakai kombinasi kolom sebagai penanda, yang TIDAK
 * andal kalau ada baris dengan judul yang sama persis.
 *
 * Rekomendasi: tambahkan kolom `id` (primary key auto-increment) ke
 * tabel ini, lalu controller ini bisa disederhanakan seperti
 * controller lainnya.
 */
class DaftarKeunggulanController extends Controller
{
    public function index()
    {
        $data = DaftarKeunggulan::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ikon'      => 'required|string|max:100',
            'judul'     => 'required|string|max:250',
            'deskripsi' => 'required|string|max:250',
        ]);

        $data = DaftarKeunggulan::create($validated);

        return response()->json($data, 201);
    }

    public function show(string $judul)
    {
        $data = DaftarKeunggulan::where('judul', $judul)->firstOrFail();
        return response()->json($data);
    }

    public function update(Request $request, string $judul)
    {
        $validated = $request->validate([
            'ikon'      => 'sometimes|required|string|max:100',
            'judul'     => 'sometimes|required|string|max:250',
            'deskripsi' => 'sometimes|required|string|max:250',
        ]);

        DaftarKeunggulan::where('judul', $judul)->update($validated);

        return response()->json(DaftarKeunggulan::where('judul', $validated['judul'] ?? $judul)->first());
    }

    public function destroy(string $judul)
    {
        DaftarKeunggulan::where('judul', $judul)->delete();

        return response()->json(['message' => 'Keunggulan berhasil dihapus']);
    }
}
