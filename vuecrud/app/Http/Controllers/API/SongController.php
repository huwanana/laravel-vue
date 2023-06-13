<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
  public function index()
  {
    $songs = Song::all();
		if($songs->count() > 0){
			return response()->json([
				'status' => 200,
				'songs' => $songs
			], 200);
		}else{
			return response()->json([
				'status' => 404,
				'message' => 'No Records Found'
			], 404);
		}
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
			'title' => 'required|string',
			'genre' => 'required|string',
			'artist' => 'required|string'
		]);
		if($validator->fails()){
			return response()->json([
				'status' => 422,
				'errors' => $validator->messages()
			], 422);
		}else{
			$song = Song::create([
				'title' => $request->title,
				'genre' => $request->genre,
				'artist' => $request->artist
			]);
			if($song){
				return response()->json([
					'status' => 200,
					'message' => 'Song created successfully!'
				], 200);
			}else{
				return response()->json([
					'status' => 500,
					'message' => 'Something went wrong...'
				], 500);
			}
		}
  }
  
  public function show($id)
  {
    $song = Song::find($id);
		if($song){
			return response()->json([
				'status' => 200,
				'song' => $song
			], 200);
		}else{
			return response()->json([
				'status' => 404,
				'message' => 'No song found'
			], 404);
		}
  }
  
  public function edit($id)
  {
    $song = Song::find($id);
		if($song){
			return response()->json([
				'status' => 200,
				'song' => $song
			], 200);
		}else{
			return response()->json([
				'status' => 404,
				'message' => 'No song found'
			], 404);
		}
  }
  
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
			'title' => 'required|string',
			'genre' => 'required|string',
			'artist' => 'required|string'
		]);
		if($validator->fails()){
			return response()->json([
				'status' => 422,
				'errors' => $validator->messages()
			], 422);
		}else{
			$song = Song::find($id);
			if($song){
				$song->update([
					'title' => $request->title,
					'genre' => $request->genre,
					'artist' => $request->artist
				]);
				return response()->json([
					'status' => 200,
					'message' => 'Song updated successfully!'
				], 200);
			}else{
				return response()->json([
					'status' => 404,
					'message' => 'No song found'
				], 404);
			}
		}
  }
  
  public function destroy($id)
  {
    $song = Song::find($id);
		if($song){
			$song->delete();
			return response()->json([
				'status' => 200,
				'message' => 'Song deleted successfully!'
			], 200);
		}else{
			return response()->json([
				'status' => 404,
				'message' => 'No song found'
			], 404);
		}
  }
}
