<?php

namespace App\Http\Controllers\Api\Simak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class SimakPostController extends Controller
{
    /**
     * Nama koneksi database khusus PD Unsri
     */
    private string $connection = 'pdunsri';

    /**
     * Menyimpan data prestasi mahasiswa dari SIMAK
     */
    public function store_prestasi(Request $request)
    {
        // 1. Validasi Input sesuai dengan struktur tabel simak_prestasi_mahasiswas
        $validator = Validator::make($request->all(), [
            'id_prestasi'          => 'required|string',
            'nim'                  => 'required|string|max:14',
            'nama_mahasiswa'       => 'required|string',
            'nama_prestasi'        => 'required|string',
            'jenis_prestasi'       => 'nullable|string',
            'kategori_prestasi'    => 'nullable|string',
            'penyelenggara'        => 'required|string',
            'peringkat'            => 'nullable|string',
            'tahun_prestasi'       => 'required|string|size:4',
            'tanggal_sk'           => 'nullable|date_format:Y-m-d',
            'file_prestasi'        => 'nullable|string',
            'file_sk_tugas'        => 'nullable|string',
            'status_approval'      => 'nullable|string',
            'jumlah_unit_peserta'  => 'nullable|string|max:10',
            'kelompok_prestasi'    => 'nullable|string|in:INDIVIDU,KELOMPOK',
            'bentuk'               => 'nullable|string|in:DARING,LURING',
            'url_peserta'          => 'nullable|string',
            'url_foto_upp'         => 'nullable|string',
            'url_dokumen_undangan' => 'nullable|string',
            'tgl_sertifikat'       => 'nullable|date_format:Y-m-d',
            'keterangan'           => 'nullable|string',
            'mahasiswa'            => 'nullable|array', // Menerima array JSON
            'dosen'                => 'nullable|array', // Menerima array JSON
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Validasi input gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // 2. Cek apakah id_prestasi sudah pernah dimasukkan (mencegah duplikasi data)
            $exists = DB::connection($this->connection)
                ->table('simak_prestasi_mahasiswas')
                ->where('id_prestasi', $request->id_prestasi)
                ->exists();

            if ($exists) {
                return response()->json([
                    'status'  => 'fail',
                    'message' => "Data prestasi dengan ID '{$request->id_prestasi}' sudah ada.",
                ], 409);
            }

            // 3. Menyiapkan array data yang akan dimasukkan
            $dataToInsert = [
                'id_prestasi'          => $request->id_prestasi,
                'nim'                  => $request->nim,
                'nama_mahasiswa'       => $request->nama_mahasiswa,
                'nama_prestasi'        => $request->nama_prestasi,
                'jenis_prestasi'       => $request->jenis_prestasi,
                'kategori_prestasi'    => $request->kategori_prestasi,
                'penyelenggara'        => $request->penyelenggara,
                'peringkat'            => $request->peringkat,
                'tahun_prestasi'       => $request->tahun_prestasi,
                'tanggal_sk'           => $request->tanggal_sk,
                'file_prestasi'        => $request->file_prestasi,
                'file_sk_tugas'        => $request->file_sk_tugas,
                'status_approval'      => $request->status_approval ?? 'approved',
                'jumlah_unit_peserta'  => $request->jumlah_unit_peserta ?? '1',
                'kelompok_prestasi'    => $request->kelompok_prestasi ?? 'INDIVIDU',
                'bentuk'               => $request->bentuk ?? 'DARING',
                'url_peserta'          => $request->url_peserta,
                'url_foto_upp'         => $request->url_foto_upp,
                'url_dokumen_undangan' => $request->url_dokumen_undangan,
                'tgl_sertifikat'       => $request->tgl_sertifikat,
                'keterangan'           => $request->keterangan,
                // Mengubah array menjadi string JSON untuk kolom JSON di MariaDB/MySQL
                'mahasiswa'            => $request->has('mahasiswa') ? json_encode($request->mahasiswa) : null,
                'dosen'                => $request->has('dosen') ? json_encode($request->dosen) : null,
                'created_at'           => now(),
                'updated_at'           => now(),
            ];

            // 4. Insert data menggunakan koneksi 'pdunsri'
            $id = DB::connection($this->connection)
                ->table('simak_prestasi_mahasiswas')
                ->insertGetId($dataToInsert);

            return response()->json([
                'status'  => 'success',
                'message' => 'Data prestasi mahasiswa berhasil ditambahkan',
                'data_id' => $id
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menyimpan data prestasi mahasiswa',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}