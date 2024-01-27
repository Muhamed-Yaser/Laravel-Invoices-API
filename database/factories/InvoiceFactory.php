<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['P', 'B' ,'V']); // billed , paid , void
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(100,20000), //mustnot be 0 or negative
            'status' => $status,
            'billed_date' => $this->faker->dateTimeThisDecade(), //random time from this decade العقد
            'paid_date' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
