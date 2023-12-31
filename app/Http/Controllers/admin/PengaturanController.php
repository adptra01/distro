<?php

namespace App\Http\Controllers\admin;

use App\Alamat_toko;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Province;
use App\City;

class PengaturanController extends Controller
{
    public function aturalamat()
    {
        //cek apa alamat toko sudah di set atau belum
        $data['cekalamat'] = $cek = DB::table('alamat_toko')->count();
        $data['store'] = Alamat_toko::whereId(1)->first();

        //jika belum di setting maka ambil data provinsi untuk di tampilkan di form alamat
        if ($cek < 1) {
            $data['provinces'] = Province::all();
        } else {
            //jika sudah di setting maka tidak menampilkan form tapi tampilkan data alamat toko

            $data['alamat'] = DB::table('alamat_toko')
                ->join('cities', 'cities.city_id', '=', 'alamat_toko.city_id')
                ->join('provinces', 'provinces.province_id', '=', 'cities.province_id')
                ->select('alamat_toko.*', 'cities.title as kota', 'provinces.title as prov')->first();
        }
        return view('admin.pengaturan.alamat', $data);
    }
    public function getCity($id)
    {
        return City::where('province_id', $id)->get();
    }

    public function ubahalamat($id)
    {
        //function untuk menampilkan form edit alamat
        $data['provinces'] = Province::all();
        $data['id'] = $id;
        return view('admin.pengaturan.ubahalamat', $data);
    }

    public function simpanalamat(Request $request)
    {
        //menyimpan alamat baru pada toko

        DB::table('alamat_toko')->insert([
            'city_id' => $request->cities_id,
            'detail'  => $request->detail
        ]);

        return redirect()->route('admin.pengaturan.alamat')->with('success', 'Berhasil Mengatur Alamat');
    }

    public function updatealamat($id, Request $request)
    {

        //mengupdate alamat toko
        DB::table('alamat_toko')
            ->where('id', $id)
            ->update([
                'city_id' => $request->cities_id,
                'detail'  => $request->detail
            ]);

        return redirect()->route('admin.pengaturan.alamat')->with('success', 'Berhasil Mengubah Alamat');
    }

    public function identity($id, Request $request)
    {
        $request->validate([
            'name_store' => 'required|min:5',
            'telp' => 'required|numeric|min:11',
            'description' => 'required|min:20',
        ]);

        Alamat_toko::whereId($id)->update([
            'name_store' => $request->name_store,
            'telp' => $request->telp,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Ubah identitas toko berhasil 😉');
    }
}
