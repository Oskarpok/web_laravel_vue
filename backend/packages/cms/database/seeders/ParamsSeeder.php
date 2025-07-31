<?php

namespace User\Database\Seeders;

use Illuminate\Database\Seeder;
use User\LaravelCms\Enums\ParamsType;
use User\LaravelCms\Models\Cms\Param;

class ParamsSeeder extends Seeder {
  
  public function run(): void {
    Param::create([
      'name' => 'address',
      'type' => ParamsType::Json->value,
      'value' => json_encode([
        'country' => 'Poland',
        'street' => 'Main St',
        'street_number' => '1A',
        'city' => 'Warsaw',
        'postal_code' => '00-000',
        'province' => 'Mazowieckie',
      ]),
    ]);
    Param::create([
      'name' => 'telefon',
      'type' => ParamsType::Integer->value,
      'value' => '123456789',
    ]);
    Param::create([
      'name' => 'project_name',
      'type' => ParamsType::String->value,
      'value' => 'testtest',
    ]);
    Param::create([
      'name' => 'tax_number',
      'type' => ParamsType::Integer->value,
      'value' => '0123456789',
    ]);
    Param::create([
      'name' => 'email',
      'type' => ParamsType::String->value,
      'value' => 'test@gmail.com',
    ]);
  }
}