<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>$this->faker->word(),
            'content'=>$this->faker->text(),
             'date_written'=>now(),
             'featured_image'=>$this->faker->image(storage_path('app'),800,600),
             'votes_up'=>$this->faker->numberBetween(0,100000),
             'user_id'=>$this->faker->numberBetween(1,9),
             'category_id'=>$this->faker->numberBetween(1,5) 
            
        ];
    }
}
