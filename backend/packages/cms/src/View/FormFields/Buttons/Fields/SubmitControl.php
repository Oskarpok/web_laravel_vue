<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Buttons\Fields;

use User\LaravelCms\View\FormFields\Buttons\BaseButtonsField;

class SubmitControl extends BaseButtonsField {

  public function __construct(array $data) {
    parent::__construct($data);
  }

  protected function resolveView(): string {
    return 'button/Submit.vue';
  }

}