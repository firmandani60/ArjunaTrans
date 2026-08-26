<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $file = $request->file('image');
        $name = Str::uuid().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('arjuna-trans', $name, 'public');

        return response()->json([
            'message' => 'Gambar berhasil diunggah.',
            'path' => $path,
            'url' => asset('storage/'.$path),
            'name' => $file->getClientOriginalName(),
        ]);
    }
}
