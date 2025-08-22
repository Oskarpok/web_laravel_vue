<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Buttons;

use User\LaravelCms\View\FormFields\BaseField;

class ButtonsTypeController extends BaseField {

  protected function controlMap(): array {
    return [
      'anchore' => Fields\AnchoreControl::class,
      'submit' => Fields\SubmitControl::class,
    ];
  }

}