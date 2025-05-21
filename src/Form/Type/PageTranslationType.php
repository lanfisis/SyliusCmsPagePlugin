<?php

/*
 * This file is part of Monsieur Biz' Cms Page plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusCmsPagePlugin\Form\Type;

use MonsieurBiz\SyliusMediaManagerPlugin\Form\Type\ImageType as MediaManagerImageType;
use MonsieurBiz\SyliusRichEditorPlugin\Form\Type\RichEditorType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PageTranslationType extends AbstractResourceType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'monsieurbiz_cms_page.ui.form.title',
            ])
            ->add('slug', TextType::class, [
                'label' => 'monsieurbiz_cms_page.ui.form.slug',
            ])
            ->add('content', RichEditorType::class, [
                'label' => 'monsieurbiz_cms_page.ui.form.content',
                'locale' => $builder->getName(),
            ])
            ->add('metaTitle', TextType::class, [
                'required' => false,
                'label' => 'monsieurbiz_cms_page.ui.form.meta_title',
            ])
            ->add('metaDescription', TextType::class, [
                'required' => false,
                'label' => 'monsieurbiz_cms_page.ui.form.meta_description',
            ])
            ->add('metaKeywords', TextType::class, [
                'required' => false,
                'label' => 'monsieurbiz_cms_page.ui.form.meta_keywords',
            ])
            ->add('metaImage', MediaManagerImageType::class, [
                'label' => 'monsieurbiz_cms_page.ui.form.meta_image',
                'help' => 'monsieurbiz_cms_page.ui.form.meta_image_help',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'monsieurbiz_cms_page_translation';
    }
}
