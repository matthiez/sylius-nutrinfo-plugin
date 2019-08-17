<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductVariant;

interface NutritionalInformationInterface
{
    public function getFiber(): ?float;

    public function setFiber(float $fiber): void;

    public function getId(): int;

    public function getKj(): ?float;

    public function setKj(float $energy): void;

    public function getSalt(): ?float;

    public function setSalt(float $salt): void;

    public function getSugar(): ?float;

    public function setSugar(float $sugar): void;

    public function getSaturated(): ?float;

    public function setSaturated(float $saturated): void;

    public function getCarbs(): ?float;

    public function setCarbs(float $carbs): void;

    public function getFats(): ?float;

    public function setFats(float $fats): void;

    public function getProtein(): ?float;

    public function setProtein(float $protein): void;

    public function getActive(): Collection;

    public function addActive(NutritionalInformationActiveIngredientEntry $active): void;

    public function removeActive($key): void;

    public function getProductVariants(): Collection;

    public function addProductVariant(ProductVariant $productVariant): void;

    public function removeProductVariant($key): void;
}
