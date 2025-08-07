<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Extra;

use User\LaravelCms\View\FormFields\BaseControl;

abstract class BaseExtraField extends BaseControl {

  public function __construct(array $data) {
    parent::__construct($data);
  }

}