<?php

namespace ContainerPKXQ2CA;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAnnotations_CacheService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'annotations.cache' shared service.
     *
     * @return \Symfony\Component\Cache\DoctrineProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'\\vendor\\symfony\\cache\\Traits\\ProxyTrait.php';
        include_once \dirname(__DIR__, 4).'\\vendor\\symfony\\cache\\Adapter\\PhpArrayAdapter.php';

        return new \Symfony\Component\Cache\DoctrineProvider(\Symfony\Component\Cache\Adapter\PhpArrayAdapter::create(($container->targetDir.''.'/annotations.php'), ($container->privates['cache.annotations'] ?? $container->getCache_AnnotationsService())));
    }
}
