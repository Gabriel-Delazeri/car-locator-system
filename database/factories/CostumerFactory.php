<?php

namespace Database\Factories;

use Avlima\PhpCpfCnpjGenerator\Generator as GeneratorBR;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Costumer>
 */
class CostumerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'document_id' => GeneratorBR::cpf()
        ];
    }
}
