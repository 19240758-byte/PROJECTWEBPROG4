<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Guide;
use App\Models\Equipment;
use App\Models\Destination;    // ← TAMBAH INI!
use Illuminate\Support\Str;    // ← TAMBAH INI (untuk Str::slug)

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ADMIN - UPDATE OR CREATE (ANTI DUPLICATE)
        $admin = User::updateOrCreate(
            ['email' => 'admin@purwoguide.com'],
            [
                'name' => 'Admin PurwoGuide',
                'password' => Hash::make('password'),
                'phone' => '085712345678'
            ]
        );
        UserProfile::updateOrCreate(
            ['user_id' => $admin->id],
            ['location' => 'Purwokerto', 'role' => 'admin']
        );

        // GUIDE 1
        $guideUser1 = User::updateOrCreate(
            ['email' => 'budi@guide.com'],
            [
                'name' => 'Pak Budi Guide Baturraden',
                'password' => Hash::make('password'),
                'phone' => '085712345679'
            ]
        );
        Guide::updateOrCreate(
            ['user_id' => $guideUser1->id],
            [
                'name' => 'Budi Santoso',
                'phone' => '085712345679',
                'bio' => 'Guide berpengalaman 10 tahun di Baturraden & Cipendok. Spesialis trekking dan camping.',
                'hourly_rate' => 75000,
                'is_certified' => true,
                'status' => 'active'
            ]
        );
        UserProfile::updateOrCreate(
            ['user_id' => $guideUser1->id],
            ['location' => 'Baturraden', 'role' => 'guide']
        );

        // GUIDE 2
        $guideUser2 = User::updateOrCreate(
            ['email' => 'sari@guide.com'],
            [
                'name' => 'Bu Sari Guide Keluarga',
                'password' => Hash::make('password'),
                'phone' => '085712345680'
            ]
        );
        Guide::updateOrCreate(
            ['user_id' => $guideUser2->id],
            [
                'name' => 'Sari Wulandari',
                'phone' => '085712345680',
                'bio' => 'Guide wanita spesialis wisata keluarga Telaga Sunyi.',
                'hourly_rate' => 65000,
                'is_certified' => true,
                'status' => 'active'
            ]
        );

        // RENTER
        $renterUser = User::updateOrCreate(
            ['email' => 'rental@purwoguide.com'],
            [
                'name' => 'Rental Alat Purwokerto',
                'password' => Hash::make('password'),
                'phone' => '085712345681'
            ]
        );
        UserProfile::updateOrCreate(
            ['user_id' => $renterUser->id],
            ['location' => 'Purwokerto', 'role' => 'renter']
        );

        // EQUIPMENT 1
        Equipment::updateOrCreate(
            ['name' => 'Sepeda Gunung Trekking'],
            [
                'user_id' => $renterUser->id,
                'description' => 'Sepeda gunung full suspension untuk trekking Baturraden',
                'photo' => 'sepeda.jpg',
                'daily_rate' => 150000,
                'stock' => 10,
                'available_stock' => 8,
                'category' => 'sepeda',
                'status' => 'available'
            ]
        );

        // EQUIPMENT 2
        Equipment::updateOrCreate(
            ['name' => 'Tenda Camping 4 Orang'],
            [
                'user_id' => $renterUser->id,
                'description' => 'Tenda waterproof berkualitas tinggi kapasitas 4 orang',
                'photo' => 'tenda.jpg',
                'daily_rate' => 75000,
                'stock' => 15,
                'available_stock' => 12,
                'category' => 'camping',
                'status' => 'available'
            ]
        );
        // DESTINASI PURWOKERTO
$destinations = [
    [
        'name' => 'Telaga Sunyi',
        'description' => 'Telaga Sunyi adalah salah satu destinasi wisata alam yang tersembunyi di kawasan Baturraden, Purwokerto. Sesuai namanya, tempat ini menawarkan suasana yang tenang, sejuk, dan jauh dari keramaian, cocok untuk melepas penat dari aktivitas sehari-hari..',
        'photo' => '"https://imgbb.com/"><img src="https://i.ibb.co.com/whg8qTJ7/images.jpg" ',
        'distance_from_purwokerto' => 15,
        'difficulty_level' => 2.5,
        'category' => 'gunung',
        'guide_recommended' => true
    ],
    [
        'name' => 'Curug Cipendok',
        'description' => 'Air terjun setinggi 90 meter dengan kolam alami yang Instagramable.',
        'photo' => 'cipendok.jpg',
        'distance_from_purwokerto' => 25,
        'difficulty_level' => 4.0,
        'category' => 'air terjun',
        'guide_recommended' => true
    ],
    [
        'name' => 'Telaga Sunyi',
        'description' => 'Danau misterius di tengah hutan dengan air jernih dan suasana tenang.',
        'photo' => 'telaga-sunyi.jpg',
        'distance_from_purwokerto' => 35,
        'difficulty_level' => 3.5,
        'category' => 'danau',
        'guide_recommended' => true
    ],
    [
        'name' => 'Bukit Bintang',
        'description' => 'Spot camping dan sunrise terbaik dengan pemandangan 360°.',
        'photo' => 'bukit-bintang.jpg',
        'distance_from_purwokerto' => 20,
        'difficulty_level' => 3.0,
        'category' => 'gunung',
        'guide_recommended' => false
    ]
];

foreach ($destinations as $dest) {
    Destination::updateOrCreate(
        ['slug' => $dest['slug'] ?? Str::slug($dest['name'])],
        $dest
    );
}
    }
}
