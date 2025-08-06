<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'fecha' => $this->faker->date(),
            'activo' => $this->faker->boolean(),
            'comentarios' => $this->faker->text(),
            'iva' => $this->faker->boolean(),
            'total' => $this->faker->randomFloat(),
            'subtotal' => $this->faker->randomFloat(),
            'descuento' => $this->faker->randomFloat(),
            'cantidad_productos' => $this->faker->randomDigit(),
        ];
    }
}
