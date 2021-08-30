<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\User;

class chaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Chapters = Chapter::orderBy('order', 'ASC')->paginate(20);

        return View('chapters')
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
        $Chapter = New Chapter();
        $Chapter->public = 0;
        $Chapter->title = $request->title;
        $Chapter->thumb = $request->thumb;
        $Chapter->video = $request->video;
        $Chapter->body = $request->body;
        $Chapter->save();

        return redirect()->route( 'chapters' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Chapter = Chapter::find( $id );

        return view('chapter')
            ->with( 'Chapter', $Chapter );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return View('chapter-edit');
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
        $Chapter = Chapter::find( $id );
        $Chapter->public = 0;
        $Chapter->title = $request->title;
        $Chapter->thumb = $request->thumb;
        $Chapter->video = $request->video;
        $Chapter->body = $request->body;
        $Chapter->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Chapter = Chapter::find( $id );

        if( $Chapter )
        {
            $Chapter->delete();
        }

        return redirect()->route('chapters');
    }

    public function publish( $id )
    {
        $Chapter = Chapter::find( $id );
        $Chapter->public = 1;
        $Chapter->save();

        return redirect()->route( 'chapters' );
    }

    public function unpublish( $id ){
        $Chapter = Chapter::find( $id );
        $Chapter->public = 0;
        $Chapter->save();

        return redirect()->route( 'chapters' );
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

    public function changeOrder( Request $request )
    {
        if( ( $request->cid > 0 ) && ( $request->order > 0 ) )
        {   
            $CID    = $request->cid;
            $ORDER  = $request->order;

            $Chapter = Chapter::find( $CID );
            $Chapter->order = $ORDER;
            $Chapter->save();

            echo json_encode( route( 'chapters' ) );
        }
    }
}
