<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="ecolos_nutritional_information_active_ingredients")
 */
class NutritionalInformationActiveIngredient
{
    /**
     * @OneToMany(targetEntity="Ecolos\SyliusNutritionalInformationPlugin\Entity\NutritionalInformationActiveIngredientEntry", mappedBy="ingredient")
     */
    public $entries;

    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    public $name;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    /**
     * @return Collection|NutritionalInformation[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(NutritionalInformationActiveIngredientEntry $entry): void
    {
        $this->entries->add($entry);
    }

    public function removeEntry($key): void
    {
        $this->entries->remove($key);
    }

    public function __toString(): string
    {
        return "nutritional_information_active_ingredient";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
