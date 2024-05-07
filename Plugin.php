<?php namespace CatDesign\SeoCore;

use Backend;
use System\Classes\PluginBase;
use CatDesign\SeoCore\Models\Settings;
use CatDesign\SeoCore\Components\SeoCollector;


/**
 * Plugin Information File
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
class Plugin extends PluginBase
{
    /**
     * PluginDetails about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'catdesign.seocore::lang.plugin.name',
            'description' => 'catdesign.seocore::lang.plugin.description',
            'author'      => 'CatDesign',
            'icon'        => 'icon-line-chart'
        ];
    }


    /**
     * RegisterComponents used by the frontend.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            SeoCollector::class => 'SeoCollector',
        ];
    }


    /**
     * RegisterPermissions used by the backend.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'catdesign.seocore.settings' => [
                'tab'   => 'catdesign.seocore::lang.plugin.name',
                'label' => 'catdesign.seocore::lang.permissions.settings'
            ],
            'catdesign.seocore.meta_pages' => [
                'tab'   => 'catdesign.seocore::lang.plugin.name',
                'label' => 'catdesign.seocore::lang.permissions.meta_pages'
            ],
        ];
    }


    /**
     * Register settings
     *
     * @return array
     */
    public function registerSettings() : array
    {
        return [
            'catdesign_seocore_settings' => [
                'label'       => 'catdesign.seocore::lang.models.settings.label',
                'description' => 'catdesign.seocore::lang.models.settings.description',
                'category'    => 'system::lang.system.categories.cms',
                'icon'        => 'icon-line-chart',
                'class'       => Settings::class,
                'order'       => 500,
                'keywords'    => 'catdesign.seocore::lang.models.settings.search_keywords',
                'permissions' => ['catdesign.seocore.settings']
            ],
            'catdesign_seocore_meta_pages' => [
                'label'       => 'catdesign.seocore::lang.models.meta_page.label',
                'description' => 'catdesign.seocore::lang.models.meta_page.description',
                'category'    => 'system::lang.system.categories.cms',
                'icon'        => 'icon-file-text-o',
                'url'         => Backend::url('catdesign/seocore/metapages'),
                'order'       => 500,
                'keywords'    => 'catdesign.seocore::lang.models.meta_page.search_keywords',
                'permissions' => ['catdesign.seocore.templates']
            ]
        ];
    }
}
