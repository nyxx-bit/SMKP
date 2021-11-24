<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawancuti;
use App\Models\Karyawan;
use App\Models\MyKaryawan;
use App\Models\Cuti;

class CutiController extends Controller
{
    public function index(){
        $mykaryawan= MyKaryawan::all();
    	$karyawancuti= Karyawancuti::all();
    	return view('cuti', [
            'karyawancuti' => $karyawancuti,
            'mykaryawan' => $mykaryawan,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|max:255',
            'tanggalmulai' => 'required|max:255',
            'tanggalakhir' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        $cuti = Cuti::create([
            'tanggalmulai' => $request->tanggalmulai,
            'tanggalakhir' => $request->tanggalakhir,
            'keterangan' => $request->keterangan
        ]);

        $karyawan= Karyawan::all();

        Karyawan::where('nama_lengkap', $karyawan[0]->nama_lengkap)->update([
            'cuti_id' => $cuti->id,
        ]);

        return redirect('/cuti')->with('success', 'Employee created!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_lengkap' => 'required|max:255',
            'tanggalmulai' => 'required|max:255',
            'tanggalakhir' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        $karyawan = Karyawan::where('karyawan_id', $id)->get(['cuti_id']);

        Karyawan::where('karyawan_id', $id)->update([
            'nama_lengkap' => $request -> nama_lengkap
        ]);

        Cuti::where('cuti_id', $karyawan[0]->cuti_id)->update([
            'tanggalmulai' => $request->tanggalmulai,
            'tanggalakhir' => $request->tanggalakhir,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/cuti')->with('success', 'Employee updated');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::where('karyawan_id', $id)->get(['cuti_id']);
        $cuti = Cuti::where('cuti_id', $karyawan[0]->cuti_id)->delete();
        // $karyawancuti = Karyawancuti::findOrFail($id);
        // $karyawancuti->delete();

        return redirect('/cuti')->with('success', 'Employee deleted');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $karyawancuti = Karyawancuti::where('nama_lengkap', 'like', "%".$search."%")->paginate();
        $mykaryawan= MyKaryawan::all();
        return view('cuti', [
            'karyawancuti' => $karyawancuti,
            'mykaryawan' => $mykaryawan,
        ]);
    }
}
