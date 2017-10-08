<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pokemon;

class CartController extends Controller
{
    public function index(){

    	$cart = session('cart');

    	return view('cart.index', compact('cart'));
    }

    private function inCart($cart, $id){
    	for($i = 0 ; $i < count($cart) ; $i++){
    		if($cart[$i]['pokemon']->id == $id)
    			return $i;
    	}

    	return false;
    }

    public function insert(Request $request){

    	$this->validate($request, [
    		'quantity' => 'required|integer|min:0',
    	]);

    	$cart = session('cart');

    	$index = $this->inCart($cart, $request->pokemon_id);
    	if($index !== false){
    		$cart[$index]['quantity'] += $request->quantity;

    		$request->session()->put('cart', $cart);
    	}else{
    		$product = [
    			'pokemon' => Pokemon::find($request->pokemon_id),
    			'quantity' => $request->quantity,
    		];

    		$request->session()->push('cart', $product);
    	}
    	
    	return back();
    }

    public function delete($id, Request $request){
    	$cart = session('cart');

    	$index = $this->inCart($cart, $id);

    	array_splice($cart, $index, 1);

    	$request->session()->put('cart', $cart);
    	
    	return back();
    }
}
