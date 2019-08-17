<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="ecolos_nutritional_information_active_ingredients_entry")
 */
class NutritionalInformationActiveIngredientEntry
{
    /**
     * @ManyToOne(targetEntity="Ecolos\SyliusNutritionalInformationPlugin\Entity\NutritionalInformation", inversedBy="active", cascade={"persist"})
     */
    public $nutritional_information;

    public function getNutritionalInformation(): ?NutritionalInformation
    {
        return $this->nutritional_information;
    }

    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="NutritionalInformationActiveIngredient", inversedBy="entries", cascade={"persist"})
     * @var NutritionalInformationActiveIngredient
     */
    public $ingredient;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $value;

    public function __toString(): string
    {
        return "nutritional_information_active_ingredient_entry";
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getIngredient(): NutritionalInformationActiveIngredient
    {
        return $this->ingredient;
    }

    public function setIngredient(NutritionalInformationActiveIngredient $ingredient): void
    {
        $this->ingredient = $ingredient;
    }
}
