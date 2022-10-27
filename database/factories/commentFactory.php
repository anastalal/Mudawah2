<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class commentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(),
            'date_written'=>now(),
            'votes_up'=>$this->faker->numberBetween(1,50),
            'user_id'=>$this->faker->numberBetween(1,20),
            'post_id'=>$this->faker->numberBetween(1,20),

        ];
    }
}
