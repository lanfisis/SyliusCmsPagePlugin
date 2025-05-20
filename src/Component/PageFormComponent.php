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

namespace MonsieurBiz\SyliusCmsPagePlugin\Component;

use Sylius\Bundle\UiBundle\Twig\Component\ResourceFormComponent;
use Sylius\Component\Product\Generator\SlugGeneratorInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;

#[AsLiveComponent]
class PageFormComponent extends ResourceFormComponent
{
    #[LiveAction]
    public function generatePageSlug(SlugGeneratorInterface $slugGenerator, #[LiveArg] string $localeCode): void
    {
        $this->formValues['translations'][$localeCode]['slug'] = $slugGenerator->generate($this->formValues['translations'][$localeCode]['title']);
    }
}
