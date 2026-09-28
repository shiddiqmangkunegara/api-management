<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DatabaseKoneksiController extends Controller
{
    /**
     * Mengambil data dari tabel import_tagihan
     */
    public function getImportTagihan(Request $request)
    {
        try {
            // Pengaturan limit pagination (default: 100)
            $perPage = $request->input('limit', 100);

            // Mengambil data dari tabel import_tagihan
            $data = DB::connection('pdunsri')->table('import_tagihan')
                ->paginate($perPage);

            return response()->json([
                'status'  => 'success',
                'message' => 'Data Import Tagihan berhasil diambil',
                'data'    => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mengambil data Import Tagihan',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil data dari tabel Import_pembayaran
     */
    public function getImportPembayaran(Request $request)
    {
        try {
            $perPage = $request->input('limit', 100);

            // Mengambil data dari tabel Import_pembayaran
            $data = DB::connection('pdunsri')->table('import_pembayaran')
                ->paginate($perPage);

            return response()->json([
                'status'  => 'success',
                'message' => 'Data Import Pembayaran berhasil diambil',
                'data'    => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mengambil data Import Pembayaran',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}