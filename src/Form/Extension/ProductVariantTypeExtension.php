<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\Form\Extension;

use Ecolos\SyliusNutritionalInformationPlugin\Form\Type\NutritionalInformationType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductVariantType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductVariantTypeExtension extends BaseTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nutritionFacts', NutritionalInformationType::class, [
                'label' => 'Nährwerte',
                'required' => true
            ]);
    }

    /**
     * @inheritdoc
     */
    static public function getExtendedTypes(): iterable
    {
        return [ProductVariantType::class];
    }
}
