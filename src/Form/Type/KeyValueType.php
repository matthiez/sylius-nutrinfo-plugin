<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Burgov\Bundle\KeyValueFormBundle\Form\Type\KeyValueType as BaseType;
use Ecolos\SyliusNutrinfoPlugin\Form\DataTransformer\HashToKeyValueArrayTransformer;

class KeyValueType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new HashToKeyValueArrayTransformer($options['use_container_object']));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $e) {
            $input = $e->getData();

            if (null === $input) {
                return;
            }

            $output = [];

            foreach ($input as $key => $data) {
                $output[] = [
                    'key' => $key,
                    'value' => $data["value"],
                    'unit' => $data["unit"]
                ];
            }

            $e->setData($output);
        }, 1);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // check if Form component version 2.8+ is used
        $isSf28 = method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');

        $resolver->setDefaults([
            $isSf28 ? 'entry_type' : 'type' => $isSf28 ? __NAMESPACE__ . '\KeyValueRowType' : 'burgov_key_value_row',
            'allow_add' => true,
            'allow_delete' => true,
            'key_type' => $isSf28 ? 'Symfony\Component\Form\Extension\Core\Type\TextType' : 'text',
            'key_options' => [],
            'value_options' => [],
            'allowed_keys' => null,
            'use_container_object' => false,
            $isSf28 ? 'entry_options' : 'options' => function (Options $options) {
                return [
                    'key_type' => $options['key_type'],
                    'value_type' => $options['value_type'],
                    'key_options' => $options['key_options'],
                    'value_options' => $options['value_options'],
                    'allowed_keys' => $options['allowed_keys'],
                    'units' => $options['units'],
                ];
            }
        ]);

        $resolver->setRequired(['value_type', "units"]);

        if (method_exists($resolver, 'setDefined')) {
            // Symfony 2.6+ API
            $resolver->setAllowedTypes('allowed_keys', ['null', 'array']);
        } else {
            // Symfony <2.6 API
            $resolver->setAllowedTypes(['allowed_keys' => ['null', 'array']]);
        }
    }
}
