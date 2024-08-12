<?php

namespace App\Http\Controllers\Component\Universitas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// model
use App\Models\jurusan_universitas as Jurusan;
use App\Models\universitas as Universitas;
use App\Models\log_jurusan_universitas as Log_Universitas;


class univeritasController extends Controller
{
    private function storage_image($file){
        if (!$file->isValid() || !in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
            throw new \Exception('Invalid file type or file upload error.');
        }
        $filename = time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('photos', $filename, 'public');
        return $path;

    }
    private function get_storage_image($filename){
        $path = $filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->url($filename);
    }
    public function search_universitas(String $search = null , int $limit_per_page){
        if(!empty($search)){
            $value = Universitas::where('nama_kampus','like','%'.$search.'%')->paginate($limit_per_page);
        }else{
            $value = Universitas::paginate($limit_per_page);
        }
        foreach($value->items() as $file){
            $file['image_logo'] = $this->get_storage_image($file['image_logo']);
        }
        return $value;
    }
    public function create_universitas(String $nama , String $akreditasi, $alamat, Array $jurusan,$file){
        // image
        $file = $this->storage_image($file);
        $universitas = Universitas::create([
            'nama_kampus' => $nama,
            'image_logo' => $file,
            'akreditasi' => $akreditasi,
            'alamat' => $alamat,
        ]); 
        foreach($jurusan as $value){
            Log_Universitas::updateOrCreate([
                'id_jurusan' => $value,
                'id_universitas' => $universitas->id,
            ]);
        }
        return true;
    }

    public function detail_universitas($id){
        $value = Universitas::find($id);
        return $value;
    }
    public function send_jurusan(String $name){
       $jurusan = Jurusan::create([
        'nama_jurusan' => $name,
       ]); 
       return true;
    }

    public function get_all_jurusan(){
        $value = Jurusan::all();
        return $value;
    }

    public function search_jurusan($search , int $limit_per_page){
        if(!empty($search)){
            $value = Jurusan::where('nama_jurusan','like','%'.$search.'%')->paginate($limit_per_page);
        }else{
            $value = Jurusan::paginate($limit_per_page);
        }
        return $value;
    }
    public function send_update_jurusan($id,$name){
        $value = Jurusan::find($id)->update([
            'nama_jurusan' => $name,
        ]);
        return true;
    }
    public function send_delete_jurusan($id){
        //  belum beres
        $value = Jurusan::find($id)->delete();
        return true;
    }
}
