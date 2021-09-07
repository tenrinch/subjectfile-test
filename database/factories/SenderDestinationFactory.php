<?php

namespace Database\Factories;

use App\Models\SenderDestination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SenderDestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SenderDestination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => Str::random(15),
            'fixed'         => 1,
            'department_id' => 1,
        ];
    }
}
