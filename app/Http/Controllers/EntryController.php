<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
	public function construct()
	{
		$this->middleware('auth');
	}
    
    public function create()
    {
    	return view('entries.create');
    }

    public function store(Request $request)
    {
    	/*dd($request->all());*/
    	$validatedData = $request->validate([
    		'title' => 'required|min:7|max:255|unique:entries', // valida que ese titule sea unico, o sea que no se duplique
    		'content' => 'required|min:25|max:3000'
    	]);

    	$entry = new Entry();
    	$entry->title = $validatedData['title'];
    	$entry->content = $validatedData['content'];
    	$entry->user_id = auth()->id();
    	$entry->save(); /*inserta la informacion en la tabla*/

    	$status = 'Your entry has been published successfully,';
    	return back()->with(compact('status'));
    }
    public function edit(Entry $entry)
    {
        $this->authorize('update', $entry);
        return view('entries.edit', compact('entry'));
    }


public function update(Request $request, Entry $entry)
    {

        $this->authorize('update', $entry);
        /*dd($request->all());*/
        $validatedData = $request->validate([
            'title' => 'required|min:7|max:255|unique:entries,id,'.$entry->id, // valida que ese titulo sea unico con excepcion de este que se esta modificando.
            'content' => 'required|min:25|max:3000'
        ]);

        //TODO: PERMITIR EDITAR SOLAMENTE POR EL AUTOR

        //auth()->id() === $entry->user_id
        $entry->title = $validatedData['title'];
        $entry->content = $validatedData['content'];
        $entry->save(); /*inserta la informacion en la tabla*/

        $status = 'Your entry has been updated successfully,';
        return back()->with(compact('status'));
    }



}

