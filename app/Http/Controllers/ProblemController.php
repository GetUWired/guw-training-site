<?php

namespace App\Http\Controllers;

use Auth;
use App\Problem;
use App\User;
use App\Hint;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index($problem)
    {
        $problemList = Problem::where('type', $problem)->with('hints')->get();
        $user = Auth::user();
        $problemRelations = $user->problems()->get();

        return view('languages.index', compact('problemList', 'problemRelations', 'problem'));
    }

    public function show($problem)
    {
        $problem = Problem::where('id', $problem)->with('hints')->first();
        $user = Auth::user();
        $problemRelations = $user->problems()->get();

        return view('languages.show', compact('problem', 'problemRelations'));
    }

    public function create()
    {
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            return view('forms.problemadd');
        }
        return redirect()->route('home')->with('status', 'warning')->with('message', 'You are not allowed to view that resource.');
    }

    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            try {
                $problem = new Problem;

                $problem->question = $request->problem;
                $problem->type = $request->type;
                $problem->points = $request->points;
                $problem->save();

                foreach ($request->hint as $hint) {
                    $newHint = new Hint;
                    $newHint->problem_id = $problem->id;
                    $newHint->hint = $hint;
                    $newHint->save();
                }

                if ($problem) {
                    return back()->with('status', 'success')->with('title', 'Good Job!')->with('message', 'New Problem Created!');
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return back()->with('status', 'warning')->with('title', 'Uh Oh!')->with('message', 'Something went wrong adding the problem.');
            }
        } else {
            return redirect()->route('home')->with('status', 'warning')->with('title', 'Uh Oh!')->with('message', 'You are not allowed to view that resource.');
        }
    }

    public function leaders()
    {
        $users = User::all();
        $leaders = [];
        foreach ($users as $user) {
            $leaders[] = [
                'user' => $user,
                'points' => $user->problems->sum('points')
            ];
        }

        usort($leaders, 'sort_by_score');

        return view('leaderboard', compact('leaders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem, $id)
    {
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            $question = Problem::where('id', $id)->with('hints')->first();
            return view('forms.problemedit', compact('question'));
        }
        return redirect()->route('home')->with('status', 'warning')->with('title', 'Uh Oh!')->with('message', 'You are not allowed to view that resource.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Problem $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem, $id)
    {
        if (Auth::check() && (Auth::user()->user_level == 10 || Auth::user()->isAdmin())) {
            $problem = Problem::findOrFail($id);
            $problem->question = $request->problem;
            $problem->type = $request->type;
            $problem->points = $request->points;
            $problem->save();
    
            foreach ($request->hinterList as $hint) {
                $hint = json_decode($hint, true);
                if (Hint::where('id', $hint['id'])->exists()) {
                    $hintExists = Hint::where('id', $hint['id'])->first();
                    $hintExists->hint = $hint['hint'];
                    $hintExists->save();
                } else {
                    $newHint = new Hint;
                    $newHint->problem_id = $problem->id;
                    $newHint->hint = $hint['hint'];
                    $newHint->save();
                }
            }
    
            if ($problem) {
                return back()->with('status', 'success')->with('title', 'Good Job!')->with('message', 'Problem Updated.');
            }
    
            return back()->with('status', 'warning')->with('title', 'Uh Oh!')
                         ->with('message', 'Something went wrong updating the problem.');
        }
        return redirect()->route('home')->with('status', 'warning')->with('title', 'Uh Oh!')->with('message', 'You are not allowed to view that resource.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        //
    }
    
    public function search(Request $request)
    {
        $problemList = Problem::search($request->search_term)->get();
        $user = Auth::user();
        $problemRelations = $user->problems()->get();

        return view('languages.search-results', compact('problemList', 'problemRelations'));
    }
}
