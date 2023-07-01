<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DescriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $todo = new Description();
        $todo->content = $request->input('content');
        $todo->user_id = Auth::id();
        $todo->goal_id = $goal->id;
        $todo->done = false;
        $todo->save();

        return redirect()->route('goals.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal, Description $description)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $description->content = $request->input('content');
        $description->user_id = Auth::id();
        $description->goal_id = $goal->id;
        $description->done = $request->boolean('done', $description->done);
        $description->save();

        return redirect()->route('goals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal, Description $description)
    {
        $description->delete();

        return redirect()->route('goals.index');
    }
}
