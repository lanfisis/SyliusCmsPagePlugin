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

namespace MonsieurBiz\SyliusCmsPagePlugin\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItem(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        if (!$content = $menu->getChild('monsieurbiz-cms')) {
            $content = $menu
                ->addChild('monsieurbiz-cms')
                ->setLabel('monsieurbiz_cms_page.ui.cms_content')
                ->setLabelAttribute('icon', 'tabler:file')
                ->setExtra('always_open', true)
            ;
        }

        $content
            ->addChild('monsieurbiz-cms-page', ['route' => 'monsieurbiz_cms_page_admin_page_index', 'extras' => ['routes' => [
                'monsieurbiz_cms_page_admin_page_create',
                'monsieurbiz_cms_page_admin_page_update',
            ]]])
            ->setLabel('monsieurbiz_cms_page.ui.pages')
            ->setLabelAttribute('icon', 'tabler:file')
        ;
    }
}
