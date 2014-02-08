<?php namespace TypiCMS\Models;

use Illuminate\Database\Eloquent\Collection;

use Dimsav\Translatable\Translatable;

use TypiCMS\NestedCollection;

class Category extends Translatable {

	protected $fillable = array(
		'position',
		// Translatable fields
		'title',
		'slug',
		'status',
	);
	

	/**
	 * Translatable model configs.
	 *
	 * @var array
	 */
	public $translatedAttributes = array(
		'title',
		'slug',
		'status',
	);


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	public $view = 'categories';
	public $route = 'categories';


	/**
	 * lists
	 */
	public $order = 'position';
	public $direction = 'asc';


	/**
	 * Relations
	 */
	public function projects()
	{
		return $this->hasMany('TypiCMS\Models\Project');
	}


	/**
	 * Custom collection
	 *
	 * @return InvoiceCollection object
	 */
	public function newCollection(array $models = array())
	{
		return new NestedCollection($models);
	}

}