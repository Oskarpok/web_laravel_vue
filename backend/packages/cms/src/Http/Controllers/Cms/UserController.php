<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use User\LaravelCms\View\FormFields\Texts\TextsTypeController;
use User\LaravelCms\View\FormFields\Select\SelectTypeController;
use User\LaravelCms\View\FormFields\Buttons\ButtonsTypeController;
use User\LaravelCms\View\FormFields\DateTime\DateTimeTypeController;

class UserController extends \User\LaravelCms\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \User\LaravelCms\Models\Cms\User::class;
  protected const ROUTE_NAME = 'cms.users.';

  protected function titles(): array {
    return [
      'index' => 'Users Panel',
      'create' => 'Users Create Panel',
      'edit' => 'Users Edit Panel',
      'show' => 'Users Show Panel',
    ];
  }

  protected function indexPrepare(Request $request): array {
    return [
      'data' => self::MODEL_CLASS::all()->append('type_label'), 
      'labels' => [
        'Id', 'First Name', 'Sur Name', 'Phone', 'Email', 'Type', 
        'Verified', 'Created ', 'Updated'
      ],
      'filterable' => [
        'id' => true, 'first_name' => true, 'sur_name' => true, 'phone' => true, 
        'email' => true, 'type' => false, 'email_verified_at ' => false, 
        'created_at' => true, 'updated_at' => true,
      ],
      'buttons' => [
        new ButtonsTypeController([
          'type' => 'anchore',
          'route' => 'cms/users/create',
          'label' => 'Dodaj Urzytkownika',
          'icone' => 'fa-solid fa-plus',
          'readonly' => false,
        ]),
      ],
    ];
  }

  protected function prepareFormFieldsForCrud($data = null): array {
    $currentRoute = Route::currentRouteName();
    return [
      'fields' =>[
        (function($currentRoute, $id) {
          if($currentRoute !== self::ROUTE_NAME . 'create') {
            return new TextsTypeController([
              'type' => 'number',
              'name' => 'id',
              'label' => 'ID',
              'value' => $id,
              'required' => true,
              'width' => 'flex flex-col w-full md:w-[49%]',
              'readonly' => true,
            ]);
          }
        })($currentRoute, $data?->id),
        new TextsTypeController([
          'type' => 'text',
          'name' => 'first_name',
          'label' => 'Imie użytkownika',
          'required' => true,
          'value' => $data?->first_name,
          'width' => 'flex flex-col w-full md:w-[49%]',
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
        new TextsTypeController([
          'type' => 'text',
          'name' => 'sur_name',
          'label' => 'Nazwisko użytkownika',
          'value' => $data?->sur_name,
          'required' => true,
          'width' => 'flex flex-col w-full md:w-[49%]',
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
        new TextsTypeController([
          'type' => 'email',
          'name' => 'email',
          'label' => 'Email',
          'value' => $data?->email,
          'required' => true,
          'width' => 'flex flex-col w-full md:w-[49%]',
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
        new TextsTypeController([
          'type' => 'phone',
          'name' => 'phone',
          'label' => 'Telefon',
          'value' => $data?->phone,
          'required' => true,
          'width' => 'flex flex-col w-full md:w-[49%]',
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
        new SelectTypeController([
          'type' => 'select',
          'name' => 'type',
          'label' => 'Type',
          'options' => \User\LaravelCms\Enums\UsersType::toArray() ?? [],
          'required' => true,
          'value' => $data?->type,
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true
        ]),
        (function($currentRoute, $email_verified_at) {
          if($currentRoute !== self::ROUTE_NAME . 'create') {
            return new DateTimeTypeController([
              'type' => 'date_time',
              'name' => 'email_verified_at',
              'label' => 'Zweryfikoany',
              'tooltip' => 'Brak daty ozacza brak weryfikacji',
              'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
                ? false : true,
              'value' => $email_verified_at,
            ]);
          }
        })($currentRoute, $data?->email_verified_at),
        (function($currentRoute, $created_at) {
          if($currentRoute !== self::ROUTE_NAME . 'create') {
            return new DateTimeTypeController([
              'type' => 'date_time',
              'name' => 'created_at',
              'label' => 'Utworzony',
              'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
                ? false : true,
              'value' => $created_at,
            ]);
          }
        })($currentRoute, $data?->created_at),
        (function($currentRoute, $updated_at) {
          if($currentRoute !== self::ROUTE_NAME . 'create') {
            return new DateTimeTypeController([
              'type' => 'date_time',
              'name' => 'updated_at',
              'label' => 'Zaktualizowany',
              'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
                ? false : true,
              'value' => $updated_at,
            ]);
          }
        })($currentRoute, $data?->updated_at),
      ],
      'buttons' => [
        (function($currentRoute) {
          if ($currentRoute !== self::ROUTE_NAME . 'show') {
            return new ButtonsTypeController([
              'type' => 'submit',
              'label' => 'Zapisz',
              'icone' => 'fa-solid fa-file',
              'readonly' => false,
            ]);
          }
        })($currentRoute),
        new ButtonsTypeController([
          'type' => 'anchore',
          'route' => 'cms/users',
          'label' => 'Powrut',
          'icone' => 'fa-solid fa-arrow-left',
          'readonly' => false,
        ]),
      ],
    ];
  }

}