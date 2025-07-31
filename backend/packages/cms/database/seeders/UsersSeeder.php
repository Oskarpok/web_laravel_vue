<?php

namespace User\Database\Seeders;

use Illuminate\Database\Seeder;
use User\LaravelCms\Enums\UsersType;
use User\LaravelCms\Models\Cms\User;

class UsersSeeder extends Seeder {
  /**
   * Seed the application's database for users table.
   */
  public function run(): void {
    User::create([
      'name' => 'admin',
      'first_name' => 'admin_admin',
      'sur_name' => 'admin_admin_admin',
      'phone' => '48234567891',
      'type' => UsersType::Administrator->value,
      'email' => 'admin@example.com',
      'password' => 'admin!1234',
    ]);
    User::create([
      'name' => 'owner',
      'first_name' => 'owner_owner',
      'sur_name' => 'owner_owner_owner',
      'phone' => '48345678912',
      'type' => UsersType::Owner->value,
      'email' => 'owner@example.com',
      'password' => 'owner!1234',
    ]);
    User::create([
      'name' => 'manager',
      'first_name' => 'manager_manager',
      'sur_name' => 'manager_manager_manager',
      'phone' => '48456789123',
      'type' => UsersType::Manager->value,
      'email' => 'manager@example.com',
      'password' => 'manager!1234',
    ]);
    User::create([
      'name' => 'cms_user',
      'first_name' => 'cms_user_cms_user',
      'sur_name' => 'cms_user_cms_user_cms_user',
      'phone' => '48567891234',
      'type' => UsersType::CmsUser->value,
      'email' => 'cmsuser@example.com',
      'password' => 'cmsuser!1234',
    ]);
    User::create([
      'name' => 'user',
      'first_name' => 'user_user',
      'sur_name' => 'user_user_user',
      'phone' => '48678912345',
      'type' => UsersType::User->value,
      'email' => 'user@example.com',
      'password' => 'user!1234',
    ]);
  }
}