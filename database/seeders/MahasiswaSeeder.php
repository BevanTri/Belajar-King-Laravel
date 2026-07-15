<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Bevan Tri Ramadiyas',
                'nim' => '3337250063',
                'prodi' => 'Informatika',
                'angkatan' => 2025,
                'ipk' => 3.88,
                'email' => 'bevantriramadiyas@gmail.com',
                'github' => 'https://github.com/bevantri',
                'bio' => 'Mahasiswa Informatika UNTIRTA yang semangat belajar teknologi web.',
            ],
            [
                'nama' => 'Barliano Gigari Setiawan',
                'nim' => '3337250057',
                'prodi' => 'Informatika',
                'angkatan' => 2025,
                'ipk' => 4,
                'email' => 'barligsetiawan@gmail.com',
                'github' => 'https://github.com/TheBarli',
                'bio' => 'Saya adalah mahasiswa Informatika UNTIRTA yang bersemangat belajar teknologi web.',
            ],
            [
                'nama' => 'Radityo Budi Waskito',
                'nim' => '3337250058',
                'prodi' => 'Informatika',
                'angkatan' => 2025,
                'ipk' => 4,
                'email' => 'radityobudiw@gmail.com',
                'github' => 'https://github.com/radityobw',
                'bio' => 'Belajar Hal-Hal Baru, untuk saat ini Cyber Security',
            ],
            [
                'nama' => 'Wildan Helmi Fahrezi',
                'nim' => '3337250078',
                'prodi' => 'Informatika',
                'angkatan' => 2025,
                'ipk' => 4,
                'email' => 'wildanhelmi81@gmail.com',
                'github' => 'https://github.com/wildanhelmi',
                'bio' => 'Saya adalah mahasiswa Informatika UNTIRTA yang bersemangat belajar teknologi web.',
            ],
            [
                'nama' => 'Alvin Yafiq Firas',
                'nim' => '3337250072',
                'prodi' => 'Informatika',
                'angkatan' => 2025,
                'ipk' => 4,
                'email' => 'yafiqfiras0@gmail.com',
                'github' => 'https://github.com/yafiqfiras14',
                'bio' => 'Saya adalah mahasiswa Informatika Fakultas Teknik UNTIRTA angkatan 2025. Saya senang mempelajari dunia web development dan terus mengembangkan kemampuan dalam HTML, CSS, JavaScript, PHP, serta Git.',
            ],
        ];

        foreach ($data as $item) {
            Mahasiswa::create($item);
        }
    }
}
