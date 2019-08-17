<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\Form\Type;

use Ecolos\SyliusNutritionalInformationPlugin\Entity\NutritionalInformation;
use Ecolos\SyliusNutritionalInformationPlugin\Entity\NutritionalInformationActiveIngredientEntry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NutritionalInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kj', NumberType::class, ['label' => 'kJ'])
            ->add('fats', NumberType::class, ['label' => 'Fett'])
            ->add('saturated', NumberType::class, ['label' => 'davon gesättigte Fette'])
            ->add('carbs', NumberType::class, ['label' => 'Kohlenhydrate'])
            ->add('sugar', NumberType::class, ['label' => 'davon Zucker'])
            ->add('salt', NumberType::class, ['label' => 'Salz'])
            ->add('fiber', NumberType::class, ['label' => 'Ballaststoffe'])
            ->add('protein', NumberType::class, ['label' => 'Protein'])
            ->add('activeNew', CollectionType::class, [
                'label' => false,
                "data_class" => NutritionalInformationActiveIngredientEntry::class,
                "allow_add" => true,
                "allow_delete" => true,
                "allow_extra_fields" => true,
                "property_path" => "active"
            ])
            /*            ->add('active', CollectionType::class, [
                            'label' => 'Aktive Inhaltsstoffe',
                            "data_class" => NutritionalInformationActiveIngredientEntry::class,
            "allow_add" => true,
                            "allow_delete" => true
            //                "property_path"
                        ])*/
            /*          */
            /*            ->add('activeIngredient', CollectionType::class, [
                            'label' => "Aktiver Inhaltsstoff",
                            "data_class" => NutritionalInformationActiveIngredient::class,
                            "allow_add" => true,
                            "allow_delete" => true,
                            //                "allow_extra_fields" => true,
                            "button_add_label" => "Neuer Inhaltsstoff",
                            "property_path" => "active"
                        ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NutritionalInformation::class,
        ]);
    }
}
