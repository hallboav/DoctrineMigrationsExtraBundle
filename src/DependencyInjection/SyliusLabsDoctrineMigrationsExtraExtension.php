<?php

declare(strict_types=1);

namespace SyliusLabs\DoctrineMigrationsExtraBundle\DependencyInjection;

use SyliusLabs\DoctrineMigrationsExtraBundle\Comparator\TopologyBasedVersionComparator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SyliusLabsDoctrineMigrationsExtraExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');

        $container->getDefinition(TopologyBasedVersionComparator::class)->setArgument(0, $config['migrations']);
    }
}