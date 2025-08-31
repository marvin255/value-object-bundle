<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * Bundle object.
 *
 * @psalm-api
 */
final class Marvin255ValueObjectBundle extends AbstractBundle
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $bundles = $builder->getParameter('kernel.bundles');

        if (!\is_array($bundles) || !isset($bundles['DoctrineBundle'])) {
            return;
        }

        $builder->prependExtensionConfig(
            'doctrine',
            [
                'dbal' => [
                    'types' => ValueObjectType::getNameToClassMap(),
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
