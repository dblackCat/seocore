<?php namespace CatDesign\SeoCore\Components;

use Twig;
use Model;
use Exception;
use Cms\Classes\ComponentBase;
use CatDesign\SeoCore\Models\Settings;
use CatDesign\SeoCore\Models\MetaPage;
use CatDesign\SeoCore\Models\MetaContent;
use CatDesign\SeoCore\Models\MetaTemplate;


/**
 * SeoCollector Component
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
class SeoCollector extends ComponentBase
{
    /**
     * Model
     *
     * @var Model
     */
    private $model;


    /**
     * Meta
     *
     * @var MetaContent
     */
    public $meta;


    /**
     * Meta template
     *
     * @var MetaTemplate
     */
    public $metaTemplate;


    /**
     * Data list
     *
     * @var array
     */
    private $params;


    /**
     * Component details
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'catdesign.seocore::lang.components.seo_collector.name',
            'description' => 'catdesign.seocore::lang.components.seo_collector.description'
        ];
    }


    /**
     * OnRender
     *
     * @return void
     */
    public function onRender()
    {
        $this->loadData();
    }


    /**
     * Load data
     *
     * @return void
     */
    private function loadData()
    {
        $this->model           = $this->property('model');
        $this->params          = $this->property('params');
        $this->meta            = (object) $this->property('meta');
        $this->metaTemplate    = (object) $this->property('metaTemplate');

        if (!$this->meta and !$this->metaTemplate) {
            $this->meta = MetaPage::query()->forCmsPage($this->page->id)->first();
        }

        $this->params['model'] = $this->model;
    }



    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->renderProperty('h1_title', $this->page->title);
    }


    /**
     * Get meta title
     *
     * @return string
     */
    public function getMetaTitle()
    {
        $title = $this->renderProperty('meta_title', $this->page->meta_title);

        $prefix = Settings::get('title_prefix');
        $suffix = Settings::get('title_suffix');

        if ($prefix) {
            $title = $prefix . ' ' . $title;
        }

        if ($suffix) {
            $title .= ' '. $suffix;
        }

        return $title;
    }


    /**
     * Get meta description
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->renderProperty('meta_description', $this->page->meta_description);
    }



    /**
     * Get meta
     *
     * @return string
     */
    public function getMetaOther()
    {
        return $this->renderProperty('meta_other');
    }


    /**
     * Render property
     *
     * @param $propertyKey
     * @param $propertyDefault
     * @return string
     */
    private function renderProperty($propertyKey, $propertyDefault = '')
    {
        try {
            $propertyValue = '';

            if (isset($this->meta->{$propertyKey})) {
                $propertyValue = $this->meta->{$propertyKey};
            }

            if (!$propertyValue and isset($this->metaTemplate->{$propertyKey})) {
                $propertyValue = $this->metaTemplate->{$propertyKey};
            }

            if (!$propertyValue) {
                $propertyValue = $propertyDefault;
            }

            return $this->twigRender($propertyValue);
        } catch (Exception $exception) {
            trace_log($exception);
        }
    }


    /**
     * Render twig template
     *
     * @param $content
     * @param $data
     * @return string
     */
    public function twigRender($content, $data = null)
    {
        try {
            if (!$content) {
                return '';
            }

            if (!$data) {
                $data = $this->params;
            }

            if (!is_array($data)) {
                $data = [];
            }

            $data['model'] = $this->model;
            return Twig::parse($content, $data);
        } catch (Exception $exception) {
            trace_log($exception);
        }
    }


    /**
     * Get head begin
     *
     * @return string
     */
    public function getHeadBegin()
    {
        return Settings::get('head_begin_code');
    }


    /**
     * Get head end
     *
     * @return string
     */
    public function getHeadEnd()
    {
        return Settings::get('head_end_code');
    }


    /**
     * Get body begin
     *
     * @return string
     */
    public function getBodyBegin()
    {
        return Settings::get('body_begin_code');
    }


    /**
     * Get body end
     *
     * @return string
     */
    public function getBodyEnd()
    {
        return Settings::get('body_end_code');
    }
}
