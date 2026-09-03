<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Gunakan Fleet dan Destination
use App\Models\Fleet; 
use App\Models\Destination;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil data menggunakan model Fleet dan Destination
        $armadas = Fleet::all();
        $destinasis = Destination::all();
        
        $galleries = GalleryImage::with('imageable')->latest()->get(); 
        
        return view('admin.gallery', compact('armadas', 'destinasis', 'galleries'));
    }

    public function store(Request $request)
    {
        // Sistem akan berhenti di sini dan mencetak data ke layar
        // dd([
        //     'Semua Request' => $request->all(),
        //     'Apakah ada file?' => $request->hasFile('images'),
        //     'Isi file mentah' => $request->file('images'),
        // ]);
        // $file = $request->file('images')[0];
        
        // dd([
        //     'Apakah File Valid?' => $file->isValid(),
        //     'Pesan Error Asli PHP' => $file->getErrorMessage(),
        //     'Lokasi Temp File' => $file->getRealPath(),
        // ]);

        $request->validate([
            'entity' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        list($modelClass, $modelId) = explode(',', $request->entity);
        $entity = $modelClass::findOrFail($modelId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Tambahkan baris pengecekan ini
                if ($image && $image->isValid()) { 
                    $imagePath = $image->store('galleries', 'public');
                    
                    $entity->galleries()->create([
                        'image_path' => $imagePath
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Berhasil mengupload gambar!');
        }
        return redirect()->back()->with('error', 'Gagal mengupload.');
    }

    public function destroy($id)
    {
        $gallery = GalleryImage::findOrFail($id);
        if (Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }
}