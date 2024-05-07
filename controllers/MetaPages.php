<?php namespace CatDesign\SeoCore\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use System\Classes\SettingsManager;

/**
 * Seo Templates Backend Controller
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
class MetaPages extends Controller
{
    /**
     * Implement behaviors
     *
     * @var string[]
     */
    public $implement = [
        FormController::class,
        ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';


    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';


    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['catdesign.seocore.meta_pages'];


    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('CatDesign.SeoCore','catdesign_seocore_meta_pages');
    }
}
