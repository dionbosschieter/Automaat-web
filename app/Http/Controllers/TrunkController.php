<?php namespace App\Http\Controllers;

use App\Trunk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrunkController extends Controller {

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $trunk = Trunk::findOrFail($id);

		return view('trunk.edit', ['trunk' => $trunk]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
     * @param  Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$trunk = Trunk::findOrFail($id);
        $trunk->update($request->input());

        return redirect()->route('bak.view', $trunk->bak_id);
	}


}
