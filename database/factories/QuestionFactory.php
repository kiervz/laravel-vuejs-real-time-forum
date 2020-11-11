<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $this->faker->realText(500),
        'user_id' => function() {
            return User::all()->random();
        }
    ];
    }
}
