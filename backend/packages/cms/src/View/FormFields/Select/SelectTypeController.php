<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Select;

use User\LaravelCms\View\FormFields\BaseField;

class SelectTypeController extends BaseField {

  protected function controlMap(): array {
    return [
      'select' => Fields\SelectControl::class,
      'checkbox' => Fields\CheckBoxControl::class,
    ];
  }

}