<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Texts\Fields;

use User\LaravelCms\View\FormFields\Texts\BaseTextsField;

class TextField extends BaseTextsField {

  protected string $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'] ?? '';
  }

  protected function resolveView(): string {
    return 'text/Text.vue';
  }

}