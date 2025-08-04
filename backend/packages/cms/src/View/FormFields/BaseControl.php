<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields;

abstract class BaseControl {

  protected string $type;
  protected string $name;
  protected string $label;
  protected string $wraper;
  protected bool $readonly;
  protected bool $required;
  protected string $tooltip;

  public function __construct(array $data) {
    $this->type = $data['type']; 
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->wraper = $data['wraper'] ?? 'flex flex-col w-full md:w-[32%]';
    $this->readonly = $data['readonly'] ?? false;
    $this->required = $data['required'] ?? false;
    $this->tooltip = $data['tooltip'] ?? '';
  }

  abstract protected function resolveView(): string;

  public function getType() {
    return $this->type;
  }

}