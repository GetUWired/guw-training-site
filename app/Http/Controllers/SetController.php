<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Set;
use App\Problem;
use Illuminate\Http\Request;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = Set::with('problems')->paginate(20);

        return view('sets.index', compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set $set
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set, $id)
    {
//        $steps = Set::where('set_id', $id)->with('problem')->with('problem.hints')->get();

        $set = Set::where('id', $id)->with('problems')->with('problems.hints')->first();

        $user = Auth::user();
        $problemRelations = $user->problems()->get();

        return view('sets.show', compact('set', 'problemRelations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        //
    }
}
