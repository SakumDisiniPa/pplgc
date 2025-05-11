<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiswaGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Siswa
        \App\Models\Siswa::insert([
            [
                'nis' => '202301001',
                'nama' => 'Andi Saputra',
                'jabatan' => 'Ketua Kelas',
                'foto' => 'siswa/andi.jpg',
                'instagram' => 'andisaputra'
            ],
            [
                'nis' => '202301002',
                'nama' => 'Budi Santoso',
                'jabatan' => 'Wakil Ketua',
                'foto' => 'siswa/budi.jpg',
                'instagram' => 'budisantoso'
            ],
            [
                'nis' => '202301003',
                'nama' => 'Citra Lestari',
                'jabatan' => 'Bendahara',
                'foto' => 'siswa/citra.jpg',
                'instagram' => 'citralestari'
            ],
            [
                'nis' => '202301004',
                'nama' => 'Doni Pratama',
                'jabatan' => 'Sekretaris',
                'foto' => 'siswa/doni.jpg',
                'instagram' => 'donipratama'
            ],
            [
                'nis' => '202301005',
                'nama' => 'Eka Wulandari',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/eka.jpg',
                'instagram' => 'ekawulan'
            ],
            [
                'nis' => '202301006',
                'nama' => 'Farhan Rizky',
                'jabatan' => 'Koordinator Kebersihan',
                'foto' => 'siswa/farhan.jpg',
                'instagram' => 'farhanrizky'
            ],
            [
                'nis' => '202301007',
                'nama' => 'Gita Anjani',
                'jabatan' => 'Koordinator Keamanan',
                'foto' => 'siswa/gita.jpg',
                'instagram' => 'gitaanjani'
            ],
            [
                'nis' => '202301008',
                'nama' => 'Hendra Wijaya',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/hendra.jpg',
                'instagram' => 'hendrawijaya'
            ],
            [
                'nis' => '202301009',
                'nama' => 'Intan Permata',
                'jabatan' => 'Koordinator Acara',
                'foto' => 'siswa/intan.jpg',
                'instagram' => 'intanpermata'
            ],
            [
                'nis' => '202301010',
                'nama' => 'Joko Susilo',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/joko.jpg',
                'instagram' => 'jokosusilo'
            ],
            // Tambahan murid biasa
            [
                'nis' => '202301011',
                'nama' => 'Kiki Ramadhani',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/kiki.jpg',
                'instagram' => 'kikiramadhani'
            ],
            [
                'nis' => '202301012',
                'nama' => 'Lukman Hakim',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/lukman.jpg',
                'instagram' => 'lukmanhakim'
            ],
            [
                'nis' => '202301013',
                'nama' => 'Melati Ayu',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/melati.jpg',
                'instagram' => 'melatiayu'
            ],
            [
                'nis' => '202301014',
                'nama' => 'Nanda Kusuma',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/nanda.jpg',
                'instagram' => 'nandakusuma'
            ],
            [
                'nis' => '202301015',
                'nama' => 'Oki Prabowo',
                'jabatan' => 'Anggota',
                'foto' => 'siswa/oki.jpg',
                'instagram' => 'okiprabowo'
            ],
        ]);

        // Data Guru
        \App\Models\Guru::insert([
            [
                'nip' => '198001012023011001',
                'nama' => 'Dr. Surya Adi, M.Pd',
                'jabatan' => 'Wali Kelas',
                'mapel' => 'Pemrograman Web',
                'no_hp' => '081234567890'
            ],
            [
                'nip' => '197512232023021002',
                'nama' => 'Ibu Rini Wahyuni, S.Pd',
                'jabatan' => 'Guru Mapel',
                'mapel' => 'Matematika',
                'no_hp' => '081298765432'
            ],
            [
                'nip' => '198512092023031003',
                'nama' => 'Pak Joko Priyono, S.Pd',
                'jabatan' => 'Guru Mapel',
                'mapel' => 'Bahasa Indonesia',
                'no_hp' => '082112345678'
            ],
        ]);
    }
}
