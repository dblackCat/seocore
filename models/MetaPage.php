<?php namespace CatDesign\SeoCore\Models;

use Carbon\Carbon;
use Model;
use Cms\Classes\Page;
use October\Rain\Database\Traits\Validation;

/**
 * SeoTemplate Model
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 *
 * @property int $id
 * @property string $name
 * @property string $page_id
 * @property string $h1_title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_head
 * @property boolean $is_meta_data
 * @property int $site_id
 * @property int $site_root_id
 * @property string $page_title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MetaPage extends Model
{
    /**
     * Use traits
     */
    use Validation;


    /**
     * @var string table name
     */
    public $table = 'catdesign_seocore_meta_pages';


    /**
     * @var array rules for validation
     */
    public $rules = [
        'name'    => 'required',
        'page_id' => 'required'
    ];


    /**
     * Get page option list
     *
     * @return array
     */
    public function getPageOptionList()
    {
        $usedPageList = self::query()->whereNot('page_id', $this->page_id)->pluck('page_id');

        return Page::all()->whereNotIn('id', $usedPageList)->lists('title', 'id');
    }


    /**
     * Before save event
     *
     * @return void
     */
    public function beforeSave()
    {
        if (!$this->page_id) {
            return;
        }

        $selectedPage = Page::all()->whereIn('id', [$this->page_id])->first();
        $this->page_title = $selectedPage->title;
    }


    /**
     * Scope for page
     *
     * @param $query
     * @param $pageId
     * @return mixed
     */
    public function scopeForCmsPage($query, $pageId)
    {
        return $query->where('page_id', $pageId);
    }
}
