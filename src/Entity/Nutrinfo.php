<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use InvalidArgumentException;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Core\Model\Product;
use Burgov\Bundle\KeyValueFormBundle\KeyValueContainer;
use Traversable;
use Sylius\Component\Core\Model\ProductVariant;

/**
 * @Entity
 * @Table(name="ecolos_nutrinfo")
 */
class Nutrinfo implements ResourceInterface
{
    use NutrientsTrait;

    /**
     * @Column(type="array", nullable=true)
     * @var Collection|NutrinfoActive[]
     */
    protected $active_ingredients;

    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue()
     * @var int
     */
    protected $id;

    /**
     * @OneToMany(targetEntity="App\Entity\Product", mappedBy="nutrinfo")
     */
    private $products;

    /**
     * @OneToMany(targetEntity="App\Entity\ProductVariant", mappedBy="nutrinfo")
     */
    private $variants;

    /**
     * @Column(type="integer", nullable=true)
     * @var integer
     */
    protected $base;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    protected $base_unit;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->variants = new ArrayCollection();
        $this->active_ingredients = new ArrayCollection();
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(?int $base)
    {
        $this->base = $base;
    }

    public function getBaseUnit(): ?string
    {
        return $this->base_unit;
    }

    public function setBaseUnit(?string $baseUnit)
    {
        $this->base_unit = $baseUnit;
    }

    /**
     * @return Collection|NutrinfoActive[]
     */
    public function getActiveIngredients()
    {
        return $this->active_ingredients;
    }

    /**
     * Set the options (KeyValueFormBundle depends on this).
     * @param array|KeyValueContainer|Traversable $activeIngredients Something that can be converted to an array.
     * @return Nutrinfo
     */
    public function setActiveIngredients($activeIngredients): self
    {
        $this->active_ingredients = $this->convertToArray($activeIngredients);

        return $this;
    }

    public function addActiveIngredient(NutrinfoActive $activeIngredient): self
    {
        $filtered = array_filter($this->active_ingredients->toArray(), function (NutrinfoActive $_activeIngredient) use ($activeIngredient) {
            return $_activeIngredient->getId() == $activeIngredient->getId();
        });

        if (0 == count($filtered)) {
            $this->active_ingredients[] = $activeIngredient;
        }

        return $this;
    }

    public function removeActiveIngredient(NutrinfoActive $nutrinfoActive): self
    {
        $this->active_ingredients = array_filter($this->active_ingredients->toArray(), function (NutrinfoActive $_nutrinfoActive) use ($nutrinfoActive) {
            return $_nutrinfoActive->getId() != $nutrinfoActive->getId();
        });

        return $this;
    }

    public function removeActiveIngredients(): self
    {
        $this->active_ingredients = [];

        return $this;
    }

    private function convertToArray($data)
    {
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof KeyValueContainer) {
            return $data->toArray();
        }

        if ($data instanceof Traversable) {
            return iterator_to_array($data);
        }

        throw new InvalidArgumentException(sprintf('Expected array, Traversable or KeyValueContainer, got "%s"', is_object($data) ? get_class($data) : get_resource_type($data)));
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        $filtered = array_filter($this->products->toArray(), function (Product $_product) use ($product) {
            return $_product->getId() == $product->getId();
        });

        if (0 == count($filtered)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products = array_filter($this->products->toArray(), function (Product $_product) use ($product) {
            return $_product->getId() != $product->getId();
        });

        return $this;
    }

    public function removeProducts(): self
    {
        $this->products = [];

        return $this;
    }

    /**
     * @return Collection|ProductVariant[]
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(ProductVariant $variant): self
    {
        $filtered = array_filter($this->variants->toArray(), function (ProductVariant $_variant) use ($variant) {
            return $_variant->getId() == $variant->getId();
        });

        if (0 == count($filtered)) {
            $this->variants[] = $variant;
        }

        return $this;
    }

    public function removeVariant(ProductVariant $variant): self
    {
        $this->variants = array_filter($this->variants->toArray(), function (ProductVariant $_variant) use ($variant) {
            return $_variant->getId() != $variant->getId();
        });

        return $this;
    }

    public function removeVariants(): self
    {
        $this->variants = [];

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return "ecolos_sylius_nutrinfo_plugin_nutrinfo";
    }
}
