<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;

use Auth;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $Chapters = Chapter::where('public', 1)->where('id', '<=', Auth::user()->progress )->get();

        return View('results')
            ->with( 'Chapters', $Chapters );
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getQuestions( $cid )
    {
        $Questions = Question::where( 'chapter', $cid )->get();

        return $Questions;
    }

    public static function getAnswers( $qid )
    {
        $Answers = Answer::where( 'qid', $qid )->get();

        return $Answers;
    }

    public static function getUserAnswers( $qid )
    {
        $UserAnswers = UserAnswer::where( 'qid', $qid )->get();
        return $UserAnswers;
    }
}
