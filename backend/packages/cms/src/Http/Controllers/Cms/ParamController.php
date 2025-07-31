<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use User\LaravelCms\Http\Controllers\BaseController;

class ParamController extends BaseController {

  protected const MODEL_CLASS = User\LaravelCms\Models\Cms\Param::class;

  protected function titles(): array {
    return [
      'index' => 'Parameters Panel',
    ];
  }

  protected function indexPrepare(Request $request): array {
    return [
      'data' => self::MODEL_CLASS::all(), 
    ];
  }

  protected function prepareFormFieldsForCrud($data = null): array {
    return [
      //
    ];
  }

}