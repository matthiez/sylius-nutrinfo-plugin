<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class NutrinfoType extends AbstractResourceType
{
    /** @var RepositoryInterface */
    private $activeIngredientsRepository;

    private const BASE_UNIT_CHOICES = ["mg" => "mg", "n" => "n", "ml" => "ml"];

    public function __construct(RepositoryInterface $activeIngredientsRepository)
    {
        parent::__construct("Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo", ["sylius"]);

        $this->activeIngredientsRepository = $activeIngredientsRepository;
    }

    private function onPreSetData()
    {
        return function (FormEvent $event): void {
            $nutrinfo = null;

            $data = $event->getData();

            if (null === $data) {
                $nutrinfo = new Nutrinfo();

            } elseif ($data instanceof Nutrinfo) {
                $nutrinfo = $data;
            }
            if (null !== $nutrinfo) {
                if (null === $nutrinfo->getBase()) {
                    $nutrinfo->setBase(100000);
                }

                $event->setData($nutrinfo);
            }
        };
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

        $createTypeOptions = function (string $child, array $merge = []): array {
            return array_merge([
                'label' => "ecolos_sylius_nutrinfo_plugin.ui." . $child,
                "attr" => [
                    "placeholder" => "ecolos_sylius_nutrinfo_plugin.ui." . $child
                ],
                "translation_domain" => "messages",
                "required" => true
            ], $merge);
        };

        $builder
            ->add('base', NumberType::class, $createTypeOptions("base", ["html5" => true]))
            ->add('base_unit', ChoiceType::class, $createTypeOptions("base_unit", ["choices" => self::BASE_UNIT_CHOICES]))
            ->add('kj', NumberType::class, $createTypeOptions("kj"))
            ->add('fats', NumberType::class, $createTypeOptions("fats"))
            ->add('kj', NumberType::class, $createTypeOptions("kj"))
            ->add('fats', NumberType::class, $createTypeOptions("fat"))
            ->add('saturated', NumberType::class, $createTypeOptions("saturated"))
            ->add('carbs', NumberType::class, $createTypeOptions("carbs"))
            ->add('sugar', NumberType::class, $createTypeOptions("sugar"))
            ->add('salt', NumberType::class, $createTypeOptions("salt"))
            ->add('protein', NumberType::class, $createTypeOptions("protein"))
            ->add('fiber', NumberType::class, $createTypeOptions("fiber", ["required" => false]))
            ->add('active_ingredients', KeyValueType::class, [
                'value_type' => NumberType::class,
                "value_options" => ["html5" => true],
                "entry_type" => "Ecolos\SyliusNutrinfoPlugin\Form\Type\KeyValueRowType",
                'use_container_object' => true,
                "label" => "ecolos_sylius_nutrinfo_plugin.ui.nutrinfo_actives",
                "button_add_label" => "ecolos_sylius_nutrinfo_plugin.ui.add_nutrinfo_active",
                "allowed_keys" => $allowedKeys,
                "key_options" => ["label" => false],
                "translation_domain" => "messages",
                "units" => ['mg' => 'mg', "g" => "g"]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, $this->onPreSetData());
    }

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
