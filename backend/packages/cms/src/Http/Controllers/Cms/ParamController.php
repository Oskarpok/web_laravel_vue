<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use User\LaravelCms\Enums\ParamsType;
use User\LaravelCms\Http\Controllers\BaseController;
use User\LaravelCms\View\FormFields\Texts\TextsTypeController;
use User\LaravelCms\View\FormFields\Select\SelectTypeController;
use User\LaravelCms\View\FormFields\DateTime\DateTimeTypeController;

class ParamController extends BaseController {

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
      'data' => self::MODEL_CLASS::all(), 
      'labels' => [
        'Id', 'Name', 'Type', 'Value', 'Created at', 'Updated at', 'Actions',
      ],
      'filterable' => [
        'id' => true, 'name' => true, 'type' => true, 'value' => false, 
        'created_at' => true, 'updated_at' => true,
      ], 
      'buttons' => [

      ],
    ];
  }

  protected function prepareFormFieldsForCrud($data = null): array {
    $currentRoute = Route::currentRouteName();
    return [
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
        'readonly' => false,
      ]),
      new SelectTypeController([
        'type' => 'select',
        'name' => 'type',
        'label' => 'Type',
        'options' => ParamsType::toArray() ?? [],
        'required' => true,
        'value' => $data?->type,
        'readonly' => false
      ]),
      new TextsTypeController([
        'type' => 'text_area',
        'name' => 'value',
        'label' => 'Wartość',
        'required' => true,
        'value' => $data?->value,
        'tooltip' => "",
        'readonly' => false,
      ]),
      (function($currentRoute, $created_at) {
        if($currentRoute !== self::ROUTE_NAME . 'create') {
          return new DateTimeTypeController([
            'type' => 'date_time',
            'name' => 'created_at',
            'label' => 'Utworzony',
            'readonly' => true,
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
            'readonly' => true,
            'value' => $updated_at,
          ]);
        }
      })($currentRoute, $data?->updated_at),
    ];
  }

}