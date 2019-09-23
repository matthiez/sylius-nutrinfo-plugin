<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class NutrinfoType extends AbstractResourceType
{
    /** @var RepositoryInterface $activeIngredientsRepository */
    private $activeIngredientsRepository;

    public function __construct(RepositoryInterface $activeIngredientsRepository)
    {
        parent::__construct("Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo", ["ecolos_sylius_nutrinfo_plugin_nutrinfo", "sylius"]);

        $this->activeIngredientsRepository = $activeIngredientsRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $t = "ecolos_sylius_nutrinfo_plugin.ui.";

        $createTypeOptions = function (string $child, array $merge = []) use ($t): array {
            return array_merge([
                'label' => $t . $child,
                "attr" => [
                    "placeholder" => $t . $child,
                ],
                "translation_domain" => "messages",
                "required" => false,
            ], $merge);
        };

        $builder
            ->add('base', NumberType::class, $createTypeOptions("base", [
                "html5" => true,
                "required" => true,
                "constraints" => [
                    new Assert\NotNull(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('base_unit', ChoiceType::class, $createTypeOptions("base_unit", [
                "choices" => ["mg" => "mg", "n" => "n", "ml" => "ml"],
                "placeholder" => $t . "base_unit",
                "constraints" => [
                    new Assert\NotNull(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
                "required" => true,
            ]))
            ->add('is_base_portion', CheckboxType::class, $createTypeOptions("is_base_portion", [
                "label" => $t . "is_base_portion",
                "required" => true,
            ]))
            ->add('kj', NumberType::class, $createTypeOptions("kj", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('fats', NumberType::class, $createTypeOptions("fats", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('saturated', NumberType::class, $createTypeOptions("saturated", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('carbs', NumberType::class, $createTypeOptions("carbs", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('sugar', NumberType::class, $createTypeOptions("sugar", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('salt', NumberType::class, $createTypeOptions("salt", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('protein', NumberType::class, $createTypeOptions("protein", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('fiber', NumberType::class, $createTypeOptions("fiber", [
                "constraints" => [
                    new Assert\Positive(["groups" => ["ecolos_nutrinfo", "sylius"]]),
                ],
            ]))
            ->add('active_ingredients', KeyValueType::class, [
                "allowed_keys" => (function () {
                    $allowedKeys = [];

                    foreach ($this->activeIngredientsRepository->findAll() as $activeIngredient) {
                        $allowedKeys[$activeIngredient->getName()] = $activeIngredient->getId();
                    }

                    return $allowedKeys;
                })(),
                "button_add_label" => $t . "add_nutrinfo_active",
                "entry_type" => "Ecolos\SyliusNutrinfoPlugin\Form\Type\KeyValueRowType",
                "key_options" => ["label" => false],
                "label" => $t . "nutrinfo_actives",
                "translation_domain" => "messages",
                "units" => ['mg' => 'mg', "g" => "g", "mcg" => "mcg"],
                'use_container_object' => true,
                "value_options" => ["html5" => true],
                'value_type' => NumberType::class,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ecolos_sylius_nutrinfo_plugin_nutrinfo';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nutrinfo::class,
        ]);
    }
}
