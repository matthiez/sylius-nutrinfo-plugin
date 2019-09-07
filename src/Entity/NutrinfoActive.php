<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * @Entity
 * @Table(name="ecolos_nutrinfo_active_ingredients")
 */
class NutrinfoActive implements ResourceInterface, TranslatableInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue()
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var null|string
     */
    protected $unit;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(?string $name): self
    {
        /** @var NutrinfoActiveTranslation $translation */
        $translation = $this->getTranslation();

        $translation->setName($name);

        return $this;
    }

    public function getName(): ?string
    {
        /** @var NutrinfoActiveTranslation $translation */
        $translation = $this->getTranslation();

        return $translation->getName();
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): NutrinfoActiveTranslation
    {
        return new NutrinfoActiveTranslation();
    }
}
