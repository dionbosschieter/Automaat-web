<?php namespace App\Http\Controllers;

use App\Bak;
use Request;

class BakController extends Controller
{
    public function index()
    {
        $bak = Bak::all();

        return view('bak.overview', compact('bak'));
    }

    public function edit($id)
    {
        $bak = Bak::findOrFail($id);

        return view('bak.edit', compact('bak'));
    }

    public function handleEdit($id)
    {
        $bak = Bak::findOrFail($id);
        $bak->name = Request::input('name');
        $bak->amount = Request::input('amount');
        $bak->apikey = Request::input('apikey');
        $bak->save();

        return redirect('overview');
    }

    public function view($id)
    {
        $bak = Bak::with('tickets')->findOrFail($id);

        return view('bak.view', compact('bak'));
    }
}