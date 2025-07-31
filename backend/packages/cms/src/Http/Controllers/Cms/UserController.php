<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use User\LaravelCms\Http\Controllers\BaseController;

class UserController extends BaseController {

  protected const MODEL_CLASS = \User\LaravelCms\Models\Cms\User::class;

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