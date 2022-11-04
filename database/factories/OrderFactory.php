<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'order_status_id' => $this->faker-> random_int(1,3),
            'driver_id' => $this->faker-> randomDigitNotZero(),
            'customer_id' => $this->faker-> randomDigitNotZero(),
            'order_number' => $this->faker-> randomDigitNotZero(),
            'order_number' => $this->faker-> randomDigitNotZero(),
            'products_number' => $this->faker-> randomDigitNotZero(),



        ];
    }
}
