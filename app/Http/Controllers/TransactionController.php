<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaction;
use App\Custom\CustomAuth as Auth;

class TransactionController extends Controller
{
    public function insert(){

    	$transaction = new Transaction();
    	$transaction->user_id = Auth::user()->id;
    	$transaction->save();

    	$cart = session('cart');

    	for($i = 0 ; $i < count($cart) ; $i++){
    		$product_id = $cart[$i]['pokemon']->id;
    		$quantity = $cart[$i]['quantity'];
    		$transaction->pokemons()->attach( $product_id, ['quantity' => $quantity]);
    	}

    	session()->forget('cart');
    	
    	return back();
    }

    public function index(Request $request){

        $action = $request->action;

        if(Auth::hasRole('admin')){
            $transactions = Transaction::all();
        }else{
            $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        }
        
        return view('transaction.admin.index', compact('action', 'transactions'));
    }

    public function update(Request $request){

        $transaction = Transaction::find($request->id);
        $transaction->status = $request->status;
        $transaction->save();

        return back();
    }

    public function detail($id){

        $transaction = Transaction::find($id);
        
        return view('transaction.admin.detail', compact('transaction'));
    }

    public function delete(Request $request){

        $transaction = Transaction::find($request->id);
        $transaction->delete();
        
        return back();
    }
}
