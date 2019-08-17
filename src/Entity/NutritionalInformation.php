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
use Sylius\Component\Core\Model\ProductVariant;

/**
 * @Entity
 * @Table(name="ecolos_nutritional_information")
 */
class NutritionalInformation implements NutritionalInformationInterface
{
    /**
     * @OneToMany(targetEntity="Ecolos\SyliusNutritionalInformationPlugin\Entity\NutritionalInformationActiveIngredientEntry", mappedBy="nutritional_information")
     */
    public $active;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $carbs;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $fats;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $fiber;

    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $kj;

    /**
     * @OneToMany(targetEntity="App\Entity\ProductVariant", mappedBy="nutritional_information")
     */
    public $product_variants;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $protein;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $saturated;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $salt;

    /**
     * @Column(type="float")
     * @var float|null
     */
    public $sugar;

    public function __construct()
    {
        $this->active = new ArrayCollection();
        $this->product_variants = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "nutritional_information";
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFiber(): ?float
    {
        return $this->fiber;
    }

    public function setFiber(float $fiber): void
    {
        $this->fiber = $fiber;
    }

    public function getKj(): ?float
    {
        return $this->kj;
    }

    public function setKj(float $kj): void
    {
        $this->kj = $kj;
    }

    public function getSalt(): ?float
    {
        return $this->salt;
    }

    public function setSalt(float $salt): void
    {
        $this->salt = $salt;
    }

    public function getSugar(): ?float
    {
        return $this->sugar;
    }

    public function setSugar(float $sugar): void
    {
        $this->sugar = $sugar;
    }

    public function getSaturated(): ?float
    {
        return $this->saturated;
    }

    public function setSaturated(float $saturated): void
    {
        $this->saturated = $saturated;
    }

    public function getCarbs(): ?float
    {
        return $this->carbs;
    }

    public function setCarbs(float $carbs): void
    {
        $this->carbs = $carbs;
    }

    public function getFats(): ?float
    {
        return $this->fats;
    }

    public function setFats(float $fats): void
    {
        $this->fats = $fats;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): void
    {
        $this->protein = $protein;
    }

    /**
     * @return Collection|NutritionalInformationActiveIngredientEntry[]
     */
    public function getActive(): Collection
    {
        return $this->active;
    }

    public function addActive(NutritionalInformationActiveIngredientEntry $active): void
    {
        $this->active->add($active);
    }

    public function removeActive($key): void
    {
        $this->active->remove($key);
    }

    /**
     * @return Collection|ProductVariant[]
     */
    public function getProductVariants(): Collection
    {
        return $this->product_variants;
    }

    public function addProductVariant(ProductVariant $productVariant): void
    {
        $this->product_variants->add($productVariant);
    }

    public function removeProductVariant($key): void
    {
        $this->product_variants->remove($key);
    }
}
