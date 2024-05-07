<?php namespace CatDesign\SeoCore\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Migration
 *
 * @author Semen Kuznetsov (dblackCat)
 * @url https://cat-design.ru
 */
return new class extends Migration
{
    /**
     * Target table
     *
     * @var string
     */
    const TABLE = 'catdesign_seocore_meta_pages';


    /**
     * up builds the migration
     */
    public function up()
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('page_id');
            $table->string('page_title')->nullable();
            $table->text('h1_title')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_other')->nullable();
            $table->timestamps();
        });
    }


    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
};
