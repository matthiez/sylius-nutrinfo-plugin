<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\ManyToOne;

trait NutrinfoVariantTrait
{
    use NutrinfoTrait;

    /**
     * @ManyToOne(targetEntity="Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo", inversedBy="variants" ,cascade={"persist"})
     */
    public $nutrinfo;
}
