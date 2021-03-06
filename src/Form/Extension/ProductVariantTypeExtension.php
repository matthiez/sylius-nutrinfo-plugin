<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Extension;

use Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType;

final class ProductVariantTypeExtension extends NutrinfoTypeExtension
{
    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [ProductVariantType::class];
    }
}
