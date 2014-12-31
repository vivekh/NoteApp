<?php

class NoteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$notes = Note::all();
		return Response::json(array('response' => $notes));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title' => 'required',
			'note' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		$note = new Note;
		$note->title = Input::get('title');
		$note->note = Input::get('note');
		$note->save();
		return Response::json('saved');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$note = Note::find($id);
		return Response::json($note);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'title' => 'required',
			'note' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		$note = Note::find($id);
		$note->title = Input::get('title');
		$note->note = Input::get('note');
		$note->save();
		return Response::json('updated');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$note = Note::find($id);
		$note->delete();
	}


}
