<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use User\LaravelCms\Http\Controllers\BaseController;
use User\LaravelCms\View\FormFields\Texts\TextsTypeController;

class ParamController extends BaseController {

  protected const MODEL_CLASS = \User\LaravelCms\Models\Cms\Param::class;

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
      new TextsTypeController([
        'type' => 'number',
        'name' => 'id',
        'label' => 'ID',
        'value' => $data?->id,
        'readonly' => true,
      ]),
      new TextsTypeController([
        'type' => 'text',
        'name' => 'name',
        'label' => 'Nazwa',
        'value' => $data?->name,
        'required' => true,
        'readonly' => false,
      ]),

    ];
  }

}