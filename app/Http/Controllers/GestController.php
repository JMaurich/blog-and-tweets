<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class GestController extends Controller
{
   public function index()
   {
   		$entries = Entry::with('user')
   		->orderbydesc('created_at')
   		->orderbydesc('id')
   		->paginate(10);
   	   	return view('welcome', compact('entries'));
   }
   public function show(Entry $entry)
   {
   	return view('entries.show', compact('entry'));
   }
}
