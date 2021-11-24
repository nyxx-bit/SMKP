<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyKaryawan;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Gaji;

class HomeController extends Controller
{
    public function index(){
        $mykaryawan= MyKaryawan::all();
    	return view('home', [
            'mykaryawan' => $mykaryawan
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|max:255',
            'telp' => 'required|max:255',
            'asal' => 'required|max:255',
            'kontrak' => 'required',
            'nama_jabatan' => 'required|max:255',
            'gaji_pokok' => 'required|max:255',
            'tunjangan' => 'required|max:255',
        ]);

        $jabatan = Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        $gaji = Gaji::create([
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan
        ]);

        Karyawan::create([
            'nama_lengkap' => $request->nama_lengkap,
            'telp' => $request->telp,
            'asal' => $request->asal,
            'kontrak' => $request->kontrak,
            'jabatan_id' => $jabatan->id,
            'gaji_id' => $gaji->id,
            'cuti_id' => 0,
            'proyek_id' => 0
        ]);

        return redirect('/')->with('success', 'Employee created!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|max:255',
            'telp' => 'required|max:255',
            'asal' => 'required|max:255',
            'kontrak' => 'required',
            'nama_jabatan' => 'required|max:255',
            'gaji_pokok' => 'required|max:255',
            'tunjangan' => 'required|max:255',
        ]);

        $karyawan = Karyawan::where('karyawan_id', $id)->get(['jabatan_id', 'gaji_id']);

        Karyawan::where('karyawan_id', $id)->update([
            'nama_lengkap' => $request -> nama_lengkap,
            'telp' => $request->telp,
            'asal' => $request->asal,
            'kontrak' => $request->kontrak
        ]);

        
        Jabatan::where('jabatan_id', $karyawan[0]->jabatan_id)->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        Gaji::where('gaji_id', $karyawan[0]->gaji_id)->update([
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan
        ]);
        return redirect('/')->with('success', 'Employee updated');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::where('karyawan_id', $id)->delete();
        // $karyawan = Karyawan::findOrFail($id);
        // $karyawan->delete();

        return redirect('/')->with('success', 'Employee deleted');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $mykaryawan = MyKaryawan::where('nama_lengkap', 'like', "%".$search."%")->paginate();

        return view('home', [
            'mykaryawan' => $mykaryawan
        ]);
    }
}
