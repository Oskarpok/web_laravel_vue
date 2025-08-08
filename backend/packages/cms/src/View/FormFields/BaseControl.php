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

  public function serialize(): array {
    $data = [];
    
    foreach ((new \ReflectionClass($this))->getProperties() as $property) {
      $property->setAccessible(true);
      $data[$property->getName()] = $property->getValue($this);
    }

    return $data;
  }
  
  public function getType() {
    return $this->type;
  }

}