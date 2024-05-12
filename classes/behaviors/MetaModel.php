<?php namespace CatDesign\SeoCore\Classes\Behaviors;

use CatDesign\SeoCore\Models\MetaContent;
use October\Rain\Database\Model;
use October\Rain\Extension\ExtensionBase;


/**
 * Meta model behavior
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
class MetaModel extends ExtensionBase
{
    /**
     * @var Model $parent
     */
    public $model;


    /**
     * Construct
     *
     * @param $parent
     */
    public function __construct($parent)
    {
        $this->model = $parent;

        /**
         * @var Model $model
         */
        $this->model->morphOne['meta'] = [
            MetaContent::class,
            'name' => 'contentable',
        ];
    }
}
