<?php

declare(strict_types=1);

namespace User\LaravelCms\Enums;

enum ParamsType: int {
  case Unverified = 0;
  case Integer = 1;
  case Float = 2;
  case String = 3;
  case Boolean = 4;
  case Object = 5;
  case Json = 6;
  
  public function label(): string {
    return match($this) {
      self::Unverified => 'Unverified',
      self::Integer => 'Integer',
      self::Float => 'Float',
      self::String => 'String',
      self::Boolean => 'Boolean',
      self::Object => 'Object',
      self::Json => 'Json',
    };
  }

  public static function toArray(): array {
    return collect(self::cases())
      ->mapWithKeys(fn($case) => [$case->value => $case->label()])->toArray();
  }

}