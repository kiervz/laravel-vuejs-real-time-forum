<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\TagsQuestion;

class QuestionController extends Controller
{
    
    /**
     * Create a new QuestionController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response    
     */
    public function store(QuestionRequest $request)
    {  
        $request['slug'] = $this->uniqueSlug($request['title']);
        $tags = $request['tag_id'];
        $question = auth()->user()->questions()->create($request->except('tag_id'));

        $question_tags = [];
        foreach($tags as $tag) {
            array_push($question_tags, ['tag_id' => $tag, 'question_id' => $question->id]);
        }
        TagsQuestion::insert($question_tags);

        return response()->json([
            new QuestionResource($question)
        ]);
    }

    private function uniqueSlug($title) {
        $slug = Str::slug($title, '-');
        $count = Question::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Question successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Question successfully deleted.'
        ]);
    }
}
