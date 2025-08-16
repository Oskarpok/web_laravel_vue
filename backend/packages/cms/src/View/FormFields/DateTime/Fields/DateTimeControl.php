<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\DateTime\Fields;

use User\LaravelCms\View\FormFields\DateTime\BaseDateTimeField;

class DateTimeControl extends BaseDateTimeField {

  protected ?string $value;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->value = is_object($data['value']) 
      ? $data['value']->format($data['format'] ?? 'Y-m-d\TH:i')
      : $data['value'];
  }

  protected function resolveView(): string {
    return 'date_time/DateTime.vue';
  }

}