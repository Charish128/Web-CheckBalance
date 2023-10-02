<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar(Request $request)
    {
        $request->validate([
           'nama'=>'required|max:255|unique:users,name',
           'email'=>'required|email|max:255',
           'password'=>'required'
        ],[
            'nama.required'=>'nama harus diisi',
            'nama.max'=>'karakter nama terlalu panjang',
            'nama.unique'=>'nama sudah ada',

            'email.required'=>'email harus diisi',
            'email.email'=>'email tidak valid',
            'email.max'=>'karakter email terlalu panjang',

            'password.required'=>'password harus diisi'
        ]);

        try {
            $password = Hash::make($request->password);
            
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = $password;
            $user->level_user = 'user';

            $user->save();
            return redirect()->back()->with('success', 'data berhasil ditambahkan');

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required'
         ],[
             'email.required'=>'email harus diisi',
             'email.email'=>'email tidak valid',
             'email.max'=>'karakter email terlalu panjang',
 
             'password.required'=>'password harus diisi'
         ]);

         $email = $request->email;
         $password = $request->password;

         $result = User::where('email', $email)->first();
         if ($result){
            if(password_verify($password, $result->password)){
                if($result->level_user == "admin") {
                    $level = "admin";
                } else {
                    $level = "user";
                }
                session([
                    'login'=>true, 
                    'nama'=> $result->name,
                    'email'=> $result->email,
                    'level_user'=> $level,
                    'id'    =>  $result->id
                ]);
                
                return redirect()->to('dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Email Atau Password Salah');
            }
         } else {
            return redirect()->to('/')->with('error', 'akun tidak ditemukan');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->flush();
        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('pages.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_profile(Request $request)
    {
        $request->validate([
            'nama'  =>  'required|max:255',
            'email' =>'required|email|max:255'
        ],[
            'nama.required' =>  'nama harus diisi',
            'nama.max' =>  'karakter nama terlalu panjang',
            'email.required' =>  'email harus diisi',
            'email.email'   =>  'email tidak valid',
            'email.max' =>  'karakter email terlalu panjang',
        ]);

        try {
            User::where('id',session()->get('id'))->update([
                'name'  =>  $request->nama,
                'email' => $request->email
            ]);
            $id = session()->get('id');

            $result = User::where('id',session()->get('id'))->first();
            session()->forget('nama'); 
            session()->forget('email');
            session([
                'nama'  =>  $result->name,
                'email' =>  $result->email
            ]);

            return redirect()->back()->with('success','data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','data gagal diupdate');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
