<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\DateTime;

use User\LaravelCms\View\FormFields\BaseField;

class DateTimeTypeController extends BaseField {

  protected function controlMap(): array {
    return [
      'date_time' => Fields\DateTimeControl::class,
    ];
  }

}