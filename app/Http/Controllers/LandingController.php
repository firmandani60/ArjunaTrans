<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Advantage;
use App\Models\ContactSetting;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\HeroSection;
use App\Models\OrderStep;
use App\Models\RentalRoute;
use App\Models\Layanan;
use App\Models\GalleryImage;

class LandingController extends Controller
{
    public function __invoke()
    {
        return view('landing', [
            'hero' => HeroSection::first(),
            'advantages' => Advantage::where('is_active', true)->orderBy('sort_order')->get(),
            'services' => Layanan::all(),
            'about' => AboutSection::with('galleryImages')->first(),
            'fleets' => Fleet::where('is_active', true)->orderBy('sort_order')->get(),
            'destinations' => Destination::where('is_active', true)->orderBy('sort_order')->get(),
            'routes' => RentalRoute::with(['fleet', 'destination'])->where('is_active', true)->orderBy('sort_order')->get(),
            'orderSteps' => OrderStep::where('is_active', true)->orderBy('sort_order')->get(),
            'contact' => ContactSetting::first(),
            'galleries' => GalleryImage::latest()->get(), // <-- 2. Tambahkan ini
        ]);
    }
}