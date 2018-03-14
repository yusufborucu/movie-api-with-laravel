<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Movie;
use App\Http\Resources\Movie as MovieResource;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get movies
        $movies = Movie::all();

        // Return collection of movies as a resource
        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = $request->isMethod('put') ? Movie::findOrFail
        ($request->movie_id) : new Movie;

        $movie->id = $request->input('movie_id');
        $movie->name = $request->input('name');
        $movie->description = $request->input('description');
        $movie->year = $request->input('year');
        $movie->rate = $request->input('rate');
        $movie->image = $request->input('image');
        $movie->director = $request->input('director');
        $movie->writers = $request->input('writers');
        $movie->stars = $request->input('stars');

        if ($movie->save()) {
            return new MovieResource($movie);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get movie
        $movie = Movie::findOrFail($id);

        // Return single movie as a resource
        return new MovieResource($movie);
    }

    public function search($text)
    {
        // Get searched movies
        $movies = DB::table('movies')->where('name', 'like', '%'.$text.'%')->get();

        // Return collection of searched movies as a resource
        return $movies;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get movie
        $movie = Movie::findOrFail($id);

        if ($movie->delete()) {
            return new MovieResource($movie);
        }
    }
}
