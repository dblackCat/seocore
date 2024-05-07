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
 * @property boolean $meta_head
 * @property int $templateable_id
 * @property string $templateable_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MetaTemplate extends Model
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
    public $table = 'catdesign_seocore_meta_templates';


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
        return $query->where('templateable_type', $itemType)->where('templateable_id', $itemId);
    }


    /**
     * Morph to
     *
     * @var array[]
     */
    public $morphTo = [
        'templateable' => []
    ];
}
