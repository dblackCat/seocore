<?php namespace CatDesign\SeoCore\Classes;

use Model;
use Backend\Widgets\Form;


class MetaFieldHelper
{
    /**
     * Make meta fields
     *
     * @param Form $widget
     * @param array $params
     * @return array
     */
    public static function makeMetaNestedForm(Form $widget, array $params = [])
    {
        $formName = 'meta@update';
        $form     = self::makeNestedForm($formName, $params);

        $fields = [
            'meta_section' => [
                'label' => $params['label'] ?? 'Meta data',
                'type' => 'section',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_section.comment'
            ],
            'h1_title' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.h1_title.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'size'  => 'small',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.h1_title.comment',
                'span'  => 'full',
            ],
            'meta_title' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_title.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'size'  => 'small',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_title.comment',
                'span'  => 'full',
            ],
            'meta_description' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_description.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'size'  => 'small',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_description.comment',
                'span'  => 'full',
            ],
            'meta_other' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_other.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_other.comment',
                'size'  => 'large',
                'span'  => 'full',
            ],
            'contentable_id' => [
                'cssClass' => 'd-none',
                'readOnly' => true,
                'value' => $widget->model->id,
            ],
            'contentable_type' => [
                'cssClass' => 'd-none',
                'readOnly' => true,
                'value' => get_class($widget->model),
            ]
        ];

        $form[$formName]['form']['fields'] = array_merge($form[$formName]['form']['fields'], $fields);

        return $form;
    }


    /**
     * Make meta fields
     *
     * @param Form $widget
     * @param array $params
     * @return array
     */
    public static function makeMetaTemplateNestedForm(Form $widget, array $params = [])
    {
        $formName = 'meta_template@update';
        $form     = self::makeNestedForm($formName, $params);

        $fields = [
            'meta_section' => [
                'label' => $params['label'] ?? 'Meta template',
                'type' => 'section',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_section.comment'
            ],
            'h1_title' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.h1_title.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'size'  => 'small',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.h1_title.comment',
                'span'  => 'full',
            ],
            'meta_title' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_title.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'size'  => 'small',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_title.comment',
                'span'  => 'full',
            ],
            'meta_description' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_description.label',
                'type'  => 'codeeditor',
                'size'  => 'small',
                'language' => 'twig',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_description.comment',
                'span'  => 'full',
            ],
            'meta_other' => [
                'label' => 'catdesign.seocore::lang.models.meta_page.fields.meta_other.label',
                'type'  => 'codeeditor',
                'language' => 'twig',
                'comment' => 'catdesign.seocore::lang.models.meta_page.fields.meta_other.comment',
                'size'  => 'large',
                'span'  => 'full',
            ],
            'templateable_id' => [
                'cssClass' => 'd-none',
                'readOnly' => true,
                'value' => $widget->model->id,
            ],
            'templateable_type' => [
                'cssClass' => 'd-none',
                'readOnly' => true,
                'value' => get_class($widget->model),
            ]
        ];

        $form[$formName]['form']['fields'] = array_merge($form[$formName]['form']['fields'], $fields);

        return $form;
    }


    /**
     * Make nested form
     *
     * @param string $name
     * @param array $params
     * @return array
     */
    protected static function makeNestedForm(string $name, array $params = [])
    {
        $form[$name] = [
            'type' => 'nestedform',
            'span' => $params['span'] ?? 'full',
            'tab'  => $params['tab'] ?? 'SEO',
            'form' => [
                'fields' => []
            ]
        ];

        return $form;
    }
}
