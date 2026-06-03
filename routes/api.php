<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Feeder\SatuDataController;


Route::post('get-token', [AuthController::class, 'getToken']);

Route::middleware(['auth:sanctum', 'check.api.access'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('mahasiswa-by-nim', [App\Http\Controllers\Api\MahasiswaController::class, 'index'])->name('api.mahasiswa-by-nim');
        
        // ✅ GET semua mahasiswa
        Route::get('mahasiswa-by-id-prodi', [App\Http\Controllers\Api\MahasiswaController::class, 'all_mahasiswa'])->name('api.mahasiswa-by-prodi');
        // // ✅ GET mahasiswa by id_reg
        // Route::get('mahasiswa-by-id-reg', [App\Http\Controllers\Api\MahasiswaController::class, 'mahasiswa_by_id_reg'])->name('api.mahasiswa-by-id-reg');
        // // ✅ GET AKM mahasiswa by id_reg
        Route::get('akm-by-nim', [App\Http\Controllers\Api\MahasiswaController::class, 'akm_by_nim'])->name('api.akm-by-nim');
        // ✅ GET mahasiswa Lulus DO by id_reg
        Route::get('lulus-do-by-nim', [App\Http\Controllers\Api\MahasiswaController::class, 'lulus_do_nim'])->name('api.lulus-do-by-nim');
        
        
        Route::prefix('feeder')->group(function () {
            Route::post('prodi', [SatuDataController::class, 'prodi'])->name('api.feeder.prodi');
            // ✅ GET semua prodi
            Route::get('get-prodi', [SatuDataController::class, 'get_prodi'])
                ->name('api.feeder.get-prodi');

            // ✅ GET detail prodi by id_prodi
            Route::get('program-studi/{id_prodi}', [SatuDataController::class, 'informasi_prodi'])
                ->name('api.feeder.program-studi.detail');

        });

    //✅ REFERENSI

        //✅ GET prodi
        Route::get('prodi', [SatuDataController::class, 'get_prodi'])->name('api.referensi.bu.get-prodi');
        //✅ GET agama
        Route::get('agama', [SatuDataController::class, 'get_agama'])->name('api.referensi.get-agama');
        //✅ GET All Prodi
        Route::get('all-prodi', [SatuDataController::class, 'get_all_prodi'])->name('api.referensi.get-all-prodi');
        //✅ GET akreditasi prodi
        Route::get('akreditasi-prodi', [SatuDataController::class, 'get_akreditasi_prodi'])->name('api.referensi.get-akreditasi-prodi');
        //✅ GET basis evaluasi
        Route::get('basis-evaluasi', [SatuDataController::class, 'get_basis_evaluasi'])->name('api.referensi.get-basis-evaluasi');
        //✅ GET alat transportasi
        Route::get('alat-transportasi', [SatuDataController::class, 'get_alat_transportasi'])->name('api.referensi.get-alat-transportasi');
        //✅ GET Bentuk Pendidikan
        Route::get('bentuk-pendidikan', [SatuDataController::class, 'get_bentuk_pendidikan'])->name('api.referensi.get-bentuk-pendidikan');
        //✅ GET Bidang Studi
        Route::get('bidang-studi', [SatuDataController::class, 'get_bidang_studi'])->name('api.referensi.get-bidang-studi');
        //✅ GET Bidang Usaha
        Route::get('bidang-usaha', [SatuDataController::class, 'get_bidang_usaha'])->name('api.referensi.get-bidang-usaha');
        //✅ GET fakultas
        Route::get('fakultas', [SatuDataController::class, 'get_fakultas'])->name('api.referensi.get-fakultas');
        //✅ GET gelar akademik
        Route::get('gelar-akademik', [SatuDataController::class, 'get_gelar_akademik'])->name('api.referensi.get-gelar-akademik');
        //✅ GET golongan pangkat
        Route::get('golongan-pangkat', [SatuDataController::class, 'get_golongan_pangkat'])->name('api.referensi.get-golongan-pangkat');
        // GET ikatan_kerja
        Route::get('ikatan-kerja', [SatuDataController::class, 'get_ikatan_kerja'])->name('api.referensi.get-ikatan-kerja');
        // GET ikatan_kerja_sdm
        Route::get('ikatan-kerja-sdm', [SatuDataController::class, 'get_ikatan_kerja_sdm'])->name('api.referensi.get-ikatan-kerja-sdm');
        // GET jabatan_fungsional
        Route::get('jabatan-fungsional', [SatuDataController::class, 'get_jabatan_fungsional'])->name('api.referensi.get-jabatan-fungsional');
        // GET jabatan_negara
        Route::get('jabatan-negara', [SatuDataController::class, 'get_jabatan_negara'])->name('api.referensi.get-jabatan-negara');
        // GET jabatan_tugas_tambahan
        Route::get('jabatan-tugas-tambahan', [SatuDataController::class, 'get_jabatan_tugas_tambahan'])->name('api.referensi.get-jabatan-tugas-tambahan');
        // GET jalur_masuk
        Route::get('jalur-masuk', [SatuDataController::class, 'get_jalur_masuk'])->name('api.referensi.get-jalur-masuk');
        // GET jenis_aktivitas_mahasiswa
        Route::get('jenis-aktivitas-mahasiswa', [SatuDataController::class, 'get_jenis_aktivitas_mahasiswa'])->name('api.referensi.get-jenis-aktivitas-mahasiswa');
        // GET jenis_beasiswa
        Route::get('jenis-beasiswa', [SatuDataController::class, 'get_jenis_beasiswa'])->name('api.referensi.get-jenis-beasiswa');
        // GET jenis_daftar
        Route::get('jenis-daftar', [SatuDataController::class, 'get_jenis_daftar'])->name('api.referensi.get-jenis-daftar');
        // GET jenis_diklat
        Route::get('jenis-diklat', [SatuDataController::class, 'get_jenis_diklat'])->name('api.referensi.get-jenis-diklat');
        // GET jenis_dokumen
        Route::get('jenis-dokumen', [SatuDataController::class, 'get_jenis_dokumen'])->name('api.referensi.get-jenis-dokumen');
        // GET jenis_evaluasi
        Route::get('jenis-evaluasi', [SatuDataController::class, 'get_jenis_evaluasi'])->name('api.referensi.get-jenis-evaluasi');
        // GET jenis_keluar
        Route::get('jenis-keluar', [SatuDataController::class, 'get_jenis_keluar'])->name('api.referensi.get-jenis-keluar');
        // GET jenis_kepanitiaan
        Route::get('jenis-kepanitiaan', [SatuDataController::class, 'get_jenis_kepanitiaan'])->name('api.referensi.get-jenis-kepanitiaan');
        // GET jenis_kesejahteraan
        Route::get('jenis-kesejahteraan', [SatuDataController::class, 'get_jenis_kesejahteraan'])->name('api.referensi.get-jenis-kesejahteraan');
        // GET jenis_mata_kuliah
        Route::get('jenis-mata-kuliah', [SatuDataController::class, 'get_jenis_mata_kuliah'])->name('api.referensi.get-jenis-mata-kuliah');
        // GET jenis_pekerjaan
        Route::get('jenis-pekerjaan', [SatuDataController::class, 'get_jenis_pekerjaan'])->name('api.referensi.get-jenis-pekerjaan');
        // GET jenis_penghargaan
        Route::get('jenis-penghargaan', [SatuDataController::class, 'get_jenis_penghargaan'])->name('api.referensi.get-jenis-penghargaan');
        // GET jenis_prestasi
        Route::get('jenis-prestasi', [SatuDataController::class, 'get_jenis_prestasi'])->name('api.referensi.get-jenis-prestasi');
        // GET jenis_publikasi
        Route::get('jenis-publikasi', [SatuDataController::class, 'get_jenis_publikasi'])->name('api.referensi.get-jenis-publikasi');
        // GET jenis_sertifikasi
        Route::get('jenis-sertifikasi', [SatuDataController::class, 'get_jenis_sertifikasi'])->name('api.referensi.get-jenis-sertifikasi');
        // GET jenis_sms
        Route::get('jenis-sms', [SatuDataController::class, 'get_jenis_sms'])->name('api.referensi.get-jenis-sms');
        // GET jenis_substansi
        Route::get('jenis-substansi', [SatuDataController::class, 'get_jenis_substansi'])->name('api.referensi.get-jenis-substansi');
        // GET jenis_tes
        Route::get('jenis-tes', [SatuDataController::class, 'get_jenis_tes'])->name('api.referensi.get-jenis-tes');
        // GET jenis_tinggal
        Route::get('jenis-tinggal', [SatuDataController::class, 'get_jenis_tinggal'])->name('api.referensi.get-jenis-tinggal');
        // GET jenis_tunjangan
        Route::get('jenis-tunjangan', [SatuDataController::class, 'get_jenis_tunjangan'])->name('api.referensi.get-jenis-tunjangan');
        // GET jenjang_pendidikan
        Route::get('jenjang-pendidikan', [SatuDataController::class, 'get_jenjang_pendidikan'])->name('api.referensi.get-jenjang-pendidikan');
        // GET detail_periode_perkuliahan
        Route::get('detail-periode-perkuliahan', [SatuDataController::class, 'get_detail_periode_perkuliahan'])->name('api.referensi.get-detail-periode-perkuliahan');

    // MAHASISWA
        // GET AKM
        Route::get('aktivitas-kuliah-mahasiswa', [SatuDataController::class, 'get_aktivitas_kuliah_mahasiswa'])->name('api.mahasiswa.get-aktivitas-kuliah-mahasiswa');
        // Get Biodata mahasiswa
        Route::get('biodata-mahasiswa', [SatuDataController::class, 'get_biodata_mahasiswa'])->name('api.mahasiswa.get-biodata-mahasiswa');
        



    // DOSEN
        // GET aktivitas_mengajar_dosen
        Route::get('aktivitas-mengajar-dosen', [SatuDataController::class, 'get_aktivitas_mengajar_dosen'])->name('api.dosen.get-aktivitas-mengajar-dosen');
        // GET biodata_dosen
        Route::get('biodata-dosen', [SatuDataController::class, 'get_biodata_dosen'])->name('api.dosen.get-biodata-dosen');
        // GET anggota_penelitian
        Route::get('anggota-penelitian', [SatuDataController::class, 'get_anggota_penelitian'])->name('api.dosen.get-anggota-penelitian');
        // GET basis_evaluasi
        Route::get('basis-evaluasi', [SatuDataController::class, 'get_basis_evaluasi'])->name('api.dosen.get-basis-evaluasi');
        // GET bentuk_pendidikan
        Route::get('bentuk-pendidikan', [SatuDataController::class, 'get_bentuk_pendidikan'])->name('api.dosen.get-bentuk-pendidikan');
        // GET bidang_ilmu_paten
        Route::get('bidang-ilmu-paten', [SatuDataController::class, 'get_bidang_ilmu_paten'])->name('api.dosen.get-bidang-ilmu-paten');
        // GET bidang_ilmu_publikasi
        Route::get('bidang-ilmu-publikasi', [SatuDataController::class, 'get_bidang_ilmu_publikasi'])->name('api.dosen.get-bidang-ilmu-publikasi');
        // GET bidang_keilmuan
        Route::get('bidang-keilmuan', [SatuDataController::class, 'get_bidang_keilmuan'])->name('api.dosen.get-bidang-keilmuan');
        // GET detail_ajuan_sertifikasi_dosen
        Route::get('detail-ajuan-sertifikasi-dosen', [SatuDataController::class, 'get_detail_ajuan_sertifikasi_dosen'])->name('api.dosen.get-detail-ajuan-sertifikasi-dosen');
        // GET detail_paten
        Route::get('detail-paten', [SatuDataController::class, 'get_detail_paten'])->name('api.dosen.get-detail-paten');
        // GET detail_pendidikan_formal
        Route::get('detail-pendidikan-formal', [SatuDataController::class, 'get_detail_pendidikan_formal'])->name('api.dosen.get-detail-pendidikan-formal');
        // GET detail_penelitian
        Route::get('detail-penelitian', [SatuDataController::class, 'get_detail_penelitian'])->name('api.dosen.get-detail-penelitian');
        // GET detail_penugasan_dosen
        Route::get('detail-penugasan-dosen', [SatuDataController::class, 'get_detail_penugasan_dosen'])->name('api.dosen.get-detail-penugasan-dosen');
        // GET dokumen
        Route::get('dokumen', [SatuDataController::class, 'get_dokumen'])->name('api.dosen.get-dokumen');
        // GET dokumen_paten
        Route::get('dokumen-paten', [SatuDataController::class, 'get_detail_paten'])->name('api.dosen.get-dokumen-paten');
        // GET dokumen_pendidikan_formal
        Route::get('dokumen-pendidikan-formal', [SatuDataController::class, 'get_detail_pendidikan_formal'])->name('api.dosen.get-dokumen-pendidikan-formal');
        // GET dokumen_penelitian
        Route::get('dokumen-penelitian', [SatuDataController::class, 'get_detail_penelitian'])->name('api.dosen.get-dokumen-penelitian');
        // GET dokumen_publikasi
        Route::get('dokumen-publikasi', [SatuDataController::class, 'get_dokumen_publikasi'])->name('api.dosen.get-dokumen-publikasi');
        // GET dosen_pembimbing
        Route::get('dosen-pembimbing', [SatuDataController::class, 'get_dosen_pembimbing'])->name('api.dosen.get-dosen-pembimbing');
        // GET dosen_pengajar_kelas_kuliah
        Route::get('dosen-pengajar-kelas-kuliah', [SatuDataController::class, 'get_dosen_pengajar_kelas_kuliah'])->name('api.dosen.get-dosen-pengajar-kelas-kuliah');
        Route::get('sister-list-ajuan_jabatan_fungsional', [SatuDataController::class, 'get_sister_list_ajuan_jabatan_fungsional'])->name('api.dosen.get_sister_list_ajuan_jabatan_fungsional');
        Route::get('sister-list-ajuan_kepangkatan', [SatuDataController::class, 'get_sister_list_ajuan_kepangkatan'])->name('api.dosen.get_sister_list_ajuan_kepangkatan');
        Route::get('sister-list-ajuan_nilai_tes', [SatuDataController::class, 'get_sister_list_ajuan_nilai_tes'])->name('api.dosen.get_sister_list_ajuan_nilai_tes');
        Route::get('sister-list-ajuan_pendidikan_formal', [SatuDataController::class, 'get_sister_list_ajuan_pendidikan_formal'])->name('api.dosen.get_sister_list_ajuan_pendidikan_formal');
        Route::get('sister-list-ajuan_sertifikasi_dosen', [SatuDataController::class, 'get_sister_list_ajuan_sertifikasi_dosen'])->name('api.dosen.get_sister_list_ajuan_sertifikasi_dosen');
        Route::get('sister-list-anggota_profesi', [SatuDataController::class, 'get_sister_list_anggota_profesi'])->name('api.dosen.get_sister_list_anggota_profesi');
        Route::get('sister-list-bahan_ajar', [SatuDataController::class, 'get_sister_list_bahan_ajar'])->name('api.dosen.get_sister_list_bahan_ajar');
        Route::get('sister-list-beasiswa', [SatuDataController::class, 'get_sister_list_beasiswa'])->name('api.dosen.get_sister_list_beasiswa');
        Route::get('sister-list-bimbingan_mahasiswa', [SatuDataController::class, 'get_sister_list_bimbingan_mahasiswa'])->name('api.dosen.get_sister_list_bimbingan_mahasiswa');
        Route::get('sister-list-datasering', [SatuDataController::class, 'get_sister_list_datasering'])->name('api.dosen.get_sister_list_datasering');
        Route::get('sister-list-diklat', [SatuDataController::class, 'get_sister_list_diklat'])->name('api.dosen.get_sister_list_diklat');
        Route::get('sister-list-inpassing', [SatuDataController::class, 'get_sister_list_inpassing'])->name('api.dosen.get_sister_list_inpassing');
        Route::get('sister-list-jabatan_fungsional', [SatuDataController::class, 'get_sister_list_jabatan_fungsional'])->name('api.dosen.get_sister_list_jabatan_fungsional');
        Route::get('sister-list-jabatan_struktural', [SatuDataController::class, 'get_sister_list_jabatan_struktural'])->name('api.dosen.get_sister_list_jabatan_struktural');
        Route::get('sister-list-kekayaan_intelektual', [SatuDataController::class, 'get_sister_list_kekayaan_intelektual'])->name('api.dosen.get_sister_list_kekayaan_intelektual');
        Route::get('sister-list-kepangkatan', [SatuDataController::class, 'get_sister_list_kepangkatan'])->name('api.dosen.get_sister_list_kepangkatan');
        Route::get('sister-list-kesejahteraan', [SatuDataController::class, 'get_sister_list_kesejahteraan'])->name('api.dosen.get_sister_list_kesejahteraan');
        Route::get('sister-list-nilai_tes', [SatuDataController::class, 'get_sister_list_nilai_tes'])->name('api.dosen.get_sister_list_nilai_tes');
        Route::get('sister-list-orasi_ilmiah', [SatuDataController::class, 'get_sister_list_orasi_ilmiah'])->name('api.dosen.get_sister_list_orasi_ilmiah');
        Route::get('sister-list-pembicara', [SatuDataController::class, 'get_sister_list_pembicara'])->name('api.dosen.get_sister_list_pembicara');
        Route::get('sister-list-penelitian', [SatuDataController::class, 'get_sister_list_penelitian'])->name('api.dosen.get_sister_list_penelitian');
        Route::get('sister-list-pendidikan_formal', [SatuDataController::class, 'get_sister_list_pendidikan_formal'])->name('api.dosen.get_sister_list_pendidikan_formal');
        Route::get('sister-list-pengabdian', [SatuDataController::class, 'get_sister_list_pengabdian'])->name('api.dosen.get_sister_list_pengabdian');
        Route::get('sister-list-pengajaran', [SatuDataController::class, 'get_sister_list_pengajaran'])->name('api.dosen.get_sister_list_pengajaran');
        Route::get('sister-list-pengelola_jurnal', [SatuDataController::class, 'get_sister_list_pengelola_jurnal'])->name('api.dosen.get_sister_list_pengelola_jurnal');
        Route::get('sister-list-penghargaan', [SatuDataController::class, 'get_sister_list_penghargaan'])->name('api.dosen.get_sister_list_penghargaan');
        Route::get('sister-list-pengujian_mahasiswa', [SatuDataController::class, 'get_sister_list_pengujian_mahasiswa'])->name('api.dosen.get_sister_list_pengujian_mahasiswa');
        Route::get('sister-list-penugasan', [SatuDataController::class, 'get_sister_list_penugasan'])->name('api.dosen.get_sister_list_penugasan');
        Route::get('sister-list-penunjang_lain', [SatuDataController::class, 'get_sister_list_penunjang_lain'])->name('api.dosen.get_sister_list_penunjang_lain');
        Route::get('sister-list-publikasi', [SatuDataController::class, 'get_sister_list_publikasi'])->name('api.dosen.get_sister_list_publikasi');
        Route::get('sister-list-riwayat-pekerjaan', [SatuDataController::class, 'get_sister_list_riwayat_pekerjaan'])->name('api.dosen.get_sister_list_riwayat_pekerjaan');
        Route::get('sister-list-sertifikasi-dosen', [SatuDataController::class, 'get_sister_list_sertifikasi_dosen'])->name('api.dosen.get_sister_list_sertifikasi_dosen');
        Route::get('sister-list-sertifikasi-profesi', [SatuDataController::class, 'get_sister_list_sertifikasi_profesi'])->name('api.dosen.get_sister_list_sertifikasi_profesi');
        Route::get('sister-list-tugas-tambahan', [SatuDataController::class, 'get_sister_list_tugas_tambahan'])->name('api.dosen.get_sister_list_tugas_tambahan');
        Route::get('sister-list-tunjangan', [SatuDataController::class, 'get_sister_list_tunjangan'])->name('api.dosen.get_sister_list_tunjangan');
        Route::get('sister-list-visiting-scientist', [SatuDataController::class, 'get_sister_list_visiting_scientist'])->name('api.dosen.get_sister_list_visiting_scientist');


    //PERKULIAHAN
        // GET detail_kelas_kuliah
        Route::get('detail-kelas-kuliah', [SatuDataController::class, 'get_detail_kelas_kuliah'])->name('api.perkuliahan.get-detail-kelas-kuliah');
        // GET detail_kurikulum
        Route::get('detail-kurikulum', [SatuDataController::class, 'get_detail_kurikulum'])->name('api.perkuliahan.get-detail-kurikulum');
        // GET detail_mata_kuliah
        Route::get('detail-mata-kuliah', [SatuDataController::class, 'get_detail_mata_kuliah'])->name('api.perkuliahan.get-detail-mata-kuliah');
        // GET detail_nilai_perkuliahan
        Route::get('detail-nilai-perkuliahan', [SatuDataController::class, 'get_detail_nilai_perkuliahan'])->name('api.perkuliahan.get-detail-nilai-perkuliahan');


        Route::get('kebutuhan-khusus', [SatuDataController::class, 'kebutuhan_khusus'])->name('api.referensi.kebutuhan-khusus');
        Route::get('kelompok-bidang', [SatuDataController::class, 'kelompok_bidang'])->name('api.referensi.kelompok-bidang');
        Route::get('kelompok-mata-kuliah', [SatuDataController::class, 'kelompok_mata_kuliah'])->name('api.referensi.kelompok-mata-kuliah');
        Route::get('konversi-kampus-merdeka', [SatuDataController::class, 'konversi_kampus_merdeka'])->name('api.referensi.konversi-kampus-merdeka');
        Route::get('krs-mahasiswa', [SatuDataController::class, 'krs_mahasiswa'])->name('api.referensi.krs-mahasiswa');
        Route::get('lembaga-pengangkat', [SatuDataController::class, 'lembaga_pengangkat'])->name('api.referensi.lembaga-pengangkat');
        Route::get('level-wilayah', [SatuDataController::class, 'level_wilayah'])->name('api.referensi.level-wilayah');
        Route::get('list-aktivitas-mahasiswa', [SatuDataController::class, 'list_aktivitas_mahasiswa'])->name('api.referensi.list-aktivitas-mahasiswa');
        Route::get('list-aktivitas-mahasiswa-copy', [SatuDataController::class, 'list_aktivitas_mahasiswa_copy'])->name('api.referensi.list-aktivitas-mahasiswa-copy');
        Route::get('list-anggota-aktivitas-mahasiswa', [SatuDataController::class, 'list_anggota_aktivitas_mahasiswa'])->name('api.referensi.list-anggota-aktivitas-mahasiswa');
        Route::get('list-bimbing-mahasiswa', [SatuDataController::class, 'list_bimbing_mahasiswa'])->name('api.referensi.list-bimbing-mahasiswa');
        Route::get('list-dosen', [SatuDataController::class, 'list_dosen'])->name('api.referensi.list-dosen');
        Route::get('list-kelas-kuliah', [SatuDataController::class, 'list_kelas_kuliah'])->name('api.referensi.list-kelas-kuliah');
        Route::get('list-kurikulum', [SatuDataController::class, 'list_kurikulum'])->name('api.referensi.list-kurikulum');
        Route::get('list-mahasiswa', [SatuDataController::class, 'list_mahasiswa'])->name('api.referensi.list-mahasiswa');
        Route::get('list-mahasiswa-lulus-do', [SatuDataController::class, 'list_mahasiswa_lulus_do'])->name('api.referensi.list-mahasiswa-lulus-do');
        Route::get('list-mahasiswa-lulus-do-bak', [SatuDataController::class, 'list_mahasiswa_lulus_do_bak'])->name('api.referensi.list-mahasiswa-lulus-do-bak');
        Route::get('list-nilai-perkuliahan', [SatuDataController::class, 'list_nilai_perkuliahan'])->name('api.referensi.list-nilai-perkuliahan');
        Route::get('list-pendidikan-formal', [SatuDataController::class, 'list_pendidikan_formal'])->name('api.referensi.list-pendidikan-formal');
        Route::get('list-penelitian', [SatuDataController::class, 'list_penelitian'])->name('api.referensi.list-penelitian');
        Route::get('list-penugasan-dosen', [SatuDataController::class, 'list_penugasan_dosen'])->name('api.referensi.list-penugasan-dosen');
        Route::get('list-periode-perkuliahan', [SatuDataController::class, 'list_periode_perkuliahan'])->name('api.referensi.list-periode-perkuliahan');
        Route::get('list-prestasi-mahasiswa', [SatuDataController::class, 'list_prestasi_mahasiswa'])->name('api.referensi.list-prestasi-mahasiswa');
        Route::get('list-riwayat-pendidikan-mahasiswa', [SatuDataController::class, 'list_riwayat_pendidikan_mahasiswa'])->name('api.referensi.list-riwayat-pendidikan-mahasiswa');
        Route::get('list-skala-nilai-prodi', [SatuDataController::class, 'list_skala_nilai_prodi'])->name('api.referensi.list-skala-nilai-prodi');
        Route::get('list-substansi-kuliah', [SatuDataController::class, 'list_substansi_kuliah'])->name('api.referensi.list-substansi-kuliah');
        Route::get('list-uji-mahasiswa', [SatuDataController::class, 'list_uji_mahasiswa'])->name('api.referensi.list-uji-mahasiswa');
        Route::get('loop-inserts', [SatuDataController::class, 'loop_inserts'])->name('api.referensi.loop-inserts');
        Route::get('lppm-penelitian-dosen', [SatuDataController::class, 'lppm_penelitian_dosen'])->name('api.referensi.lppm-penelitian-dosen');
        Route::get('lppm-penelitian-scopus-dosens', [SatuDataController::class, 'lppm_penelitian_scopus_dosens'])->name('api.referensi.lppm-penelitian-scopus-dosens');
        Route::get('mahasiswa-lulus-do', [SatuDataController::class, 'mahasiswa_lulus_do'])->name('api.referensi.mahasiswa-lulus-do');
    });
});