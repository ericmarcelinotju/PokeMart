<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pokemon;
use App\Element;

class PokemonController extends Controller
{
    public function index(Request $request){
    	$action = $request->action;

    	$itemPerPage = 2;

    	$pokemons = Pokemon::paginate($itemPerPage);

    	if(isset($request->by)){
    		if($request->by == 'name'){
    			$pokemons = Pokemon::where('name', 'like', "%$request->search%")->paginate($itemPerPage);
    		}
    		else if($request->by == 'element'){
    			$elements = Element::where('name','like', "%$request->search%")->get()
    			->map(function ($element) {
				    return $element->id;
				});
    			$pokemons = Pokemon::whereIn('element_id', $elements)->paginate($itemPerPage);
    		}
    	}
    	return view('pokemon.index', compact('pokemons', 'action'));
    }

    public function detail($id){
    	$pokemon = Pokemon::find($id);
    	return view('pokemon.detail', compact('pokemon'));
    }

    public function adminInsert(){

    	$action = "insert";

    	$elements = Element::all();

    	$pokemon = new Pokemon();

    	return view('pokemon.admin.edit', compact('action', 'elements', 'pokemon'));
    }

    public function adminUpdate($id){

    	$action = "update";

    	$elements = Element::all();

    	$pokemon = Pokemon::find($id);

    	return view('pokemon.admin.edit', compact('action', 'elements', 'pokemon'));
    }

    public function adminDelete(){

    	$action = 'delete';
    	$pokemons = Pokemon::all();
    	return view('pokemon.index', compact('pokemons', 'action'));
    }

    public function saveInsert(Request $request){

    	$this->validate($request, [
    		'name' => 'required|alpha|min:3',
    		'element' => 'required',
    		'image' => 'required|image',
    		'gender' => 'required',
    		'description' => 'required|alpha',
    		'price' => 'required|numeric|min:1000',
    	]);

        $destinationPath = public_path('img/pokemon');
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = uniqid().'.'.$extension;

        $request->file('image')->move($destinationPath, $fileName);

    	$pokemon = new Pokemon();
    	$pokemon->name = $request->name;
    	$pokemon->element_id = $request->element;
    	$pokemon->image = $fileName;
    	$pokemon->gender = $request->gender;
    	$pokemon->description = $request->description;
    	$pokemon->price = $request->price;

    	$pokemon->save();

    	return $this->adminUpdate($pokemon->id);
    }

    public function saveUpdate(Request $request){

    	$this->validate($request, [
    		'name' => 'required|alpha|min:3',
    		'element' => 'required',
    		'image' => 'required|image',
    		'gender' => 'required',
    		'description' => 'required|alpha',
    		'price' => 'required|numeric|min:1000',
    	]);

        $destinationPath = public_path('img/pokemon');
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = uniqid().'.'.$extension;

        $request->file('image')->move($destinationPath, $fileName);

    	$pokemon = Pokemon::find($request->id);
    	$pokemon->name = $request->name;
    	$pokemon->element_id = $request->element;
    	$pokemon->image = $fileName;
    	$pokemon->gender = $request->gender;
    	$pokemon->description = $request->description;
    	$pokemon->price = $request->price;

    	$pokemon->save();

    	return $this->adminUpdate($request->id);
    }

    public function delete($id){
    	$pokemon = Pokemon::find($id);
    	$pokemon->delete();

    	return back();
    }
}
