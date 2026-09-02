<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutGalleryImage;
use App\Models\AboutSection;
use App\Models\Advantage;
use App\Models\ContactSetting;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\HeroSection;
use App\Models\Layanan;
use App\Models\OrderStep;
use App\Models\RentalRoute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HERO
    |--------------------------------------------------------------------------
    */

    public function hero()
    {
        $hero = HeroSection::firstOrCreate([], [
            'title' => 'Eksplorasi Perjalanan Tanpa Batas dengan Kenyamanan Eksekutif',
        ]);

        return view('admin.hero', [
            'hero' => $this->heroPayload($hero),
        ]);
    }

    public function updateHero(Request $request): JsonResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:160'],
            'sub_deskripsi' => ['nullable', 'string'],
            'tombol_label' => ['nullable', 'string', 'max:100'],
            'tombol_link' => ['nullable', 'string', 'max:500'],
            'gambar_path' => ['nullable', 'string'],
            'gambar_nama' => ['nullable', 'string', 'max:255'],
        ]);

        $hero = HeroSection::firstOrNew();

        $hero->fill([
            'title' => $data['judul'],
            'description' => $data['sub_deskripsi'] ?? null,
            'primary_button_label' => $data['tombol_label'] ?? null,
            'primary_button_url' => $data['tombol_link'] ?? null,
            'image_path' => $data['gambar_path'] ?? null,
            'image_alt' => $data['gambar_nama'] ?? null,
        ])->save();

        return response()->json([
            'message' => 'Data hero berhasil disimpan.',
            'data' => $this->heroPayload($hero->fresh()),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | KEUNGGULAN
    |--------------------------------------------------------------------------
    */

    public function advantages()
    {
        return view('admin.keunggulan', [
            'keunggulan' => Advantage::orderBy('sort_order')
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'ikon' => $item->icon,
                    'judul' => $item->title,
                    'deskripsi' => $item->description,
                ])
                ->values(),
        ]);
    }

    public function updateAdvantages(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable'],
            'items.*.ikon' => ['nullable', 'string', 'max:100'],
            'items.*.judul' => ['required', 'string', 'max:255'],
            'items.*.deskripsi' => ['nullable', 'string'],
        ])['items'];

        $saved = $this->syncOrdered(
            Advantage::class,
            $items,
            fn ($item, $index) => [
                'icon' => $item['ikon'] ?? null,
                'title' => $item['judul'],
                'description' => $item['deskripsi'] ?? null,
                'sort_order' => $index,
                'is_active' => true,
            ]
        );

        return response()->json([
            'message' => 'Data keunggulan berhasil disimpan.',
            'data' => collect($saved)
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'ikon' => $item->icon,
                    'judul' => $item->title,
                    'deskripsi' => $item->description,
                ])
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | LAYANAN
    |--------------------------------------------------------------------------
    */

    public function services()
    {
        $layanan = Layanan::orderBy('id_layanan')
            ->get()
            ->map(fn ($item) => $this->layananPayload($item))
            ->values();

        return view('admin.layanan', [
            'layanan' => $layanan,
        ]);
    }

    public function updateServices(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],

            'items.*.id' => ['nullable'],
            'items.*.ikon' => ['nullable', 'string', 'max:100'],

            'items.*.judul' => [
                'required',
                'string',
                'max:250',
            ],

            'items.*.deskripsi' => [
                'required',
                'string',
                'max:250',
            ],

            'items.*.gambarPath' => [
                'nullable',
                'string',
                'max:250',
            ],

            'items.*.gambarPreview' => [
                'nullable',
                'string',
            ],
        ])['items'];


        $saved = DB::transaction(function () use ($items) {

            $keep = [];
            $saved = [];

            foreach ($items as $item) {

                /*
                 * Cari data lama berdasarkan id_layanan.
                 */
                $model = null;

                if (
                    !empty($item['id']) &&
                    ctype_digit((string) $item['id'])
                ) {
                    $model = Layanan::where(
                        'id_layanan',
                        (int) $item['id']
                    )->first();
                }


                /*
                 * Kalau data belum ada,
                 * buat data layanan baru.
                 */
                if (!$model) {
                    $model = new Layanan();
                }


                /*
                 * Simpan data sesuai struktur
                 * tabel layanan:
                 *
                 * id_layanan
                 * jenis_layanan
                 * gambar
                 * deskripsi
                 */
                $model->jenis_layanan = $item['judul'];

                $model->deskripsi = $item['deskripsi'] ?? null;

                $model->gambar =
                    $item['gambarPath']
                    ?? $item['gambarPreview']
                    ?? null;


                $model->save();


                /*
                 * Simpan ID yang masih digunakan.
                 */
                $keep[] = $model->id_layanan;

                $saved[] = $model->fresh();
            }


            /*
             * Hapus data yang sudah dihapus
             * dari form admin.
             */
            if (!empty($keep)) {

                Layanan::whereNotIn(
                    'id_layanan',
                    $keep
                )->delete();
            }


            return $saved;
        });


        return response()->json([
            'message' => 'Data layanan berhasil disimpan.',

            'data' => collect($saved)
                ->map(fn ($item) => $this->layananPayload($item))
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | TENTANG KAMI
    |--------------------------------------------------------------------------
    */

    public function about()
    {
        $about = AboutSection::firstOrCreate([], [
            'eyebrow' => 'Tentang Kami',
            'title' => 'Mendefinisikan Ulang Perjalanan Wisata Anda',
        ]);

        return view('admin.tentang-kami', [
            'tentang' => [
                'deskripsi' => $about->description,
                'visi' => $about->vision,
                'misi' => $about->mission,

                'galeri' => $about->galleryImages
                    ->map(fn ($item) => [
                        'id' => $item->id,
                        'path' => $item->image_path,
                        'url' => $this->mediaUrl(
                            $item->image_path
                        ),
                    ])
                    ->values(),
            ],
        ]);
    }

    public function updateAbout(Request $request): JsonResponse
    {
        $data = $request->validate([
            'deskripsi' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],

            'galeri' => [
                'required',
                'array',
                'min:1',
            ],

            'galeri.*.id' => ['nullable'],
            'galeri.*.path' => ['nullable', 'string'],
            'galeri.*.url' => ['nullable', 'string'],
        ]);


        $about = DB::transaction(function () use ($data) {

            $about = AboutSection::firstOrNew();

            $about->fill([
                'eyebrow' => 'Tentang Kami',
                'title' => 'Mendefinisikan Ulang Perjalanan Wisata Anda',
                'description' => $data['deskripsi'] ?? null,
                'vision' => $data['visi'] ?? null,
                'mission' => $data['misi'] ?? null,
            ])->save();


            $keep = [];


            foreach ($data['galeri'] as $index => $image) {

                $path =
                    $image['path']
                    ?? $image['url']
                    ?? null;

                if (!$path) {
                    continue;
                }


                $model = null;


                if (
                    !empty($image['id']) &&
                    ctype_digit((string) $image['id'])
                ) {
                    $model = AboutGalleryImage::where(
                        'about_section_id',
                        $about->id
                    )->find(
                        (int) $image['id']
                    );
                }


                if (!$model) {
                    $model = new AboutGalleryImage([
                        'about_section_id' => $about->id,
                    ]);
                }


                $model->fill([
                    'image_path' => $path,
                    'alt_text' => 'Galeri armada Arjuna Trans',
                    'sort_order' => $index,
                ])->save();


                $keep[] = $model->id;
            }


            $about->galleryImages()
                ->whereNotIn('id', $keep)
                ->delete();


            return $about->fresh('galleryImages');
        });


        return response()->json([
            'message' => 'Data tentang kami berhasil disimpan.',

            'data' => [
                'deskripsi' => $about->description,
                'visi' => $about->vision,
                'misi' => $about->mission,

                'galeri' => $about->galleryImages
                    ->map(fn ($item) => [
                        'id' => $item->id,
                        'path' => $item->image_path,
                        'url' => $this->mediaUrl(
                            $item->image_path
                        ),
                    ])
                    ->values(),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ARMADA
    |--------------------------------------------------------------------------
    */

    public function fleets()
    {
        return view('admin.armada', [
            'armada' => Fleet::orderBy('sort_order')
                ->get()
                ->map(
                    fn ($item) =>
                    $this->fleetPayload($item)
                )
                ->values(),
        ]);
    }

    public function updateFleets(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable'],

            'items.*.nama' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'items.*.deskripsi' => [
                'nullable',
                'string',
            ],

            'items.*.kapasitas' => [
                'nullable',
                'string',
                'max:100',
            ],

            'items.*.fasilitas' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.gambarPath' => [
                'nullable',
                'string',
            ],

            'items.*.gambarPreview' => [
                'nullable',
                'string',
            ],
        ])['items'];


        $saved = $this->syncOrdered(
            Fleet::class,
            $items,
            fn ($item, $index) => [
                'name' => $item['nama'],
                'category' => $item['kategori'] ?? null,
                'description' => $item['deskripsi'] ?? null,
                'capacity' => $item['kapasitas'] ?? null,
                'facilities' => $item['fasilitas'] ?? null,
                'image_path' =>
                    $item['gambarPath']
                    ?? $item['gambarPreview']
                    ?? null,
                'sort_order' => $index,
                'is_active' => true,
            ]
        );


        return response()->json([
            'message' => 'Data armada berhasil disimpan.',
            'data' => collect($saved)
                ->map(
                    fn ($item) =>
                    $this->fleetPayload($item)
                )
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DESTINASI
    |--------------------------------------------------------------------------
    */

    public function destinations()
    {
        return view('admin.destinasi', [
            'destinasi' => Destination::orderBy('sort_order')
                ->get()
                ->map(
                    fn ($item) =>
                    $this->destinationPayload($item)
                )
                ->values(),
        ]);
    }

    public function updateDestinations(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable'],

            'items.*.nama' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.deskripsi' => [
                'nullable',
                'string',
            ],

            'items.*.rute' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.gambarPath' => [
                'nullable',
                'string',
            ],

            'items.*.gambarPreview' => [
                'nullable',
                'string',
            ],
        ])['items'];


        $saved = $this->syncOrdered(
            Destination::class,
            $items,
            fn ($item, $index) => [
                'name' => $item['nama'],
                'description' =>
                    $item['deskripsi']
                    ?? null,
                'route' =>
                    $item['rute']
                    ?? null,
                'image_path' =>
                    $item['gambarPath']
                    ?? $item['gambarPreview']
                    ?? null,
                'sort_order' => $index,
                'is_active' => true,
            ]
        );


        return response()->json([
            'message' => 'Data destinasi berhasil disimpan.',
            'data' => collect($saved)
                ->map(
                    fn ($item) =>
                    $this->destinationPayload($item)
                )
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | RUTE & HARGA
    |--------------------------------------------------------------------------
    */

    public function routes()
    {
        return view('admin.rute-harga', [
            'rute' => RentalRoute::orderBy('sort_order')
                ->get()
                ->map(
                    fn ($item) =>
                    $this->routePayload($item)
                )
                ->values(),
        ]);
    }

    public function updateRoutes(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable'],

            'items.*.nama_destinasi' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.deskripsi_rute' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.harga_elf_long' => ['nullable'],

            'items.*.harga_medium_bus' => ['nullable'],

            'items.*.kategori' => [
                'nullable',
                'string',
                'max:100',
            ],

            'items.*.gambarPath' => [
                'nullable',
                'string',
            ],

            'items.*.gambarPreview' => [
                'nullable',
                'string',
            ],
        ])['items'];


        $saved = $this->syncOrdered(
            RentalRoute::class,
            $items,
            fn ($item, $index) => [
                'destination_name' =>
                    $item['nama_destinasi'],

                'route_description' =>
                    $item['deskripsi_rute']
                    ?? null,

                'elf_long_price' =>
                    $this->price(
                        $item['harga_elf_long']
                        ?? null
                    ),

                'medium_bus_price' =>
                    $this->price(
                        $item['harga_medium_bus']
                        ?? null
                    ),

                'category' =>
                    $item['kategori']
                    ?? null,

                'image_path' =>
                    $item['gambarPath']
                    ?? $item['gambarPreview']
                    ?? null,

                'sort_order' => $index,
                'is_active' => true,
            ]
        );


        return response()->json([
            'message' => 'Data rute & harga berhasil disimpan.',
            'data' => collect($saved)
                ->map(
                    fn ($item) =>
                    $this->routePayload($item)
                )
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CARA PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function orderSteps()
    {
        return view('admin.cara-pesan', [
            'langkah' => OrderStep::orderBy('sort_order')
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'judul' => $item->title,
                    'deskripsi' => $item->description,
                ])
                ->values(),
        ]);
    }

    public function updateOrderSteps(Request $request): JsonResponse
    {
        $items = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['nullable'],

            'items.*.judul' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.deskripsi' => [
                'nullable',
                'string',
            ],
        ])['items'];


        $saved = $this->syncOrdered(
            OrderStep::class,
            $items,
            fn ($item, $index) => [
                'title' => $item['judul'],
                'description' =>
                    $item['deskripsi']
                    ?? null,
                'sort_order' => $index,
                'is_active' => true,
            ]
        );


        return response()->json([
            'message' =>
                'Data cara pemesanan berhasil disimpan.',

            'data' => collect($saved)
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'judul' => $item->title,
                    'deskripsi' => $item->description,
                ])
                ->values(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | KONTAK
    |--------------------------------------------------------------------------
    */

    public function contact()
{
    $contact = ContactSetting::firstOrCreate();

    return view('admin.kontak', [
        'kontak' => [
            'deskripsi' => $contact->description,
            'alamat' => $contact->address,

            'whatsapp' => $contact->whatsapps()
    ->orderBy('sort_order')
    ->get()
    ->map(fn ($item) => [
        'id' => $item->id,
        'nomor' => $item->phone_number,
    ])
    ->values(),

            'email' => $contact->email,
            'instagram' => $contact->instagram,
            'facebook' => $contact->facebook,
            'youtube' => $contact->youtube,
        ],
    ]);
}

    public function updateContact(Request $request): JsonResponse
{
    $data = $request->validate([
        'deskripsi' => ['nullable', 'string'],
        'alamat' => ['nullable', 'string'],
        'maps_link' => ['nullable', 'string'],
        
        'whatsapp' => ['nullable', 'array'],
        'whatsapp.*.nomor' => ['required', 'string', 'max:50'],

        'email' => ['nullable', 'email', 'max:255'],
        'instagram' => ['nullable', 'string', 'max:500'],
        'facebook' => ['nullable', 'string', 'max:500'],
        'youtube' => ['nullable', 'string', 'max:500'],
        'tiktok' => ['nullable', 'string', 'max:500'],
    ]);

    $contact = ContactSetting::firstOrNew();

    $contact->fill([
        'description' => $data['deskripsi'] ?? null,
        'address' => $data['alamat'] ?? null,
        'maps_link' => $data['maps_link'] ?? null,
        'email' => $data['email'] ?? null,
        'instagram' => $data['instagram'] ?? null,
        'facebook' => $data['facebook'] ?? null,
        'youtube' => $data['youtube'] ?? null,
        'tiktok' => $data['tiktok'] ?? null,
    ]);

    $contact->save();

    // Hapus nomor WhatsApp lama
    $contact->whatsapps()->delete();

    // Simpan nomor WhatsApp baru
    foreach ($data['whatsapp'] ?? [] as $index => $whatsapp) {

        if (empty($whatsapp['nomor'])) {
            continue;
        }

        $contact->whatsapps()->create([
            'phone_number' => $whatsapp['nomor'],
            'sort_order' => $index,
        ]);
    }

    return response()->json([
        'message' => 'Data kontak berhasil disimpan.',

        'data' => [
            'deskripsi' => $contact->description,
            'alamat' => $contact->address,
            'maps_link' => $contact->maps_link,

            'whatsapp' => $contact->whatsapps()
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'nomor' => $item->phone_number,
                ])
                ->values(),

            'email' => $contact->email,
            'instagram' => $contact->instagram,
            'facebook' => $contact->facebook,
            'youtube' => $contact->youtube,
            'tiktok' => $contact->tiktok,
        ],
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | HELPER SYNC ORDERED
    |--------------------------------------------------------------------------
    */

    private function syncOrdered(
        string $modelClass,
        array $items,
        callable $attributes
    ): array {

        return DB::transaction(function () use (
            $modelClass,
            $items,
            $attributes
        ) {

            $keep = [];
            $saved = [];


            foreach ($items as $index => $item) {

                /** @var Model|null $model */
                $model = null;


                if (
                    !empty($item['id']) &&
                    ctype_digit((string) $item['id'])
                ) {
                    $model = $modelClass::find(
                        (int) $item['id']
                    );
                }


                if (!$model) {
                    $model = new $modelClass();
                }


                $model
                    ->fill(
                        $attributes($item, $index)
                    )
                    ->save();


                $keep[] = $model->id;

                $saved[] = $model->fresh();
            }


            $modelClass::whereNotIn(
                'id',
                $keep
            )->delete();


            return $saved;
        });
    }


    /*
    |--------------------------------------------------------------------------
    | PAYLOAD
    |--------------------------------------------------------------------------
    */

    private function heroPayload(
        HeroSection $hero
    ): array {

        return [
            'judul' =>
                $hero->title,

            'sub_deskripsi' =>
                $hero->description,

            'tombol_label' =>
                $hero->primary_button_label,

            'tombol_link' =>
                $hero->primary_button_url,

            'gambar' =>
                $this->mediaUrl(
                    $hero->image_path
                ),

            'gambar_path' =>
                $hero->image_path,

            'gambar_nama' =>
                $hero->image_alt
                ?: 'Arjuna Trans - Pariwisata',

            'gambar_keterangan' =>
                'Background hero landing page',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | PAYLOAD LAYANAN
    |--------------------------------------------------------------------------
    */

    private function layananPayload(
        Layanan $item
    ): array {

        return [
            'id' =>
                $item->id_layanan,

            /*
             * Tabel layanan belum memiliki
             * kolom ikon.
             *
             * Untuk sementara ikon dibuat null.
             */
            'ikon' => null,

            'judul' =>
                $item->jenis_layanan,

            'deskripsi' =>
                $item->deskripsi,

            'gambarPath' =>
                $item->gambar,

            'gambarPreview' =>
                $this->mediaUrl(
                    $item->gambar
                ),
        ];
    }


    private function fleetPayload(
        Fleet $item
    ): array {

        return [
            'id' => $item->id,
            'nama' => $item->name,
            'kategori' => $item->category,
            'deskripsi' => $item->description,
            'kapasitas' => $item->capacity,
            'fasilitas' => $item->facilities,
            'gambarPath' => $item->image_path,
            'gambarPreview' =>
                $this->mediaUrl(
                    $item->image_path
                ),
        ];
    }


    private function destinationPayload(
        Destination $item
    ): array {

        return [
            'id' => $item->id,
            'nama' => $item->name,
            'deskripsi' => $item->description,
            'rute' => $item->route,
            'gambarPath' => $item->image_path,
            'gambarPreview' =>
                $this->mediaUrl(
                    $item->image_path
                ),
        ];
    }


    private function routePayload(
        RentalRoute $item
    ): array {

        return [
            'id' => $item->id,

            'nama_destinasi' =>
                $item->destination_name,

            'deskripsi_rute' =>
                $item->route_description,

            'harga_elf_long' =>
                (string) (
                    $item->elf_long_price
                    ?? 0
                ),

            'harga_medium_bus' =>
                (string) (
                    $item->medium_bus_price
                    ?? 0
                ),

            'kategori' =>
                $item->category,

            'gambarPath' =>
                $item->image_path,

            'gambarPreview' =>
                $this->mediaUrl(
                    $item->image_path
                ),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | MEDIA URL
    |--------------------------------------------------------------------------
    */

    private function mediaUrl(
        ?string $path
    ): ?string {

        if (!$path) {
            return null;
        }


        if (
            str_starts_with(
                $path,
                'http://'
            )
            ||
            str_starts_with(
                $path,
                'https://'
            )
            ||
            str_starts_with(
                $path,
                'data:'
            )
        ) {
            return $path;
        }


        return asset(
            'storage/' .
            ltrim($path, '/')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PRICE
    |--------------------------------------------------------------------------
    */

    private function price(
        mixed $value
    ): ?int {

        if (
            $value === null ||
            $value === ''
        ) {
            return null;
        }


        $clean = preg_replace(
            '/\D+/',
            '',
            (string) $value
        );


        return $clean === ''
            ? null
            : (int) $clean;
    }
}