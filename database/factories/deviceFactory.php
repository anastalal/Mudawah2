<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class deviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'model' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(3000,70000),
            'parent_id'=>$this->faker->numberBetween(0,9)

        ];
    }
}
