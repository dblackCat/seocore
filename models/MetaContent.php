<?php namespace CatDesign\SeoCore\Models;

use Model;
use Carbon\Carbon;
use October\Rain\Database\Traits\Validation;

/**
 * SeoTemplate Model
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 *
 * @property string $h1_title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_head
 * @property boolean $is_meta_data
 * @property boolean $is_template
 * @property int $contentable_id
 * @property string $contentable_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MetaContent extends Model
{
    /**
     * Use traits
     */
    use Validation;


    /**
     * Guarder columns
     *
     * @var string[]
     */
    protected $guarded = ['id'];


    /**
     * @var string table name
     */
    public $table = 'catdesign_seocore_meta_contents';


    /**
     * @var array rules for validation
     */
    public $rules = [];


    /**
     * Scope for item
     *
     * @param $query
     * @param $itemType
     * @param $itemId
     * @return mixed
     */
    public function scopeForItem($query, $itemType, $itemId)
    {
        return $query->where('contentable_type', $itemType)->where('contentable_id', $itemId);
    }


    /**
     * Morph to
     *
     * @var array[]
     */
    public $morphTo = [
        'contentable' => []
    ];
}
