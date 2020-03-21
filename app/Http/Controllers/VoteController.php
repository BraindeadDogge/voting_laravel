<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;

class VoteController extends Controller
{
    public function showAll() {
        $votes = Vote::paginate(2);
        return view('index', ['votes' => $votes]);
    }
    
    public function showCurrent($id) {
        $vote = Vote::findOrFail($id);
        return view('show_vote', ['vote' => $vote]);
    }

    public function increasePositive($id) {
        $vote = Vote::findOrFail($id);
        $vote->positive++;
        $vote->save();
        return back();
    }
    
    public function increaseNegative($id) {
        $vote = Vote::findOrFail($id);
        $vote->negative++;
        $vote->save();
        return back();
    }

    public function create(Request $request) {
        $votes = new Vote;
        $votes->title = $request->title;
        $votes->text = $request->text;
        $votes->positive = 0;
        $votes->negative = 0;
        $votes->save();
        return redirect('/');
    }
}
