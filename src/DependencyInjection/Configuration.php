<?php
/** @noinspection PhpDeprecationInspection */
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    private const TREE_BUILDER_NAME = 'ecolos_sylius_nutrinfo_plugin';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::TREE_BUILDER_NAME);

        $rootNode = method_exists(TreeBuilder::class, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root(self::TREE_BUILDER_NAME);

        return $treeBuilder;
    }
}
