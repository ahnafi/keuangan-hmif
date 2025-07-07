<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bph = \App\Models\Division::create(['name' => 'Badan Pengurus Harian']);
        $kreus = \App\Models\Division::create(['name' => 'Kreasi dan Usaha']);
        $iltek = \App\Models\Division::create(['name' => 'Keilmuan dan Teknologi']);
        $edu = \App\Models\Division::create(['name' => 'Edukasi']);
        $medkom = \App\Models\Division::create(['name' => 'Media Komunikasi dan Informasi']);
        $humas = \App\Models\Division::create(['name' => 'Hubungan Masyarakat']);
        $mikat = \App\Models\Division::create(['name' => 'Minat dan Bakat']);
        $psdm = \App\Models\Division::create(['name' => 'Pengembangan Sumber Daya Mahasiswa']);

        // Data dari HTML table
        $administrators = [
            // BPH
            ['name' => 'Muhammad Ilham Rafiqi', 'division_id' => $bph->id],
            ['name' => 'Revalina Fidya Anugrah', 'division_id' => $bph->id],
            ['name' => 'Ayu Fitriyaningsih', 'division_id' => $bph->id],
            ['name' => 'Fina Julianti', 'division_id' => $bph->id],
            ['name' => 'Dimas Rafif Zaidan', 'division_id' => $bph->id],
            ['name' => 'Naila Alifatul Mabruroh', 'division_id' => $bph->id],
            ['name' => 'Talitha Novelia Salsabila', 'division_id' => $bph->id],
            ['name' => 'Amalia Maharani Andessy', 'division_id' => $bph->id],
            ['name' => 'Nayla Octavia Ramadhani', 'division_id' => $bph->id],

            // EDUKASI
            ['name' => 'Dwi Bagus Purwo Aji', 'division_id' => $edu->id],
            ['name' => 'Ariza Nola Rufiana', 'division_id' => $edu->id],
            ['name' => 'Alya Luthfi Kharimah', 'division_id' => $edu->id],
            ['name' => 'Wendy Virtus', 'division_id' => $edu->id],
            ['name' => 'Bunga Budi Ambar Wati', 'division_id' => $edu->id],
            ['name' => 'Hafizh Naufal Raditya', 'division_id' => $edu->id],
            ['name' => 'Maharani Tri Wahyuningrum', 'division_id' => $edu->id],

            // HUMAS
            ['name' => 'Dyah Ghaniya Putri', 'division_id' => $humas->id],
            ['name' => 'Nadine Ariesta', 'division_id' => $humas->id],
            ['name' => 'Yoga Adi Nugraha', 'division_id' => $humas->id],
            ['name' => 'Huriyatun Nur Anajmi', 'division_id' => $humas->id],
            ['name' => 'Aisyah Syifa Karima', 'division_id' => $humas->id],
            ['name' => 'Khansa Nur Khalisah', 'division_id' => $humas->id],
            ['name' => 'Ali Muhammad Firdaus', 'division_id' => $humas->id],
            ['name' => 'Muhammad Rezqy Robiansyah', 'division_id' => $humas->id],
            ['name' => 'Putri Isnaini Laksita Utami', 'division_id' => $humas->id],

            // ILTEK
            ['name' => 'Athallah Tsany Satriyaji', 'division_id' => $iltek->id],
            ['name' => 'Refa Hasanah', 'division_id' => $iltek->id],
            ['name' => 'Atik Ahnafi Sulthon', 'division_id' => $iltek->id],
            ['name' => 'Firyal Aufa Fahrudin', 'division_id' => $iltek->id],
            ['name' => 'Muhammad Zaki Dzulfikar', 'division_id' => $iltek->id],
            ['name' => 'Iven Rival Pangestu', 'division_id' => $iltek->id],
            ['name' => 'Melysa Ayu Wulan Sari', 'division_id' => $iltek->id],
            ['name' => 'Raihan Dwi Ananda Harvian', 'division_id' => $iltek->id],
            ['name' => 'Naufal Satrio Putra', 'division_id' => $iltek->id],

            // KREUS
            ['name' => 'Novia Rizky Aryani', 'division_id' => $kreus->id],
            ['name' => 'Rajendra Rangga Priyatama', 'division_id' => $kreus->id],
            ['name' => 'Mukhammad Alfaen Fadillah', 'division_id' => $kreus->id],
            ['name' => 'Finda Wulan Febrianti', 'division_id' => $kreus->id],
            ['name' => 'Ahmad Zaky', 'division_id' => $kreus->id],
            ['name' => 'Dera Amelia', 'division_id' => $kreus->id],
            ['name' => 'Gerard Roland Kusuma Sarwoko', 'division_id' => $kreus->id],
            ['name' => 'Nesa Dwi Cahyani', 'division_id' => $kreus->id],

            // MEDKOM
            ['name' => 'Nadzare Kafah Alfatiha', 'division_id' => $medkom->id],
            ['name' => 'Muhammad Zacky Makarim', 'division_id' => $medkom->id],
            ['name' => 'Salma Faizatul Jannah', 'division_id' => $medkom->id],
            ['name' => 'Atika Cinta Khaerunnisa', 'division_id' => $medkom->id],
            ['name' => 'Daffa Salman Fauzan Santoso', 'division_id' => $medkom->id],
            ['name' => 'Diva Syahita Mawarni', 'division_id' => $medkom->id],
            ['name' => 'Salsabila Firzah Amanina', 'division_id' => $medkom->id],

            // MIKAT
            ['name' => 'Rafif Surya Murtadha', 'division_id' => $mikat->id],
            ['name' => 'Intan Ayu Tsalisatul Arifah', 'division_id' => $mikat->id],
            ['name' => 'Fawwaz Fatchurr Rozaq Athaillah', 'division_id' => $mikat->id],
            ['name' => 'Afif Nur Rahman', 'division_id' => $mikat->id],
            ['name' => 'Bagas Cahya Setiadi', 'division_id' => $mikat->id],
            ['name' => 'Yustinus Ergi Owen Sinaga', 'division_id' => $mikat->id],
            ['name' => 'Lula Khaisha Delavia', 'division_id' => $mikat->id],
            ['name' => 'Zainab Feizia', 'division_id' => $mikat->id],

            // PSDM
            ['name' => 'Tsaqif Hasbi Aghna Syarief', 'division_id' => $psdm->id],
            ['name' => 'Hana Naila Rahmadina', 'division_id' => $psdm->id],
            ['name' => 'Qayla Zahra Era Putri', 'division_id' => $psdm->id],
            ['name' => 'Gilang Happy Dwinugroho', 'division_id' => $psdm->id],
            ['name' => 'Muhammad Fikri Firmansyah', 'division_id' => $psdm->id],
            ['name' => 'Rizky Amelia Putri', 'division_id' => $psdm->id],
            ['name' => 'Talitha Maharani Nashier', 'division_id' => $psdm->id],
            ['name' => 'Windi Sulaiman Ismansa', 'division_id' => $psdm->id],
            ['name' => 'Yunan Faila Sofi', 'division_id' => $psdm->id],
        ];

        // Buat administrators
        foreach ($administrators as $adminData) {
            $admin = \App\Models\Administrator::create($adminData);
            $admin->cash()->create();
            $admin->deposit()->create();
        }
    }
}
