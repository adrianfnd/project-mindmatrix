<?php

namespace App\Http\Controllers\Component\Universitas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

// model
use App\Models\jurusan_universitas as Jurusan;
use App\Models\universitas as Universitas;
use App\Models\log_jurusan_universitas as Log_Universitas;
use App\Models\log_jurusan_summary as Log_Summary;

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
    private function delete_storage_image($filename){
        $path = $filename;
        if(!Storage::disk('public')->exists($path)){
            abort(404);
        }
        $delete = Storage::disk('public')->delete($filename);
        return true;
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
        $value['image_logo'] = $this->get_storage_image($value['image_logo']);
        return $value;
    }


    public function update_universitas(String $id , String $nama ,String $akreditasi,$alamat , Array $jurusan,$file){
        $universitas = Universitas::find($id);
        if($nama != null){
            $universitas->update([
                'nama_kampus' => $nama,
            ]);
        }
        if($akreditasi != null){
            $universitas->update([
                'akreditasi' => $akreditasi,
            ]);
        }
        if($alamat != null){
            $universitas->update([
                'alamat' => $alamat,
            ]);
        }
        if($file != null){
            $delete = $this->delete_storage_image($universitas['image_logo']);
            $update_image = $this->storage_image($file);
            $universitas->update([
                'image_logo' => $update_image,
            ]);
        }
        if($jurusan != null){
           $list_jurusan = $universitas->jurusan;
           foreach($list_jurusan as $list){
                $find_log = Log_Universitas::where('id_universitas' ,'=',$universitas->id)->where('id_jurusan','=',$list['id'])->delete();
           }
           foreach($jurusan as $value){
                Log_Universitas::create([
                    'id_universitas' => $universitas->id,
                    'id_jurusan' => $value
                ]);
           }
        }
        return true;
    }


    public function send_jurusan(String $name){
        $status = filter_var(false,FILTER_VALIDATE_BOOLEAN);
        $check_jurusan = Jurusan::where('nama_jurusan','=',$name)->first();
        if($check_jurusan != null){
            $check_jurusan->update([
                'status' => $status,
            ]);
            return true;
        }
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
        $status = filter_var(true,FILTER_VALIDATE_BOOLEAN);
        $jurusan = Jurusan::whereNot('status','=',$status);
        if(!empty($search)){
            $value = $jurusan->where('nama_jurusan','like','%'.$search.'%');
        }
        $value = $jurusan->paginate($limit_per_page);
        return $value;
    }
    public function send_update_jurusan($id,$name){
        $value = Jurusan::find($id)->update([
            'nama_jurusan' => $name,
        ]);
        return true;
    }
    public function send_delete_jurusan($id){
        $jurusan = Jurusan::find($id);
        $check_log_summary = Log_Summary::where('id_jurusan',$id)->get();
        $check_log = Log_Universitas::where('id_jurusan','=',$id)->get();
        if($check_log->count() == 0 || $check_log_summary->count() == 0){
            $value = $jurusan->delete();
        }else{
            $value = $jurusan->update([
                'status' => true
            ]);
        }
        return true;
    }
}
