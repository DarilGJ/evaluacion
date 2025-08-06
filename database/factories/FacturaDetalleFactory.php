<?php

namespace Database\Factories;

use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacturaDetalle>
 */
class FacturaDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'factura_id' => Factura::factory(),
            'producto_id' => Producto::factory(),
            'cantidad' => $this->faker->randomDigit(),
            'total' => $this->faker->randomFloat(),
            'subtotal' => $this->faker->randomFloat(),
            'iva' => $this->faker->randomFloat(),
            'descuento' => $this->faker->randomFloat(),
        ];
    }
}
