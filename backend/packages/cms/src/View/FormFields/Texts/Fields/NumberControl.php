<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Texts\Fields;

use User\LaravelCms\View\FormFields\Texts\BaseTextsField;

class NumberControl extends BaseTextsField {

  protected int|float|null $value;
  protected int|float $step;
  protected int|float $max;
  protected int|float $min;
  protected bool $allow_float;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'];
    $this->step = $data['step'] ?? 1;
    $this->max = $data['max'] ?? 1000000000;
    $this->min = $data['min'] ?? -1000000000;
    $this->allow_float = $data['allow_float'] ?? true;
  }

  protected function resolveView(): string {
    return 'components/cms_fields/Texts/Number';
  }

}