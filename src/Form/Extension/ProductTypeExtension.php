<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Extension;

use Sylius\Bundle\ProductBundle\Form\Type\ProductType;

final class ProductTypeExtension extends NutrinfoTypeExtension
{
    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}
