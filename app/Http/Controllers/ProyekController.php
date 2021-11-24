<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawanproyek;
use App\Models\MyKaryawan;
use App\Models\Karyawan;
use App\Models\Proyek;

class ProyekController extends Controller
{
    public function index(){
        $mykaryawan= MyKaryawan::all();
    	$karyawanproyek= Karyawanproyek::all();
    	return view('proyek', [
            'karyawanproyek' => $karyawanproyek,
            'mykaryawan' => $mykaryawan,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_proyek' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'tenggat_waktu' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        $proyek = Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'tenggat_waktu' => $request->tenggat_waktu,
            'keterangan' => $request->keterangan
        ]);

        $karyawan = Karyawan::where('nama_lengkap', $request->nama_lengkap)->get(['nama_lengkap']);

        Karyawan::where('nama_lengkap', $karyawan[0]->nama_lengkap)->update([
            'proyek_id' => $proyek->id,
        ]);
        return redirect('/proyek')->with('success', 'Employee created!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_proyek' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'tenggat_waktu' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        $karyawan = Karyawan::where('nama_lengkap', $request->nama_lengkap)->get(['nama_lengkap', 'proyek_id']);

        Proyek::where('proyek_id', $karyawan[0]->proyek_id)->update([
            'nama_proyek' => $request->nama_proyek,
            'tenggat_waktu' => $request->tenggat_waktu,
            'keterangan' => $request->keterangan
        ]);

        $proyek = Proyek::where('nama_proyek', $request->nama_proyek)->get(['proyek_id']);
        
        Karyawan::where('proyek_id', $proyek[0]->proyek_id)->update([
            'proyek_id' => 0
        ]);

        Karyawan::where('nama_lengkap', $karyawan[0]->nama_lengkap)->update([
            'proyek_id' => $proyek[0]->proyek_id,
        ]);

        // Karyawan::where('nama_lengkap', '<>', $karyawan[0]->nama_lengkap)->update([
        //     'proyek_id' => 0,
        // ]);

        return redirect('/proyek')->with('success', 'Employee updated');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::where('karyawan_id', $id)->get(['proyek_id']);
        Karyawan::where('proyek_id', $karyawan[0]->proyek_id)->update([
            'proyek_id' => 0
        ]);
        $proyek = Proyek::where('proyek_id', $karyawan[0]->proyek_id)->delete();
        // $karyawanproyek = Karyawanproyek::findOrFail($id);
        // $karyawanproyek->delete();

        return redirect('/proyek')->with('success', 'Employee deleted');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $karyawanproyek = Karyawanproyek::where('nama_proyek', 'like', "%".$search."%")->paginate();
        $mykaryawan= MyKaryawan::all();
        return view('proyek', [
            'karyawanproyek' => $karyawanproyek,
            'mykaryawan' => $mykaryawan,
        ]);
    }
}
