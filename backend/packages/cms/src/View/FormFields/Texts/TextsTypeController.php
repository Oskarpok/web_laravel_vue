<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Texts;

use User\LaravelCms\View\FormFields\BaseField;

class TextsTypeController extends BaseField {

  protected function controlMap(): array {
    return [
      'text' => Fields\TextField::class,
      'text_area' => Fields\TextAreaControl::class,
      'number' => Fields\NumberControl::class,
    ];
  }

}