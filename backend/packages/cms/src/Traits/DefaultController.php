<?php

declare(strict_types=1);

namespace User\LaravelCms\Traits;

use Inertia\Inertia;
use Illuminate\Http\Request;
use User\LaravelCms\View\FormFields\Extra\ExtraTypeController;

trait DefaultController {
  
  /**
   * The fully qualified class name of the model associated with the controller
   * This must be set in the child controller
   * 
   * @var string
   */
  protected const MODEL_CLASS = null;

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
    return Inertia::render('components/crud_views/index', [
      'table' => (new ExtraTypeController([
        'type' => 'table',
        'labels' => $data['labels'],
        'filterable' => $data['filterable'],
        'data' => $data['data'],
      ])),
      'buttons' => $data['buttons'],
      'title' => $this->titles()['index'] ?? '',
    ]);
  }


  /**
   * Displays the form view for creating a new record
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return Inertia::render('components/crud_views/create', [
      'title' => $this->titles()['create'] ?? '',
      'fields' => $this->prepareFormFieldsForCrud(),
    ]);
  }

  /**
   * Handles storing a new record
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request) {
    $this->callHook('beforeStore', $request);
    $model = $this->getModelInstance()->fill($request->all());

    if($model->save()) {
      $this->callHook('afterStore', $request, $model);
    }
    // if not seved 

  }

  /**
   * Displays the details of a single record
   *
   * @param  int  $id  The ID of the record to display
   * @return \Illuminate\Http\Response
   */
  public function show(int $id) {
    return Inertia::render('components/crud_views/show', [
      'title' => $this->titles()['show'] ?? '',
      'fields' => $this->prepareFormFieldsForCrud(
        $this->getModelInstance()->findOrFail($id)
      ),
    ]);
  }

  /**
   * Displays a form for editing an existing record
   *
   * @param  int  $id  The ID of the record to be edited
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id) {
    $record = $this->getModelInstance()->findOrFail($id);
    return Inertia::render('components/crud_views/edit', [
      'id' => $id,
      'title' => $this->titles()['edit'] ?? '',
      'fields' => $this->prepareFormFieldsForCrud($record),
    ]);
  }

  /**
   * Updates an existing record identified by its ID.
   *
   * @param \Illuminate\Http\Request $request The request object containing data
   * @param int $id The ID of the record to update.
   * @return \Illuminate\Http\RedirectResponse Redirects back to the edit form
   */
  public function update(Request $request, int $id) {
    $this->callHook('beforeUpdate', $request);
    $model = $this->getModelInstance()->findOrFail($id)->fill($request->all());

    if($model->update()) {
      $this->callHook('afterUpdate', $request, $model);
    }
    // if not seved 

  }

  /**
   * Deletes a model record by ID
   *
   * @param  int  $id  The ID of the record to delete.
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(int $id) {
    $this->callHook('beforeDestroy', $id);
    $this->getModelInstance()->findOrFail($id)->delete();
    $this->callHook('afterDestroy', $id);
  }

  protected function callHook(string $hook, ...$params): void {
    if (method_exists($this, $hook)) {
      $this->$hook(...$params);
    }
  }

}