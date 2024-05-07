## Plugin for automatic generation of meta tags

### 1. Add markup to your layout

**Example: layout/default.htm**
```html
[SeoCollector]
==
<!DOCTYPE html>
<html lang="ru">
    <head>
        {{ SeoCollector.getHeadBegin() | raw }}

        {% placeholder meta %}
            {% component 'SeoCollector' %}
        {% endplaceholder %}

        {{ SeoCollector.getHeadEnd() | raw }}
    </head>
    <body>
        {{ SeoCollector.getBodyBegin() | raw }}

        {% page %}

        {{ SeoCollector.getBodyEnd() | raw }}
    </body>
</html>
```
This is enough to correctly render meta tags for CMS pages and static pages.

### 2. Using meta page templates

You can use global meta templates for CMS pages.

To do this, you need to create them in the **Settings - Meta pages** section

After creating the template, you need to send the necessary data to it through the component:

**Example: page/post.htm**
```html
title = "Post page"
url = "/post/:slug"
layout = "default"
is_hidden = 0

[SeoCollector]
==
{% put meta %}
    {# The model and category variables will be available to you in the template #}
    {% component 'SeoCollector' model=post params={category: category} %}
{% endput %}

<h1>{{ SeoCollector.getTitle() | raw }}</h1>

<div>{{ post.content }}</div>
```
You can also pass additional parameters:

---

### 3. Use in your own plugins

**1. First, you need to add the necessary behavior to your model**

**Example: author/plugin/models/Post.php**
```php
class Post extends Model
{
    public $implement = [
        // Meta content of the this model
        \CatDesign\SeoCore\Classes\Behaviors\MetaModel::class,
    ];
}
```
**MetaModel** - is used for all models. Adds a polymorphic meta relation.

**Example: author/plugin/models/Category.php**
```php
class Category extends Model
{
    public $implement = [
        // Meta content of the this model
        \CatDesign\SeoCore\Classes\Behaviors\MetaModel::class,

        // A meta template for related records, for example for posts of a category
        \CatDesign\SeoCore\Classes\Behaviors\MetaTemplateModel::class,
    ];
}
```

**MetaTemplateModel** - used to define templates of child models. For example, you can add a product category template so that all its products use this template.

This behavior will add the polymorphic relationship meta_template and the getMetaTemplateFromTree() method if your model has the parent_id property.

Method used only in trees to get the closest meta pattern up the tree:
```php
$metaTemplate = $yorModel->getMetaTemplateFromTree();
```
**2. Add fields to your controllers**

I have provided a special class for this **MetaFieldHelper.php**.

You need to expand the fields of the form.

**Example: author/plugin/classes/event/PostFieldHandler.php**
```php
Event::listen('backend.form.extendFields', function (Form $widget) {
    if (!$widget->getController() instanceof Author\Plugin\Controllers\Posts) {
        return;
    }

    if (!$widget->model instanceof Author\Plugin\Model\Post) {
        return;
    }

    $fields = MetaFieldHelper::makeMetaNestedForm($widget, [
        'label' => 'Post meta'
    ]);

    $widget->addTabFields($fields);
});
```

**Example: author/plugin/classes/event/CategoryFieldHandler.php**
```php
Event::listen('backend.form.extendFields', function (Form $widget) {
    if (!$widget->getController() instanceof Author\Plugin\Controllers\Categories) {
        return;
    }

    if (!$widget->model instanceof Author\Plugin\Model\Category) {
        return;
    }

    $categoryFields = MetaFieldHelper::makeMetaNestedForm($widget, [
        'label' => 'Category meta',
        'span'  => 'left',
        'tab'   => 'SEO'
    ]);

    $productTemplateFields = MetaFieldHelper::makeMetaTemplateNestedForm($widget,[
        'label' => 'Meta posts in this category',
        'span'  => 'right',
        'tab'   => 'SEO'
    ]);

    $fields = array_merge($categoryFields, $productTemplateFields);
    $widget->addTabFields($fields);
});
```

**Example: author/plugin/Plugin.php**

```php
/**
 * Boot
 *
 * @return void
 */
public function boot()
{
    Event::subscribe(PostFieldHandler::class);
    Event::subscribe(CategoryFieldHandler::class);
}
```

**3.  Usage on the page**

**Example: page/post.htm**
```html
title = "Post page"
url = "/post/:slug"
layout = "default"
is_hidden = 0

[SeoCollector]
==
{% put meta %}
    {% component 'SeoCollector'
        model=post
        meta=post.meta
        metaTemplate=category.getMetaTemplateFromTree()
    %}
{% endput %}

{# Method getMetaTemplateFromTree #}
<h1>{{ SeoCollector.getTitle() | raw }}</h1>

<div>{{ post.content }}</div>
```
You don't have to use MetaFieldHelper.php class and add fields yourself.

**Example: your fields.yaml**

```yaml
tabs:
    fields:
        # Form for MetaModel.php behavior
        meta@update:
            label: 'Meta data'
            span: left
            type: nestedform
            tab: 'SEO'
            form:
                fields:
                    h1_title:
                        label: h1_title
                        span: full
                        type: codeeditor
                        language: twig
                        size: small
                    meta_title:
                        label: meta_title
                        span: full
                        size: small
                        type: codeeditor
                        language: twig
                    meta_description:
                        label: meta_description
                        span: full
                        type: codeeditor
                        size: small
                        language: twig
                    meta_other:
                        label: meta_other
                        span: full
                        type: codeeditor
                        size: large
                        language: twig

        # Form for MetaTemplateModel.php behavior
        meta_template@update:
            label: 'Meta tempate data'
            span: right
            type: nestedform
            tab: 'SEO'
            form:
                fields:
                    h1_title:
                        label: h1_title
                        span: full
                        type: codeeditor
                        language: twig
                        size: small
                    meta_title:
                        label: meta_title
                        span: full
                        size: small
                        type: codeeditor
                        language: twig
                    meta_description:
                        label: meta_description
                        span: full
                        type: codeeditor
                        size: small
                        language: twig
                    meta_other:
                        label: meta_other
                        span: full
                        type: codeeditor
                        size: large
                        language: twig
```
The most important thing is that it is a nested form.
