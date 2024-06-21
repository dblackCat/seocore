<?php namespace CatDesign\SeoCore\Classes\Behaviors;

use CatDesign\SeoCore\Models\MetaTemplate;
use October\Rain\Database\Model;
use October\Rain\Extension\ExtensionBase;

/**
 * Meta template model behavior
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
class MetaTemplateModel extends ExtensionBase
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

        $this->model->morphOne['meta_template'] = [
            MetaTemplate::class,
            'name' => 'templateable',
        ];
    }


    /**
     * Get meta template from tree
     *
     * @return mixed|null
     */
    function getMetaTemplateFromTree()
    {
        return $this->getMetaTemplateRecursive($this->model);
    }


    /**
     * Get meta template from tree
     *
     * @param $model
     * @return mixed|null
     */
    private function getMetaTemplateRecursive($model)
    {
        if (isset($model->meta_template->h1_title) and $model->meta_template->h1_title) {
            return $model->meta_template;
        }

        if (isset($model->meta_template->meta_title) and $model->meta_template->meta_title) {
            return $model->meta_template;
        }

        if (isset($model->meta_template->meta_description) and $model->meta_template->meta_description) {
            return $model->meta_template;
        }

        if (!isset($model->parent->id)) {
            return null;
        }

        return $this->getMetaTemplateRecursive($model->parent);
    }
}
