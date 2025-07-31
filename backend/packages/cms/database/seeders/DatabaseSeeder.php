<?php

namespace User\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  public function run(): void {
    $this->call([
      ParamsSeeder::class,
      UsersSeeder::class,
    ]);
  }
}
