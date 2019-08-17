<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutritionalInformationPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('ecolos_sylius_nutritional_information_plugin');

        return $treeBuilder;
    }
}
