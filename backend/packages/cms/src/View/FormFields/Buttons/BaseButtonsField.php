<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Buttons;

use User\LaravelCms\View\FormFields\BaseControl;

abstract class BaseButtonsField extends BaseControl {

  protected string $name;
  protected string $label;
  protected string $icone;
  protected string $wraper;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->name = $data['name'] ?? '';
    $this->label = $data['label'] ?? '';
    $this->icone = $data['icone'] ?? '';
    $this->wraper = $data['wraper'] ?? '';
  }

}