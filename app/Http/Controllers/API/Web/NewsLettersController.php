<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;

use App\Models\NewsLetter;
use App\Http\Requests\NewsLetterRequest;
use App\Http\Resources\NewsLetterResource;

class NewsLettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = NewsLetter::paginate(15);
        return NewsLetterResource::collection($newsletters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NewsLetterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsLetterRequest $request)
    {
        $newsletter = new NewsLetter;
		$newsletter->name = $request->input('name');
		$newsletter->email = $request->input('email');
        $newsletter->save();

        return response()->json($newsletter, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsletter = NewsLetter::findOrFail($id);
        return new NewsLetterResource($newsletter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NewsLetterRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsLetterRequest $request, $id)
    {
        $newsletter = NewsLetter::findOrFail($id);
		$newsletter->name = $request->input('name');
		$newsletter->email = $request->input('email');
        $newsletter->save();

        return response()->json($newsletter);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter = NewsLetter::findOrFail($id);
        $newsletter->delete();

        return response()->json(null, 204);
    }
}
