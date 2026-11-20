<?php

namespace App\Http\Controllers\Api\Feeder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class FeederGetController extends Controller
{
    /**
     * Nama koneksi database khusus PD Unsri
     */
    private string $connection = 'pdunsri';

    /**
     * Menyimpan data prestasi mahasiswa dari SIMAK
     */
    /**
     * Menampilkan data aktivitas_mahasiswa berdasarkan filter semester dan jenis aktivitas
     */
    public function get_aktivitas_mahasiswa_luar_prodi(Request $request)
    {
        try {
            // Filter default sesuai kriteria
            $semesters = [20261, 20252];
            $jenisAktivitas = [5, 6, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 24];

            // Opsional: Izinkan override melalui query param jika dikirim di URL
            // Contoh: ?id_semester=20261&per_page=50
            if ($request->filled('id_semester')) {
                $semesters = explode(',', $request->id_semester);
            }

            if ($request->filled('id_jenis_aktivitas')) {
                $jenisAktivitas = explode(',', $request->id_jenis_aktivitas);
            }

            $query = DB::connection($this->connection)
                    ->table('list_aktivitas_mahasiswa as lam')
                    ->join('list_anggota_aktivitas_mahasiswa as laam', 'lam.id_aktivitas', '=', 'laam.id_aktivitas')
                    ->select(
                        'laam.nama_mahasiswa',
                        'laam.nim',
                        'lam.id_prodi',
                        'lam.nama_prodi',
                        'lam.id_jenis_aktivitas',
                        'lam.nama_jenis_aktivitas',
                        'lam.judul',
                        'lam.id_semester',
                        'lam.nama_semester',
                        'lam.sk_tugas',
                        'lam.tanggal_sk_tugas'
                    )
                    ->whereIn('lam.id_semester', $semesters)
                    ->whereIn('lam.id_jenis_aktivitas', $jenisAktivitas);

            // Jika parameter per_page dikirim, gunakan pagination. Jika tidak, ambil semua (atau batasi)
            if ($request->filled('per_page')) {
                $data = $query->paginate((int) $request->per_page);
            } else {
                $data = $query->get();
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Data aktivitas mahasiswa berhasil diambil',
                'total'   => $request->filled('per_page') ? $data->total() : $data->count(),
                'data'    => $request->filled('per_page') ? $data->items() : $data,
                'meta'    => $request->filled('per_page') ? [
                    'current_page' => $data->currentPage(),
                    'last_page'    => $data->lastPage(),
                    'per_page'     => $data->perPage(),
                ] : null,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mengambil data aktivitas mahasiswa',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}