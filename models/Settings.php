<?php namespace CatDesign\SeoCore\Models;

use System\Models\SettingModel;
use October\Rain\Database\Traits\Multisite;
use October\Rain\Database\Traits\Validation;


/**
 * Settings Model
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 *
 * @method static instance()
 * @method static get()
 *
 * @property string $title_prefix
 * @property string $title_suffix
 * @property string $head_begin_code
 * @property string $head_end_code
 * @property string $body_begin_code
 * @property string $body_end_code
 */
class Settings extends SettingModel
{
    /**
     * Use traits
     */
    use Validation;
    use Multisite;


    /**
     * Multisite sync
     *
     * @var bool
     */
    protected $propagatableSync = true;


    /**
     * Propagatable
     *
     * @var string[]
     */
    protected $propagatable = [
        'title_prefix',
        'title_suffix',
        'head_begin_code',
        'head_end_code',
        'body_begin_code',
        'body_end_code'
    ];


    /**
     * @var string Settings code
     */
    public $settingsCode = 'catdesign_seocore_settings';


    /**
     * @var string Settings field config
     */
    public $settingsFields = 'fields.yaml';


    /**
     * @var array rules for validation
     */
    public $rules = [];
}
