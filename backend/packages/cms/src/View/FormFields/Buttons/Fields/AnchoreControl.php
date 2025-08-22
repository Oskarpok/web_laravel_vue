<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Buttons\Fields;

use User\LaravelCms\View\FormFields\Buttons\BaseButtonsField;

class AnchoreControl extends BaseButtonsField {

  protected string $route;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->route = $data['route'] ?? '';
  }

  protected function resolveView(): string {
    return 'button/Anchore.vue';
  }

}