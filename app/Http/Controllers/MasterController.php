<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\select;

class MasterController extends Controller
{

    // BAGIAN AKUN AAS
    public function indexaas()
    {
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();
        return view('master.index_aas', compact('aas'));
    }

    public function storeaas(Request $request)
    {
        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;

        try {
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,

            ];

            $simpan = DB::table('akun_aas')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function editaas(Request $request)
    {
        $id = $request->id;
        $aas = DB::table('akun_aas')->where('id', $id)->first();
        return view('master.editaas', compact('aas'));
    }

    public function updateaas($id, Request $request)
    {

        $kode_aas = $request->kode_aas;
        $nama_aas = $request->nama_aas;

        try {
            $data = [
                'kode_aas' => $kode_aas,
                'nama_aas' => $nama_aas,

            ];

            $update = DB::table('akun_aas')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    public function deleteaas($id)
    {
        $hapus = DB::table('akun_aas')->where('id', $id)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }


    // BAGIAN MATA ANGGARAN

    public function indexmatanggaran()
    {
        $matanggaran = DB::table('akun_matanggaran')
            ->orderBy('kode_matanggaran', 'ASC')
            ->get();
        $aas = DB::table('akun_aas')
            ->orderBy('kode_aas', 'ASC')
            ->get();

        return view('master.index_matanggaran', compact('matanggaran', 'aas'));
    }

    public function storematanggaran(Request $request)
    {
        dd($request);
        $kode_matanggaran = $request->kode_matanggaran;
        $kode_aas = $request->kode_aas;

        try {
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'kode_aas' => $kode_aas,

            ];

            $simpan = DB::table('akun_matanggaran')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function editmatanggaran(Request $request)
    {
        $id = $request->id;
        $matanggaran = DB::table('akun_matanggaran')->where('id', $id)->first();
        return view('master.editmatanggaran', compact('matanggaran'));
    }

    public function updatematanggaran($id, Request $request)
    {

        $kode_matanggaran = $request->kode_matanggaran;
        $nama_matanggaran = $request->nama_matanggaran;

        try {
            $data = [
                'kode_matanggaran' => $kode_matanggaran,
                'nama_matanggaran' => $nama_matanggaran,

            ];

            $update = DB::table('akun_matanggaran')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate']);
        }
    }

    public function deletematanggaran($id)
    {
        $hapus = DB::table('akun_matanggaran')->where('id', $id)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data  Gagal Dihapus']);
        }
    }
}
