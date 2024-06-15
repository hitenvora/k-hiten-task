<?php

namespace App\Http\Controllers\API\Web;


use App\Http\Controllers\Controller;

use App\Models\FrequentlyAskedQuestion;
use App\Http\Requests\FrequentlyAskedQuestionRequest;
use App\Http\Resources\FrequentlyAskedQuestionResource;

class FrequentlyAskedQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequentlyaskedquestions = FrequentlyAskedQuestion::paginate(15);
        return FrequentlyAskedQuestionResource::collection($frequentlyaskedquestions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FrequentlyAskedQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrequentlyAskedQuestionRequest $request)
    {
        $frequentlyaskedquestion = new FrequentlyAskedQuestion;
		$frequentlyaskedquestion->title = $request->input('title');
		$frequentlyaskedquestion->message = $request->input('message');
        $frequentlyaskedquestion->save();

        return response()->json($frequentlyaskedquestion, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frequentlyaskedquestion = FrequentlyAskedQuestion::findOrFail($id);
        return new FrequentlyAskedQuestionResource($frequentlyaskedquestion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FrequentlyAskedQuestionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FrequentlyAskedQuestionRequest $request, $id)
    {
        $frequentlyaskedquestion = FrequentlyAskedQuestion::findOrFail($id);
		$frequentlyaskedquestion->title = $request->input('title');
		$frequentlyaskedquestion->message = $request->input('message');
        $frequentlyaskedquestion->save();

        return response()->json($frequentlyaskedquestion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frequentlyaskedquestion = FrequentlyAskedQuestion::findOrFail($id);
        $frequentlyaskedquestion->delete();

        return response()->json(null, 204);
    }
}
