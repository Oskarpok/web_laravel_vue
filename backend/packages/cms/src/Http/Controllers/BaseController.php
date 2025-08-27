<?php

declare(strict_types=1);

namespace User\LaravelCms\Http\Controllers;

use Illuminate\Routing\Controller;
use User\LaravelCms\Traits\DefaultController;


/**
 * Basic controller providing common logic for CMS controllers
 * Allows child controllers to define a model class and automatically
 * handle basic CRUD operations
 */
abstract class BaseController extends Controller {
  
  use DefaultController;

}