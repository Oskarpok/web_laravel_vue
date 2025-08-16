<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Select\Fields;

use User\LaravelCms\View\FormFields\Select\BaseSelectField;

class CheckBoxControl extends BaseSelectField {

  protected bool $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = (bool) $data['value'] ?? false;
  }

  protected function resolveView(): string {
    return 'select/CheckBox.vue';
  }

}