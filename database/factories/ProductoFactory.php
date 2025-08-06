<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->word,
            'costo_unitario' => $this->faker->randomFloat(2, 10, 1000),
            'activo' => $this->faker->boolean,
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
