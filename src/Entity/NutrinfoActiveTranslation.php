<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @Entity
 * @Table(name="ecolos_nutrinfo_active_ingredients_translation")
 */
class NutrinfoActiveTranslation extends AbstractTranslation implements ResourceInterface
{
    /**
     * @Column(type="integer")
     * @Id()
     * @GeneratedValue()
     * @var integer
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string|null
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
