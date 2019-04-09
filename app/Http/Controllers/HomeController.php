<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = Movies::orderBy('id','asc')->paginate(10); //page number
        return view('home')->with('movies',$movies);
    }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('modifymov');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $movie = new Movies;
            $movie->id = $request->input('id');
            $movie->name = $request->input('name');
            $movie->mov_time = $request->input('mov-time');
            $movie->description = $request->input('description');
            $movie->category = $request->input('category');
            $movie->img = $request->input('img');
            $movie->save();

            return redirect('/movies');
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $movies = Movies::find($id);
            return view('editmov')->with('movies',$movies);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $movie = Movies::find($id);
            $movie->id = $request->input('id');
            $movie->name = $request->input('name');
            $movie->mov_time = $request->input('mov-time');
            $movie->description = $request->input('description');
            $movie->category = $request->input('category');
            $movie->img = $request->input('img');
            $movie->save();

            return redirect('/movies');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $movie = Movies::find($id);
            $movie->delete();
            return redirect('/movies');
        }
}
