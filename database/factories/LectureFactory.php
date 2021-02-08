<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $link = $this->faker->randomElement([   "KQ6zr6kCPj8",
                                                "HCfPhZQz2CE",
                                                "OPf0YbXqDm0",
                                                "ZbZSe6N_BXs",
                                                "ru0K8uYEZWw",
                                                "uT3SBzmDxGk",]);
        $course_id = Course::all()->last();

        return [
            'name' => "Aula: " . $this->faker->word(),
            'description' => $this->faker->catchPhrase(),
            'link' => $link,
            'course_id' => $course_id,
        ];
    }
}
