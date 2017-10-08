<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Element;

class ElementController extends Controller
{
    public function insert(){
    	$action = 'insert';

    	return view('element.edit', compact('action'));
    }

    public function update(){
    	$elements = Element::all();

    	return view('element.search', compact('elements'));
    }

    public function edit(Request $request){

    	$this->validate($request, [
	    	'element' => 'required',
	    ]);

    	$action = 'update';

    	$element = Element::find($request->element);

    	return view('element.edit', compact('action', 'element'));
    }

    public function save(Request $request){
    	$element = new Element();

    	if($request->id !== ''){
	    	$element = Element::find($request->id);
	    }

	    $request->name = strtolower($request->name);

	    $this->validate($request, [
	    	'name' => 'required|unique:elements,name,'.$element->id,
	    ]);

    	$element->name = $request->name;
    	$element->save();

    	return $this->update();
    }
}
