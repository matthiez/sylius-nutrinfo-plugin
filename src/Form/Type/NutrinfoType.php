<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\Type;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Burgov\Bundle\KeyValueFormBundle\Form\Type\KeyValueType;


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

        $builder
            ->add('kj', NumberType::class, ['label' => "kJ", "attr" => ["placeholder" => "kJ"]])
            ->add('fats', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.fat",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.fat"],
                "translation_domain" => "messages"])
            ->add('saturated', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.saturated",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.saturated"],
                "translation_domain" => "messages"])
            ->add('carbs', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.carbs",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.carbs"],
                "translation_domain" => "messages"])
            ->add('sugar', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.sugar",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.sugar"],
                "translation_domain" => "messages"])
            ->add('salt', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.salt",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.salt"],
                "translation_domain" => "messages"])
            ->add('fiber', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.fiber",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.fiber"],
                "translation_domain" => "messages"])
            ->add('protein', NumberType::class, [
                'label' => "ecolos_sylius_nutrinfo_plugin.ui.protein",
                "attr" => ["placeholder" => "ecolos_sylius_nutrinfo_plugin.ui.protein"],
                "translation_domain" => "messages"])
            ->add('active_ingredients', KeyValueType::class, [
                'value_type' => NumberType::class,
                'use_container_object' => true,
                "label" => false,
                "button_add_label" => "ecolos_sylius_nutrinfo_plugin.ui.add_nutrinfo_active",
                "allowed_keys" => $allowedKeys,
                "key_options" => ["label" => "ecolos_sylius_nutrinfo_plugin.ui.nutrinfo_active"],
                "value_options" => ["label" => "mg"],
                "translation_domain" => "messages"
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
