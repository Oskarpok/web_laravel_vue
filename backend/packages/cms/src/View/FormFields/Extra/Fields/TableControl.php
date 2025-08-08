<?php

declare(strict_types=1);

namespace User\LaravelCms\View\FormFields\Extra\Fields;

use Illuminate\Database\Eloquent\Collection;
use User\LaravelCms\View\FormFields\Extra\BaseExtraField;

class TableControl extends BaseExtraField {

  protected array $labels;
  protected Collection|array $data;
  protected array $filterable;

  public function __construct(array $data) {
    parent::__construct($data);
    $this->labels = $data['labels'];
    $this->data = $data['data'] instanceof Collection  
      ? $data['data']->toArray()
      : $data['data'];
    $this->filterable = $data['filterable'];
  }

  protected function resolveView(): string {
    return 'components/cms_fields/extra/Table';
  }

}