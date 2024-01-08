<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea){
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(403);
        }
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(403);
        }

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);
        $idea->update($validated);

        return redirect()->route('ideas.show',$idea->id)->with('success', 'Idea updated successfully.');
    }

    public function store(){
        //dump($_POST);
        //dump(request()->get('idea',''));

        $validated = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully.');
    }

    public function destroy(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(403);
        }

        //Idea::destroy($id); -error if id does not exist
        //$idea = Idea::where('id',$id)->firstOrFail()->delete();
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully.');
    }
}
