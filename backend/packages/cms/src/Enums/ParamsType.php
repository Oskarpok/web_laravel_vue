<?php

declare(strict_types=1);

namespace User\LaravelCms\Enums;

enum ParamsType: int {
  case Integer = 1;
  case Float = 2;
  case String = 3;
  case Boolean = 4;
  case Json = 5;
  
  public function label(): string {
    return match($this) {
      self::Unverified => 'Unverified',
      self::Integer => 'Integer',
      self::Float => 'Float',
      self::String => 'String',
      self::Boolean => 'Boolean',
      self::Json => 'Json',
    };
  }

  public static function toArray(): array {
    return collect(self::cases())
      ->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
  }

}