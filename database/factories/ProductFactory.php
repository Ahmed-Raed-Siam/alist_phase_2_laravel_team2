<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

    if (!file_exists('public/uploads/images')) {
        File::makeDirectory('public/uploads/images');
    }

        return [

            'category_id' => 1,
            'product_picture' => $this->faker->name(),
           'product_picture' => $this->faker->image('public/uploads/images',640,480, null, false),
            'product_name' => $this->faker->name,
            'product_name_en' => $this->faker->name,
            'product_date' => $this->faker->date(),
            'product_price' => $this->faker->randomDigitNotZero,
            'product_barcode' => $this->faker->randomDigitNotZero,
            'produect_unit' => $this->faker->name(),
            'status' => $this->faker->randomElement(['Available', 'Unavailable']),
            'product_details' => $this->faker->name(),
            // 'category_id' => $this->faker->category_id,
        ];
    }
}
