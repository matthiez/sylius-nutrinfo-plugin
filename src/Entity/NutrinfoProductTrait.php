<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\ManyToOne;

trait NutrinfoProductTrait
{
    use NutrinfoTrait;

    /**
     * @ManyToOne(targetEntity="Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo", inversedBy="products" ,cascade={"persist"})
     */
    public $nutrinfo;
}
