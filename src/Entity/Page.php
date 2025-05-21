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

namespace MonsieurBiz\SyliusCmsPagePlugin\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Webmozart\Assert\Assert;

class Page implements PageInterface
{
    use TimestampableTrait;
    use ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;

        getTranslation as private doGetTranslation;
    }

    protected ?int $id = null;

    protected ?string $code = null;

    /**
     * @var Collection<int, ChannelInterface>
     */
    protected Collection $channels;

    protected ?DateTimeInterface $publishAt = null;

    protected ?DateTimeInterface $unpublishAt = null;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->initializeChannelsCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return Collection<int, ChannelInterface>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        $this->channels->add($channel);
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        $this->channels->removeElement($channel);
    }

    public function initializeChannelsCollection(): void
    {
        $this->channels = new ArrayCollection();
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    public function getPublishAt(): ?DateTimeInterface
    {
        return $this->publishAt;
    }

    public function setPublishAt(?DateTimeInterface $publishAt): void
    {
        $this->publishAt = $publishAt;
    }

    public function getUnpublishAt(): ?DateTimeInterface
    {
        return $this->unpublishAt;
    }

    public function setUnpublishAt(?DateTimeInterface $unpublishAt): void
    {
        $this->unpublishAt = $unpublishAt;
    }

    public function isPublished(DateTimeInterface $dateTime): bool
    {
        return (null == $this->publishAt || $this->publishAt <= $dateTime)
            && (null === $this->unpublishAt || $this->unpublishAt > $dateTime);
    }

    public function getTitle(): ?string
    {
        return $this->getTranslation()->getTitle();
    }

    public function setTitle(?string $title): void
    {
        $this->getTranslation()->setTitle($title);
    }

    public function getContent(): ?string
    {
        return $this->getTranslation()->getContent();
    }

    public function setContent(?string $content): void
    {
        $this->getTranslation()->setContent($content);
    }

    public function getMetaTitle(): ?string
    {
        return $this->getTranslation()->getMetaTitle();
    }

    public function setMetaTitle(?string $metaTitle): void
    {
        $this->getTranslation()->setMetaTitle($metaTitle);
    }

    public function getMetaDescription(): ?string
    {
        return $this->getTranslation()->getMetaDescription();
    }

    public function setMetaDescription(?string $metaDescription): void
    {
        $this->getTranslation()->setMetaDescription($metaDescription);
    }

    public function getMetaKeywords(): ?string
    {
        return $this->getTranslation()->getMetaKeywords();
    }

    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->getTranslation()->setMetaKeywords($metaKeywords);
    }

    public function getMetaImage(): ?string
    {
        return $this->getTranslation()->getMetaImage();
    }

    public function setMetaImage(?string $metaImage): void
    {
        $this->getTranslation()->setMetaImage($metaImage);
    }

    public function getSlug(): ?string
    {
        return $this->getTranslation()->getSlug();
    }

    public function setSlug(?string $slug): void
    {
        $this->getTranslation()->setSlug($slug);
    }

    /**
     * @inheritdoc
     */
    protected function createTranslation(): PageTranslation
    {
        return new PageTranslation();
    }

    /**
     * @return PageTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        $translation = $this->doGetTranslation($locale);
        Assert::isInstanceOf($translation, PageTranslationInterface::class);

        return $translation;
    }
}
