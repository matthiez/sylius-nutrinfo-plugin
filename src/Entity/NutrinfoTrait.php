<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

trait NutrinfoTrait
{
    public $nutrinfo;

    public function getNutrinfo(): ?Nutrinfo
    {
        return $this->nutrinfo;
    }

    public function setNutrinfo(?Nutrinfo $nutrinfo): self
    {
        $this->nutrinfo = $nutrinfo;

        return $this;
    }
}
