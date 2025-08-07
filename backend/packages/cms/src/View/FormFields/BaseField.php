<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields;

abstract class BaseField {

  protected $resolved;

  public function __construct(array $data) {
    $this->resolved = $this->resolveField($data);
  }

  abstract protected function controlMap(): array;

  protected function resolveField(array $data) {
    return new ($this->controlMap()[$data['type']])($data);
  }

  public function getType(): string {
    return $this->resolved->getType();
  }

}