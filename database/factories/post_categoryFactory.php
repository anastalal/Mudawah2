<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class post_categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'=>$this->faker->numberBetween(1,9),
            'category_id'=>$this->faker->numberBetween(1,9) 
        ];
    }
}
