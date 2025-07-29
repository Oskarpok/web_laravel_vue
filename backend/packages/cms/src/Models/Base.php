<?php

declare(strict_types=1);

namespace User\LaravelCms\Models;

use Illuminate\Http\Request;
use User\LaravelCms\Traits\DefaultModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract base model providing common logic for CMS models.
 */
abstract class Base extends Model {

  use DefaultModel;

}
