<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;

class FinanceController extends Controller
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
    public function index(Request $request)
    {
        $pagination = 2;
        $data = User::get();
        return view('finance.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function index_fin(Request $request, $id)
    {
        $pagination = 2;
        $data = User::find($id);
        return view('finance.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    
    public function create()
    {
        $saldo = User::get();
        return view('finance.create', compact('saldo'));
    }

    public function cek(Request $request, $id)
    {
        $pagination = 2;
        $idn = User::find($id);
        $c_nilai        = Wallet::where('wallet.id_user',$id)->get()->sum('amount');
        $data = Wallet::join('currency', 'currency.id_currency', '=', 'wallet.id_currency','LEFT')
                ->select('wallet.*','currency.*')      
                ->where('wallet.id_user',$id)
                ->get();
        return view('finance.wallet', compact('idn','c_nilai','data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }


    public function add_currency(Request $request, $id)
    {
        $pagination = 2;
        $idn = User::find($id);
        $data = Wallet::join('currency', 'currency.id_currency', '=', 'wallet.id_currency','LEFT')
                ->select('wallet.*','currency.*')      
                ->where('wallet.id_user',$id)
                ->get();
        return view('finance.add-currency.add', compact('idn','data'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function insert_wallet(Request $request)
    {
        Currency::where('name_currency', $request['name_currency']); 
        // $trx = Currency::create([
        //     'name_currency' => $request['name_currency'],
        //     'balance'       => $request['balance'],
        // ]);

        $sld = $trx['id_currency'];
        
        Wallet::create([
            'id_currency'   => $sld,
            'id_user'       => $request['id_user'],
            'balance'       => 0,
        ]);
    }

    public function insert(Request $request)
    {
        $ct = Currency::create([
            'name_currency' => $request['name_currency'],
            'balance'       => $request['balance'],
        ]);
        $sld = $ct['id_currency'];
        
        $wl = Wallet::create([
            'id_currency' => $sld,
            'id_user'     => $request['id_user'],
            'amount'      => $request['balance'],
        ]);
        
        if($wl){
            return redirect('financea/ewallet/'. $request['id_user'])->with('status', 'Berhasil menambah data!');
        }
 
        return redirect('financea/ewallet/'. $request['id_user'])->with('status', 'Gagal Menambah data!');
        
    }

    public function edit($id)
    {
        $data = Currency::find($id);
        return view('finance.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Currency::join('wallet', 'wallet.id_currency', '=', 'currency.id_currency','LEFT')
                ->select('wallet.id_user')      
                ->where('currency.id_currency',$id)
                ->get();
        
        $d = Currency::find($id);
        if ($d == null){
            return redirect('financea')->with('status', 'Data tidak Ditemukan !');
        }

        $data = Currency::find($id)->update([
            'balance' => $request['balance'],
        ]);

        $wll = Wallet::where('id_currency', $id)->update([
            'amount' => $request['balance'],
        ]);
        if($wll){
            return redirect('financea')->with('status', 'Data  Berhasil diedit !');
        }

        return redirect('financea')->with('status', 'Gagal edit data !');
        
    }
}
