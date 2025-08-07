<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields;

abstract class BaseControl {

  protected string $type;
  protected string $view;

  public function __construct(array $data) {
    $this->type = $data['type']; 
    $this->view = $this->resolveView();
  }

  abstract protected function resolveView(): string;

  public function getType() {
    return $this->type;
  }

}