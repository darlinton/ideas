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
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea){
        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->content = request()->get('content');
        $idea->save();

        return redirect()->route('ideas.show',$idea->id)->with('success', 'Idea updated successfully.');
    }

    public function store(){
        //dump($_POST);
        //dump(request()->get('idea',''));

        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea = Idea::create([
            'content' => request()->get('content',''),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully.');
    }

    public function destroy(Idea $idea){
        //Idea::destroy($id); -error if id does not exist
        //$idea = Idea::where('id',$id)->firstOrFail()->delete();
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully.');
    }
}
