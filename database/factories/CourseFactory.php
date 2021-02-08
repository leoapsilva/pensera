<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

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
        $course_id = Course::all()->first();

        return [
            'name' => "Curso: " . $this->faker->word(2),
            'description' => $this->faker->catchPhrase(),
            'professor_id' => '1',
        ];
    }
}
