<?php
namespace TypiCMS\Modules\Places\Models;

use TypiCMS\Models\Base;

class Place extends Base
{

    use \Dimsav\Translatable\Translatable;
    use \TypiCMS\Presenters\PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Places\Presenters\PlacePresenter';

    protected $fillable = array(
        'title',
        'slug',
        'address',
        'email',
        'phone',
        'fax',
        'website',
        'image',
        'latitude',
        'longitude',
        // Translatable fields
        'info',
        'status',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array('info', 'status');

    /**
     * The default route for admin side.
     *
     * @var string
     */
    public $route = 'places';

    /**
     * lists
     */
    public $order = 'title';
    public $direction = 'asc';

    /**
     * Observers
     */
    public static function boot()
    {
        parent::boot();

        $self = __CLASS__;

        static::creating(function ($model) use ($self) {
            // slug = null si vide
            $slug = ($model->slug) ? $model->slug : null ;
            $model->slug = $slug;

            if ($slug) {
                $i = 0;
                // Check uri is unique
                while ($self::where('slug', $model->slug)->first()) {
                    $i++;
                    // increment slug if exists
                    $model->slug = $slug.'-'.$i;
                }
            }

        });

        static::updating(function ($model) use ($self) {
            // slug = null si vide
            $slug = ($model->slug) ? $model->slug : null ;
            $model->slug = $slug;

            if ($slug) {
                $i = 0;
                // Check uri is unique
                while ($self::where('slug', $model->slug)->where('id', '!=', $model->id)->first()) {
                    $i++;
                    // increment slug if exists
                    $model->slug = $slug.'-'.$i;
                }
            }

        });

    }
}
