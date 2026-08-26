<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\Advantage;
use App\Models\ContactSetting;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\HeroSection;
use App\Models\OrderStep;
use App\Models\RentalRoute;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Arjuna Trans',
            'email' => 'admin@arjunatrans.test',
        ]);

        HeroSection::create([
            'badge' => 'Mitra Perjalanan Terpercaya',
            'title' => 'Eksplorasi Perjalanan Tanpa Batas dengan Kenyamanan Eksekutif',
            'description' => 'Hadir dengan layanan door-to-door, Arjuna Trans memastikan setiap detik perjalanan wisata Anda menjadi momen berharga yang nyaman dan aman.',
            'primary_button_label' => 'Booking Perjalanan',
            'primary_button_url' => '#cara-pesan',
            'secondary_button_label' => 'WhatsApp Admin',
            'secondary_button_url' => 'https://wa.me/628124320296',
            'image_path' => 'https://picsum.photos/seed/arjuna-hero/1600/900',
            'image_alt' => 'Armada Arjuna Trans',
        ]);

        collect([
            ['manage_accounts', 'Kru Handal', 'Pengemudi terlatih Defensive Driving Course dengan standar Pelayanan Prima setiap hari.'],
            ['ads_click', 'Reservasi Mudah', 'Proses booking transparan, cepat, dan aman langsung via WhatsApp atau sistem kami.'],
            ['verified', 'Legalitas Resmi', 'Legalitas dan operasional resmi untuk memberikan rasa aman selama perjalanan.'],
            ['build', 'Unit Terawat', 'Pengecekan teknis berkala oleh mekanik ahli agar kendaraan selalu siap jalan.'],
        ])->each(fn ($row, $index) => Advantage::create([
            'icon' => $row[0], 'title' => $row[1], 'description' => $row[2], 'sort_order' => $index,
        ]));

        collect([
            ['directions_bus', 'Bus Charter', 'Jasa penyewaan bus secara premium untuk berbagai kebutuhan perjalanan Anda.', 'https://picsum.photos/seed/charter/800/520'],
            ['groups', 'Company/Group Outing', 'Solusi transportasi terpercaya untuk kegiatan gathering, outing, dan perjalanan korporat.', 'https://picsum.photos/seed/outing/800/520'],
            ['school', 'School Bus', 'Layanan transportasi antar-jemput sekolah yang aman, nyaman, dan tepat waktu.', 'https://picsum.photos/seed/school/800/520'],
            ['mosque', 'Religious Journey', 'Pendamping perjalanan religi dan ziarah dengan fasilitas yang mendukung kenyamanan ibadah.', 'https://picsum.photos/seed/religious/800/520'],
        ])->each(fn ($row, $index) => Service::create([
            'icon' => $row[0], 'title' => $row[1], 'description' => $row[2], 'image_path' => $row[3], 'sort_order' => $index,
        ]));

        $about = AboutSection::create([
            'eyebrow' => 'Tentang Kami',
            'title' => 'Mendefinisikan Ulang Perjalanan Wisata Anda',
            'description' => 'Kami mengerti bahwa perjalanan bukan hanya soal berpindah tempat, tetapi tentang kenyamanan selama di perjalanan. Dengan pilihan armada yang terawat, Arjuna Trans hadir menemani kebutuhan transportasi wisata Anda.',
            'vision' => 'Menjadi mitra transportasi pilihan yang mengutamakan keselamatan, kenyamanan, dan pelayanan profesional.',
            'mission' => 'Memberikan layanan perjalanan yang aman, tepat waktu, bersih, dan ramah untuk setiap pelanggan.',
        ]);
        collect([
            'https://picsum.photos/seed/arjuna-about-1/600/760',
            'https://picsum.photos/seed/arjuna-about-2/600/760',
            'https://picsum.photos/seed/arjuna-about-3/600/760',
            'https://picsum.photos/seed/arjuna-about-4/600/760',
        ])->each(fn ($image, $index) => $about->galleryImages()->create([
            'image_path' => $image, 'alt_text' => 'Galeri armada Arjuna Trans', 'sort_order' => $index,
        ]));

        collect([
            ['Bus Medium Pariwisata', 'Medium Bus', 'Ideal untuk rombongan instansi atau gathering keluarga besar.', '34 Seat', 'Full AC', 4, 3200000, 'https://picsum.photos/seed/bus-medium/700/520'],
            ['Isuzu Elf Long', 'Elf', 'Lincah dan nyaman untuk perjalanan antar kota yang efisien.', '19 Seat', 'Reclining Seat', 3, 1800000, 'https://picsum.photos/seed/elf-long/700/520'],
            ['Kabin Executive', 'Premium', 'Interior premium untuk perjalanan yang lebih nyaman.', '12 Seat', 'Karaoke, Smart TV', 2, 2200000, 'https://picsum.photos/seed/executive-cabin/700/520'],
            ['Unit Premium Red', 'VIP', 'Unit premium untuk perjalanan privat dan eksklusif.', '10 Seat', 'VIP Unit, Large Cabin', 2, 2500000, 'https://picsum.photos/seed/premium-red/700/520'],
        ])->each(fn ($row, $index) => Fleet::create([
            'name' => $row[0], 'category' => $row[1], 'description' => $row[2], 'capacity' => $row[3], 'facilities' => $row[4], 'unit_count' => $row[5], 'daily_price' => $row[6], 'image_path' => $row[7], 'sort_order' => $index,
        ]));

        collect([
            ['Wisata Pantai Malang', 'Pantai Balekambang, Sendang Biru, hingga Teluk Asmara.', 'Malang Selatan Route', 'https://picsum.photos/seed/pantai-malang/700/520'],
            ['Ziarah Wali 5', 'Rute religi penuh makna dengan fasilitas pendukung ibadah.', 'East Java Pilgrimage Route', 'https://picsum.photos/seed/wali-5/700/520'],
            ['Santerra De Laponte', 'Wisata tematik dengan spot foto instagramable di Malang.', 'Malang City Tour', 'https://picsum.photos/seed/santerra/700/520'],
            ['Pantai Gemah', 'Pantai dengan pemandangan indah untuk perjalanan keluarga.', 'Trenggalek Route', 'https://picsum.photos/seed/pantai-gemah/700/520'],
        ])->each(fn ($row, $index) => Destination::create([
            'name' => $row[0], 'description' => $row[1], 'route' => $row[2], 'image_path' => $row[3], 'sort_order' => $index,
        ]));

        collect([
            ['Trenggalek', 'Rute Pantai Prigi & Pasir Putih', 1800000, 3400000, 'popular', 'https://picsum.photos/seed/trenggalek/700/520'],
            ['Wali 5', 'Ziarah Religi Jawa Timur', 1850000, 2750000, 'wisata_religi', 'https://picsum.photos/seed/wali5-route/700/520'],
            ['Surabaya', 'City Tour & Shopping', 1500000, 2500000, 'metropolitan', 'https://picsum.photos/seed/surabaya/700/520'],
            ['Bromo', 'Sunrise & Adventure', 2200000, 3500000, 'adventure', 'https://picsum.photos/seed/bromo/700/520'],
        ])->each(fn ($row, $index) => RentalRoute::create([
            'destination_name' => $row[0], 'route_description' => $row[1], 'elf_long_price' => $row[2], 'medium_bus_price' => $row[3], 'category' => $row[4], 'image_path' => $row[5], 'sort_order' => $index,
        ]));

        collect([
            ['Informasi Ketersediaan', 'Hubungi Customer Service kami via WhatsApp untuk menanyakan ketersediaan armada pada tanggal yang Anda inginkan.'],
            ['Konfirmasi Titik Jemput', 'Berikan detail alamat penjemputan dan rute tujuan. Kami akan mengirimkan rincian perjalanan kepada Anda.'],
            ['Penjemputan Tepat Waktu', 'Sopir kami akan menghubungi Anda sebelum keberangkatan untuk memastikan posisi penjemputan.'],
            ['Pembayaran Akhir', 'Lakukan pelunasan sesuai kesepakatan sebelum perjalanan dimulai atau melalui metode pembayaran yang tersedia.'],
        ])->each(fn ($row, $index) => OrderStep::create([
            'title' => $row[0], 'description' => $row[1], 'sort_order' => $index,
        ]));

        ContactSetting::create([
            'description' => 'Arjuna Trans melayani kebutuhan transportasi wisata dan perjalanan rombongan dengan armada terawat dan pelayanan profesional.',
            'address' => 'Perumahan Griya Mojokerto, Jawa Timur, Indonesia',
            'whatsapp' => '0812 4320 296',
            'email' => 'info@arjunatrans.id',
            'instagram' => 'https://instagram.com/arjunatrans',
            'facebook' => 'https://facebook.com/arjunatrans',
            'youtube' => 'https://youtube.com/@arjunatrans',
        ]);
    }
}
