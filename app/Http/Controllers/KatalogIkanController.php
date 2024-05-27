<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KatalogIkanController extends Controller
{
    public function index(){
        $list = Ikan::orderBy('id','desc')->get();
        return view('katalog_ikan.index',['list'=>$list]);
    }
    
    public function add(){
        return view('katalog_ikan.add');
    }

    public function edit($id){
        $old = Ikan::findOrFail($id);
        return view('katalog_ikan.edit',["old"=>$old]);
    }

    public function store(Request $request){
        try {
            // $request->validate([
            //     'fillum' => 'required',
            //     'super_kelas' => 'required',
            //     'kelas' => 'required',
            //     'ordo' => 'required',
            //     'famili' => 'required',
            //     'genus' => 'required',
            //     'spesies' => 'required',
            //     // 'kategori' => 'required',
            //     'habitat' => 'required',
            //     'nama_daerah' => 'required',
            //     'pengarang' => 'required',
            //     'karakteristik_morfologi' => 'required',
            //     'kemunculan' => 'required',
            //     'panjang_maksimal' => 'required',
            //     'id_genom' => 'required',
            //     'status_konservasi' => 'required',
            //     'upaya_konservasi' => 'required',
            //     // 'komentar' => 'required',
            //     'file' => 'required|file|max:10240',
            // ]);

            $folderName = $request->spesies??"NA";
            $path = public_path($folderName);
            if(file_exists($path)){
                File::deleteDirectory($path);
            }
            mkdir($path, 0777, true);
            if($request->has('foto')){
                $file = $request->file('foto');
                $fileName = $file->getClientOriginalName();
                $filePath = $path . '/' . $fileName;
                move_uploaded_file($file->getPathname(), $filePath);
            }

            $ikan = new Ikan();
            $ikan->fillum                   = $request->fillum??""; 
            $ikan->super_kelas              = $request->super_kelas??""; 
            $ikan->kelas                    = $request->kelas??""; 
            $ikan->ordo                     = $request->ordo??""; 
            $ikan->famili                   = $request->famili??""; 
            $ikan->genus                    = $request->genus??""; 
            $ikan->spesies                  = $request->spesies??""; 
            $ikan->kategori                 = $request->kategori??"";
            $ikan->kingdom                  = $request->kingdom??""; 
            $ikan->habitat                  = $request->habitat??""; 
            $ikan->nama_daerah              = $request->nama_daerah??""; 
            $ikan->pengarang                = $request->pengarang??""; 
            $ikan->karakteristik_morfologi  = $request->karakteristik_morfologi??""; 
            $ikan->kemunculan               = $request->kemunculan??""; 
            $ikan->panjang_maksimal         = $request->panjang_maksimal??""; 
            $ikan->id_genom                 = $request->id_genom??""; 
            $ikan->status_konservasi        = $request->status_konservasi??""; 
            $ikan->status_konservasi_tahun  = $request->status_konservasi_tahun??""; 
            $ikan->upaya_konservasi         = $request->upaya_konservasi??""; 
            $ikan->komentar                 = $request->komentar??""; 
            $ikan->foto                     = ""; 
            $ikan->save();

            return redirect()->route('katalog_ikan.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function update(Request $request){
        try {
            // $request->validate([
            //     'fillum' => 'required',
            //     'super_kelas' => 'required',
            //     'kelas' => 'required',
            //     'ordo' => 'required',
            //     'famili' => 'required',
            //     'genus' => 'required',
            //     'spesies' => 'required',
            //     // 'kategori' => 'required',
            //     'habitat' => 'required',
            //     'nama_daerah' => 'required',
            //     'pengarang' => 'required',
            //     'karakteristik_morfologi' => 'required',
            //     'kemunculan' => 'required',
            //     'panjang_maksimal' => 'required',
            //     'id_genom' => 'required',
            //     'status_konservasi' => 'required',
            //     'upaya_konservasi' => 'required',
            //     // 'komentar' => 'required',
            //     'file' => 'required|file|max:10240',
            // ]);

            $ikan = Ikan::findOrFail($request->id);
            $folderName = $ikan->spesies??"NA";
            $path = public_path($folderName);
            if(file_exists($path)){
                File::deleteDirectory($path);
            }

            $folderName = $request->spesies??"NA";
            $path = public_path($folderName);
            if(file_exists($path)){
                File::deleteDirectory($path);
            }
            mkdir($path, 0777, true);
            if($request->has('foto')){
                $file = $request->file('foto');
                $fileName = $file->getClientOriginalName();
                $filePath = $path . '/' . $fileName;
                move_uploaded_file($file->getPathname(), $filePath);
            }
            
            $ikan->fillum                   = $request->fillum??""; 
            $ikan->super_kelas              = $request->super_kelas??""; 
            $ikan->kelas                    = $request->kelas??""; 
            $ikan->ordo                     = $request->ordo??""; 
            $ikan->famili                   = $request->famili??""; 
            $ikan->genus                    = $request->genus??""; 
            $ikan->spesies                  = $request->spesies??""; 
            $ikan->kategori                 = $request->kategori??"";
            $ikan->kingdom                  = $request->kingdom??""; 
            $ikan->habitat                  = $request->habitat??""; 
            $ikan->nama_daerah              = $request->nama_daerah??""; 
            $ikan->pengarang                = $request->pengarang??""; 
            $ikan->karakteristik_morfologi  = $request->karakteristik_morfologi??""; 
            $ikan->kemunculan               = $request->kemunculan??""; 
            $ikan->panjang_maksimal         = $request->panjang_maksimal??""; 
            $ikan->id_genom                 = $request->id_genom??""; 
            $ikan->status_konservasi        = $request->status_konservasi??"";
            $ikan->status_konservasi_tahun  = $request->status_konservasi_tahun??""; 
            $ikan->upaya_konservasi         = $request->upaya_konservasi??""; 
            $ikan->komentar                 = $request->komentar??""; 
            $ikan->foto                     = ""; 
            $ikan->save();

            return redirect()->route('katalog_ikan.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function delete($id){
        try {
            $ikan = Ikan::findOrFail($id);
            $folderName = $ikan->spesies??"NA";
            $path = public_path($folderName);
            if(file_exists($path)){
                File::deleteDirectory($path);
            }
            $ikan->delete();
        } catch (\Exception $th) {
            throw $th;
        }
        return redirect()->route('katalog_ikan.index');
    }
}
