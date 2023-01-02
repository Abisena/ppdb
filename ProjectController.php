<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ppdb;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $users = User::all();

        return view('dash.register', compact('users'))
        ->with('i', (request()->input('page', 1)-1)*10);
    }

    public function home()
    {
        return view('dash.index');
    }

    public function hasil()
    {
        return view('hasil.hasilregister');
    }

    public function registerAkun(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nisn' => 'required',
            'kelamin' => 'required',
            'asal_sekolah' => 'required',
            'asal_sekolah_text' => 'nullable',
            'no_hp' => 'required',
            'no_hp_ayah' => 'required',
            'no_hp_ibu' => 'required'
        ]);

        Ppdb::create($request->all());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->nisn),
        ]);

        $user = $request->only('name', 'email', 'nisn', 'kelamin', 'asal_sekolah', 'asal_sekolah_text', 'no_hp', 'no_hp_ayah', 'no_hp_ibu');
            if(Auth::attempt($user) ){
                return redirect()->route('ppdb.hasil')
                ->with('success', 'Registrasi berhasil! , silahkan Login');
            }
    }

    public function login()
    {
        return view('dash.login');
    }

    public function auth(Request $request)
    {
        // array ke2 sbgai custom msg
      $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'email ini belum tersedia',
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi',
        ]);
       
        
        $user = $request->only('email', 'password');
        // authentication
        if (Auth::attempt($user)) {
            return redirect()->route('user.home');
        }else {
            return redirect()->back()->with('error', 'Gagal Login, silahkan cek dan coba lagi!');
        }
    }

    public function userHome()
    {
        return view('user.userhome');
    }

    public function admin()
    {
        return view('admin.admin');
    }
    public function adminHome()
    {
        
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.home');
        }else{
            return redirect('/error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
