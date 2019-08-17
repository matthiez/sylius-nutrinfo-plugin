<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\ManyToOne;

trait NutrinfoTrait
{
    /**
     * @ManyToOne(targetEntity="Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo", inversedBy="products" ,cascade={"persist"})
     */
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
