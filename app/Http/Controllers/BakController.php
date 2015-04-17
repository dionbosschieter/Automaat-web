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

    public function update($id)
    {
        $bak = Bak::findOrFail($id);
        $bak->name = Request::input('name');
        $bak->apikey = Request::input('apikey');
        $bak->save();

        return redirect('overview');
    }

    public function view($id)
    {
        $bak = Bak::with('tickets')->findOrFail($id);

        return view('bak.view', compact('bak'));
    }

    /**
     * Set the close trunks status code if status is not busy
     *
     * @param int $id of Bak
     * @return \Illuminate\Http\RedirectResponse
     */
    public function closeTrunks($id)
    {
        $bak = Bak::findOrFail($id);

        if($bak->status != 2) {
            $bak->status = 3;
            $bak->save();
        }

        return redirect()->route('bak.view', [$id]);
    }

}