<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use User\LaravelCms\View\FormFields\Texts\TextsTypeController;
use User\LaravelCms\View\FormFields\Select\SelectTypeController;
use User\LaravelCms\View\FormFields\Buttons\ButtonsTypeController;
use User\LaravelCms\View\FormFields\DateTime\DateTimeTypeController;

class ParamController extends \User\LaravelCms\Http\Controllers\BaseController {

  protected const MODEL_CLASS = \User\LaravelCms\Models\Cms\Param::class;
  protected const ROUTE_NAME = 'cms.params.';

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
      'create' => 'Parameters Create Panel',
      'edit' => 'Parameters Edit Panel',
      'show' => 'Parameters Show Panel',
    ];
  }

  protected function indexPrepare(Request $request): array {
    return [
      'data' => self::MODEL_CLASS::all()->append(['type_label', 'value']), 
      'labels' => [
        'Id', 'Name', 'Type', 'Value', 'Created at', 'Updated at',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'type' => true, 'value' => false, 
        'created_at' => true, 'updated_at' => true,
      ], 
      'buttons' => [
        new ButtonsTypeController([
          'type' => 'anchore',
          'route' => 'cms/params/create',
          'label' => 'Dodaj parametr',
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
              'readonly' => true,
            ]);
          }
        })($currentRoute, $data?->id),
        new TextsTypeController([
          'type' => 'text',
          'name' => 'name',
          'label' => 'Nazwa',
          'value' => $data?->name,
          'required' => true,
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
        new SelectTypeController([
          'type' => 'select',
          'name' => 'type',
          'label' => 'Type',
          'options' => \User\LaravelCms\Enums\ParamsType::toArray() ?? [],
          'required' => true,
          'value' => $data?->type,
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true
        ]),
        new TextsTypeController([
          'type' => 'text_area',
          'name' => 'value',
          'label' => 'Wartość',
          'required' => true,
          'value' => $data?->value,
          'tooltip' => "",
          'readonly' => $currentRoute !== self::ROUTE_NAME . 'show' 
            ? false : true,
        ]),
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
          'route' => 'cms/params',
          'label' => 'Powrut',
          'icone' => 'fa-solid fa-arrow-left',
          'readonly' => false,
        ]),
      ],
    ];
  }

}