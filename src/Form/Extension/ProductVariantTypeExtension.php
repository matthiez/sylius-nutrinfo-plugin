<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Extension;

use Ecolos\SyliusNutrinfoPlugin\Form\Type\NutrinfoType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo;

final class ProductVariantTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nutrinfo", NutrinfoType::class, [
                'label' => false,
                'required' => false,
                "translation_domain" => "ecolos_sylius_nutrinfo_plugin",
                "data_class" => Nutrinfo::class,
            ]);
    }

    /**
     * @inheritdoc
     */
    public static function getExtendedTypes(): iterable
    {
        return [ProductVariantType::class];
    }
}
