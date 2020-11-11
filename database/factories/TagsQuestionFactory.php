<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\TagsQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagsQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => function() {
                return Tag::all()->random();
            },
            'question_id' => function() {
                return Question::all()->random();
            },
        ];
    }
}
