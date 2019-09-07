<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class NutrinfoType extends AbstractType
{
    /** @var RepositoryInterface */
    private $activeIngredientsRepository;

    public function __construct(RepositoryInterface $activeIngredientsRepository)
    {
        $this->activeIngredientsRepository = $activeIngredientsRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $allowedKeys = [];

        foreach ($this->activeIngredientsRepository->findAll() as $activeIngredient) {
            $allowedKeys[$activeIngredient->getName()] = $activeIngredient->getId();
        }

        $createTypeOptions = function (string $child, bool $required = true): array {
            return [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui." . $child,
                "attr" => [
                    "placeholder" => "ecolos_sylius_nutrinfo_plugin.ui." . $child
                ],
                "translation_domain" => "messages",
                "required" => $required
            ];
        };

        $builder
            ->add('kj', NumberType::class, $createTypeOptions("kj"))
            ->add('fats', NumberType::class, $createTypeOptions("fat"))
            ->add('saturated', NumberType::class, $createTypeOptions("saturated"))
            ->add('carbs', NumberType::class, $createTypeOptions("carbs"))
            ->add('sugar', NumberType::class, $createTypeOptions("sugar"))
            ->add('salt', NumberType::class, $createTypeOptions("salt"))
            ->add('protein', NumberType::class, $createTypeOptions("protein"))
            ->add('fiber', NumberType::class, $createTypeOptions("fiber", false))
            ->add('active_ingredients', KeyValueType::class, [
                'value_type' => NumberType::class,
                "value_options" => ["html5" => true],
                "entry_type" => "Ecolos\SyliusNutrinfoPlugin\Form\Type\KeyValueRowType",
                'use_container_object' => true,
                "label" => false,
                "button_add_label" => "ecolos_sylius_nutrinfo_plugin.ui.add_nutrinfo_active",
                "allowed_keys" => $allowedKeys,
                "key_options" => ["label" => "ecolos_sylius_nutrinfo_plugin.ui.nutrinfo_active"],
                "translation_domain" => "messages",
                "units" => ['mg' => 'mg', "g" => "g"]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ecolos_sylius_nutrinfo_plugin_nutrinfo';
    }
}
