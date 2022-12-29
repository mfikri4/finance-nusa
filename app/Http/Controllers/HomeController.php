<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function all(Request $request)
    {
        $pagination = 2;
        $data = User::get();
        return view('user-data.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function create()
    {
        return view('user-data.create');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('user-data.edit', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $d = User::find($id);
        if ($d == null){
            return redirect('user-data/')->with('status', 'Data tidak Ditemukan !');
        }

        $req = $request->all();
        
        $data = User::find($id)->update($req);
        if($data){
            return redirect('user-data/')->with('status', 'Data pengguna Berhasil diedit !');
        }

        return redirect('user-data/')->with('status', 'Gagal edit data pengguna!');
        
    }
}
