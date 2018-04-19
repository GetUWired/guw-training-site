<?php

namespace App\Http\Controllers;

use App\ProblemSet;
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
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            $types = Problem::all()->pluck('type')->toJson();
            $problems = Problem::all();
//            dd($problems);
            $problemList = $problems->map(function ($group) {
                return [
                    "value" => $group->id,
                    "label" => $group->question,
                    "type"  => $group->type,
                ];
            });
            
            return view('sets.create', compact('problemList', 'problems', 'types'));
        }
        return redirect()->route('home')->with('status', 'warning')
                         ->with('message', 'You are not allowed to view that resource.');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            try {
                //Create Set
                $set = new Set;
                $set->name = $request->name;
                $set->save();
                
                //Add problems to set
                $problems = collect(json_decode($request->problems));
                $add = $problems->each(function ($item, $key) use ($set) {
                    $problem = new ProblemSet;
                    $problem->set_id = $set->id;
                    $problem->problem_id = $item->problem;
                    $problem->order = $item->order;
                    $problem->save();
                });
            } catch (\Exception $e) {
                return back()->with('status', 'warning')->with('title', 'Uh Oh!')
                             ->with('message', 'Something went wrong adding the problem.');
            }
            
            return back()->with('status', 'success')->with('title', 'Good Job!')->with('message', 'New Set Created!');
        }
        return redirect()->route('home')->with('status', 'warning')
                         ->with('message', 'You are not allowed to view that resource.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Set $set
     * @param           $id
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
     * @param  \App\Set $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Set                 $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Set $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        //
    }
}
