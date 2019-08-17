<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $menu
            ->getChild('catalog')
            ->addChild("ecolos-nutrinfo")
            ->setLabel('ecolos_sylius_nutrinfo_plugin.ui.nutrinfo_actives')
            ->setLabelAttribute('icon', 'lemon')
            ->setUri('/admin/nutrinfo-actives');
    }
}
