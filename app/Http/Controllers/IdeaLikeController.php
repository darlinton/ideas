<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea)
    {
        /**
        * @var User
        */
        $liker = auth()->user();
        $liker->likes()->attach($idea);

        return redirect()->route('ideas.show', $idea->id)->with('success', "liked successfully!");
    }

    public function unlike(Idea $idea)
    {
        /**
        * @var User
        */
        $liker = auth()->user();
        $liker->likes()->detach($idea);

        return redirect()->route('ideas.show', $idea->id)->with('success', "unliked successfully!");
    }


}
