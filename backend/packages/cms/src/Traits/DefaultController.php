<?php

declare(strict_types=1);

namespace User\LaravelCms\Traits;

use Illuminate\Http\Request;

trait DefaultController {

  protected const CRUD_VIEWS = 'cms::components.crud_views.';

  /**
   * The fully qualified class name of the model associated with the controller
   * This must be set in the child controller
   * 
   * @var string
   */
  protected const MODEL_CLASS = '';

  /**
   * Route name for operations must be overridden in child controllers
   */
  protected const ROUTE_NAME = '';

  /**
   * Module name for operations must be overridden in child controllers
   */
  protected const MODULE_NAME = '';

  /**
   * Return an array of form fields used in the create show edit views
   *
   * @return array List of fields elements for the given controller
   */
  abstract protected function prepareFormFieldsForCrud(): array;

  /**
   * Return an array of form fields used in the create show edit views
   *
   * @return array List of fields elements for the given controller
   */
  abstract protected function indexPrepare(Request $request): array;

  /**
   * Return an array of title for each views
   */
  abstract protected function titles(): array;

  /**
   * Returns an instance of the model defined in the child controller
   *
   * @return \Illuminate\Database\Eloquent\Model
   */
  protected function getModelInstance(): \Illuminate\Database\Eloquent\Model {
    return app(static::MODEL_CLASS);
  }

  /**
   * 
   */
  public function index(Request $request) {
    $data = $this->indexPrepare($request);
    return view(static::CRUD_VIEWS . 'index',[
      'data' => $data,
      'title' => $this->titles()['index'] ?? '',
    ]);
  }

}