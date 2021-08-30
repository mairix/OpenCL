<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Question;
use App\Models\UserAnswer;

use Auth;

class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$Take = Question::where('uid', Auth::user()->id)->where('qid', )->get();

        foreach ($request->answer as $key => $value) {
            $Chapter = New UserAnswer();
            $Chapter->uid = Auth::user()->id;
            $Chapter->qid = $key;
            $Chapter->aid = $value;
            $Chapter->save();

            $User = User::find( Auth::user()->id );
            $User->progress = $request->chapter;
            $User->save();
        }

        return back()->withInput();
    }
}
