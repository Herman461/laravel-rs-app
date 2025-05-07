<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = Attribute::factory(10)->create();

        $attributes->each(function ($attribute) {
            $options = Option::factory(rand(1, 5))->create();
            $optionIds = $options->pluck('id');
            $attribute->options()->attach($optionIds->toArray());
        });
    }
}
