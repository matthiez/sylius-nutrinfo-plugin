<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Burgov\Bundle\KeyValueFormBundle\Form\Type\KeyValueRowType as BaseType;

class KeyValueRowType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null === $options['allowed_keys']) {
            $builder->add('key', $options['key_type'], $options['key_options']);
        } else {
            $builder->add('key', ChoiceType::class, array_merge([
                'choices' => $options['allowed_keys']
            ], $options['key_options']
            ));
        }

        $builder->add('value', $options['value_type'], $options['value_options']);

        $builder->add('unit', ChoiceType::class, [
            "label" => "ecolos_sylius_nutrinfo_plugin.ui.unit",
            'choices' => $options['units']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // check if Form component version 2.8+ is used
        $isSf28 = method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');

        $resolver->setDefaults([
            'key_type' => $isSf28 ? 'Symfony\Component\Form\Extension\Core\Type\TextType' : 'text',
            'key_options' => [],
            'value_options' => [],
            'allowed_keys' => null,
        ]);

        $resolver->setRequired(['value_type']);

        $resolver->setRequired(['units']);

        if (method_exists($resolver, 'setDefined')) {
            // Symfony 2.6+ API
            $resolver->setAllowedTypes('allowed_keys', ['null', 'array']);
        } else {
            // Symfony <2.6 API
            $resolver->setAllowedTypes(['allowed_keys' => ['null', 'array']]);
        }
    }
}
