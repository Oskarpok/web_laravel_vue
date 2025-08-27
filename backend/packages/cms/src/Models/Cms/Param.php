<?php

declare(strict_types=1);

namespace User\LaravelCms\Models\Cms;

use User\LaravelCms\Models\Base;
use User\LaravelCms\Enums\ParamsType;

class Param extends Base {
  
  protected $fillable = [
    'name', 'type', 'val_string', 'val_int', 'val_float', 'val_bool', 'val_json',
  ];

  public function getTypeLabelAttribute(): string {
    return ParamsType::tryFrom($this->type)?->name ?? ParamsType::String->name;
  }
 
  public static function validationRules(): array {
    return [
      'name' => ['required', 'string', 'max:255'],
      'type' => ['required', 'integer'],
      'val_string' => ['nullable'],
      'val_int' => ['nullable'],
      'val_float' => ['nullable'],
      'val_bool' => ['nullable'],
      'val_json' => ['nullable'],
    ];
  }

}