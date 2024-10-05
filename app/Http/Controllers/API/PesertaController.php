<?php

namespace App\Http\Controllers\API;

use App\Models\Peserta;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index()
    {

        try {
            // $user = Auth::user();
            // dd($user);
            // if (!$user) {
            //     return response()->json(['error' => 'Unauthorized'], 401);
            // }
            $peserta = Peserta::all();
            if ($peserta->isEmpty()) {
                return ResponseFormatter::error(null, "Tidak ada data peserta yang ditemukan", 404);
            }
            return ResponseFormatter::success($peserta, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $peserta = Peserta::find($id);

            if (!$peserta) {
                return response()->json(['message' => 'Peserta not found'], 404);
            }

            return ResponseFormatter::success($peserta, 'success');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Terjadi kesalahan saat mengambil data', $e->getMessage(), 500);
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|unique:peserta,email',
    //     ]);

    //     $peserta = Peserta::create($request->all());

    //     return response()->json($peserta, 201);
    // }

    // public function update(Request $request, $id)
    // {
    //     $peserta = Peserta::find($id);

    //     if (!$peserta) {
    //         return response()->json(['message' => 'Peserta not found'], 404);
    //     }

    //     $peserta->update($request->all());

    //     return response()->json($peserta, 200);
    // }

    // public function destroy($id)
    // {
    //     $peserta = Peserta::find($id);

    //     if (!$peserta) {
    //         return response()->json(['message' => 'Peserta not found'], 404);
    //     }

    //     $peserta->delete();

    //     return response()->json(['message' => 'Peserta deleted'], 204);
    // }
}
