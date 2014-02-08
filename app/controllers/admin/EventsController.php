<?php namespace App\Controllers\Admin;

use TypiCMS\Repositories\Event\EventInterface;
use TypiCMS\Services\Form\Event\EventForm;
use View;
use Former;
use Input;
use Redirect;
use Request;

class EventsController extends BaseController {

	public function __construct(EventInterface $event, EventForm $eventform)
	{
		parent::__construct($event, $eventform);
		$this->title['parent'] = trans_choice('modules.events.events', 2);
	}

	/**
	 * List models
	 * GET /admin/model
	 */
	public function index()
	{
		$models = $this->repository->getAll(true)->buildList($this->repository->getListProperties());
		$this->title['h1'] = '<span id="nb_elements">'.$models->getTotal().'</span> '.trans_choice('modules.events.events', $models->getTotal());
		$this->layout->content = View::make('admin.events.index')->withModels($models);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->title['child'] = trans('modules.events.New');
		$model = $this->repository->getModel();
		$this->layout->content = View::make('admin.events.create')
			->with('model', $model);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($model)
	{

		$this->title['child'] = trans('modules.events.Edit');
		Former::populate($model);
		$this->layout->content = View::make('admin.events.edit')
			->with('model', $model);
	}


	/**
	 * Show resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($model)
	{
		return Redirect::route('admin.events.edit', $model->id);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if ( $model = $this->form->save( Input::all() ) ) {
			return (Input::get('exit')) ? Redirect::route('admin.events.index') : Redirect::route('admin.events.edit', $model->id) ;
		}

		return Redirect::route('admin.events.create')
			->withInput()
			->withErrors($this->form->errors());

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($model)
	{

		Request::ajax() and exit($this->repository->update( Input::all() ));

		if ( $this->form->update( Input::all() ) ) {
			return (Input::get('exit')) ? Redirect::route('admin.events.index') : Redirect::route('admin.events.edit', $model->id) ;
		}
		
		return Redirect::route( 'admin.events.edit', $model->id )
			->withInput()
			->withErrors($this->form->errors());

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sort()
	{
		$sort = $this->repository->sort( Input::all() );
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($model)
	{
		if( $model->delete() ) {
			if ( ! Request::ajax()) {
				return Redirect::back();
			}
		}
	}


}