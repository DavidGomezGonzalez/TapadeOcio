<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Municipio;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Carbon\Carbon;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $provincia = \App\Models\Provincia::has('municipios')->inRandomOrder()->first();

        return [
            'image' => base64_encode(file_get_contents($this->faker->imageUrl())),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'category_id' => $category = \App\Models\Category::inRandomOrder()->first(),
            'subcategory_id' => function () use ($category) {
                return $category->subcategories->count() ? $category->subcategories->random()->id : null;
            },
            'province' => $provincia->id,
            'municipality' => optional($provincia->municipios->random())->id,
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_time' => $this->faker->dateTimeBetween($this->faker->dateTimeThisMonth, '+3 months'),
            'place' => $this->faker->address(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }
}
