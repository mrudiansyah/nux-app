<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Hash;
use App\Models\Application;
use Carbon\Carbon;
use Image;
use File;

class UsersController extends Controller  
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index() {
        $my_id = (Auth::user() == 'NULL' ? Auth::user()->id : 1) ;  
        $uri = explode("/", url()->current()); 
        if (count($uri) < 4) {
            $menu = $this->menu($my_id, 'home') ;   
        } else {
            $menu = $this->menu($my_id, $uri[3]) ;  
        } 
        $data['head_title'] = $menu['head_title'];
        $data['menu_level_1'] = $menu['menu_level_1'] ; 
        $data['flow_process'] = Application::get_flow_process(0);
        return view('users/users_index', $data); 
    }

    public function store(Request $request)
    {
        $id = $request->user_id ;
        $my_id = Auth::user()->id ; 
        $detail['full_name'] = $request->full_name ;
        $detail['call_name'] = $request->call_name ;
        $detail['email'] = $request->email ;
        $detail['level_id'] = $request->level_id ;  
        $detail['status_id'] = 1 ;  
        $detail['updated_by'] = $my_id ; 
        $detail['updated_at'] = Carbon::now() ; 
        $index['id'] = $id ;  
        if ($request->pwd!='') {
            $detail['password'] = Hash::make($request->password) ;  
        }  
            if ($id != 0) { 
                $update = User::where($index)->update($detail);
                if ($update) {
                    $dt['process_status'] = 1 ;
                    $dt['msg_process'] = 'Data berhasil diupdate' ; 
                } else {
                    $dt['process_status'] = 0 ;
                    $dt['msg_process'] = 'Data gagal diupdate' ; 
                } 
            } else {
                $detail['created_by'] = $my_id ;
                $detail['created_at'] = Carbon::now() ;
                $created = User::create($detail); 
                if ($created) {
                    $dt['process_status'] = 1 ;
                    $dt['msg_process'] = 'Data berhasil ditambah' ; 
                } else {
                    $dt['process_status'] = 0 ;
                    $dt['msg_process'] = 'Data gagal ditambah' ; 
                }  
            }   
        return json_encode($dt); 
    }
 
    public function show(Request $request)
    {
        $id = $request->user_id ; 
        $data['id'] = $id ;
        $detail_users = User::where('id', $id)->get() ;
        if($detail_users->count() > 0) {
            foreach ($detail_users as $row) {
                $data['full_name'] = $row->full_name ;
                $data['call_name'] = $row->call_name ;
                $data['email'] = $row->email ;
                $data['level_id'] = $row->level_id ; 
                $data['avatar'] = $row->avatar ; 
            }
        } else {
                $data['full_name'] = '' ;
                $data['call_name'] = '' ;
                $data['email'] = '' ;
                $data['level_id'] = '' ;
                $data['avatar'] = 'blank.png' ; 
        } 
        return view('users.form_users', $data) ;
    }

    public function show_list(Request $request)
    {  
        $data['user_list'] = User::where('status_id', 1)->get() ; 
        return view('users.users_list', $data) ;
    }

    public function export_data(Request $request) {    
        $list_db = User::where('status_id', 1) ;
        $data['list'] = $list_db->get();  
        $data['num'] = $list_db->count() ;    
        $data['full_name']= Auth::user()->full_name ;  
        return view('users.export_data', $data);     
    }
   
    public function destroy(Request $request)
    { 
        $id = $request->id ; 
        $my_id = Auth::user()->id ;    
        $destroy = User::where('id', $id)->update(["status_id" => 0, "updated_by" => $my_id]) ;
        if ($destroy) { 
            $dt['process_status'] = 1 ;
            $dt['msg_process'] = 'Data Berhasil di hapus' ;  
        } else {  
            $dt['process_status'] = 0 ;
            $dt['msg_process'] = 'Data Gagal di hapus' ;   
        }  
        return json_encode($dt);
    }

    public function destroy_selected(Request $request)
    {
      $str = explode(",", $request->id) ; 
      $jml_data = 0 ;
      $my_id = Auth::user()->id ; 
      foreach ($str AS $r) { 
          User::where('id', $r)->update(["status_id" => 0, "updated_by" => $my_id]) ;
          $jml_data++; 
      }  
      $dt['process_status'] = 1 ;
      $dt['msg_process'] = $jml_data.' Data Berhasil di hapus' ; 
      return json_encode($dt);

    }

    public function upload_image(Request $request)
    {
        if ($request->user_id != 0) { 
            $id = $request->user_id ;
        }else{ 
            $id = User::orderBy('id', 'desc')->first()->id ;
        }
        $this->path = public_path('assets/media/avatars') ;
        $this->dimensions = ['245', '300', '500'];
        
          if (!File::isDirectory($this->path)) 
          { 
            File::makeDirectory($this->path);
          } 
      
        $file = $request->file('avatar'); 
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); 
        Image::make($file)->save($this->path . '/' . $fileName);
         
        foreach ($this->dimensions as $row) { 
        $canvas = Image::canvas($row, $row); 
        $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
        $constraint->aspectRatio();
        }); 
      
        if (!File::isDirectory($this->path . '/' . $row)) { 
        File::makeDirectory($this->path . '/' . $row);
        }  
        $canvas->insert($resizeImage, 'center'); 
          $canvas->save($this->path . '/' . $row . '/' . $fileName);
        } 
        
        $form_data = array('avatar' => $fileName);
        $upload = User::where('id', $id)->update($form_data);  
        if ($upload) {
            $dt['process_status'] = 1 ;
            $dt['msg_process'] = 'Data berhasil diupdate' ; 
        } else {
            $dt['process_status'] = 0 ;
            $dt['msg_process'] = 'Data gagal diupdate' ; 
        }
         
        return json_encode($dt);
    }
    
}
