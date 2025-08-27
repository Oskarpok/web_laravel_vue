<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers\Cms;

use Illuminate\Http\Request;
use User\LaravelCms\Enums\UsersType;
use Illuminate\Support\Facades\Route;
use User\LaravelCms\View\FormFields\Texts\TextsTypeController;
use User\LaravelCms\View\FormFields\Select\SelectTypeController;
use User\LaravelCms\View\FormFields\Buttons\ButtonsTypeController;

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
      'data' => self::MODEL_CLASS::all(), 
    ];
  }

  protected function prepareFormFieldsForCrud($data = null): array {
    return [
      //
    ];
  }

}