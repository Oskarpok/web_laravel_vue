<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Select\Fields;

use User\LaravelCms\View\FormFields\Select\BaseSelectField;

class SelectControl extends BaseSelectField {

  protected string|int $value;
  protected array $options;
  protected bool $searchable;
  protected bool $multiple;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = $data['value'] ?? '';
    $this->multiple = $data['multiple'] ?? true;
    $this->searchable = $data['searchable'] ?? false;
    $this->options = is_array($data['options'] ?? []) ? $data['options'] : [];
  }

  protected function resolveView(): string {
    return 'select/Select.vue';
  }

}