<?php

namespace Evrinoma\UtilsBundle\DependencyInjection\Compiler;

use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Evrinoma\UtilsBundle\Exception\MapEntityCannotBeCompiledException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;


abstract class AbstractMapEntity implements MapEntityInterface
{
//region SECTION: Fields
    protected string           $nameSpace;
    protected string           $path;
    protected ContainerBuilder $container;
    private bool               $callResolver                  = false;
    private ?Definition        $resolveTargetEntityDefinition = null;
//endregion Fields

//region SECTION: Constructor
    public function __construct(string $nameSpace, string $path)
    {
        $this->nameSpace = $nameSpace;
        $this->path      = $path;
    }
//endregion Constructor

//region SECTION: Protected
    protected function loadMetadata(Definition $driver, Reference $referenceAnnotationReader, $formatterModel, $formatterEntity): void
    {
        $definitionAnnotationDriver = new Definition(AnnotationDriver::class, [$referenceAnnotationReader, sprintf($formatterModel, $this->path)]);
        $driver->addMethodCall('addDriver', [$definitionAnnotationDriver, sprintf(str_replace('/', '\\', $formatterModel), $this->nameSpace)]);

        $definitionAnnotationDriver = new Definition(AnnotationDriver::class, [$referenceAnnotationReader, sprintf($formatterEntity, $this->path)]);
        $driver->addMethodCall('addDriver', [$definitionAnnotationDriver, sprintf(str_replace('/', '\\', $formatterEntity), $this->nameSpace)]);
    }

    protected function cleanMetadata(Definition $driver, array $namesSpaces)
    {
        $calls = [];
        foreach ($driver->getMethodCalls() as $i => $call) {
            if ($call[1][1] && in_array($call[1][1], $namesSpaces)) {
                continue;
            }
            $calls[] = $call;
        }
        $driver->setMethodCalls($calls);
    }

    protected function addResolveTargetEntity(array $resolve, $searchInParams = true): MapEntityInterface
    {
        $resolveTargetEntity = $this->getResolveTargetEntity();

        foreach ($resolve as $classNameMapping => $value) {
            if ($searchInParams) {
                $classNameMapping = $this->container->getParameter($classNameMapping);
            }
            if (!is_array($value) || !is_string($classNameMapping)) {
                throw new MapEntityCannotBeCompiledException("Wrong mapping structure");
            }
            foreach ($value as $aliasClassName => $mapping) {
                $resolveTargetEntity->addMethodCall('addResolveTargetEntity', [$aliasClassName, $classNameMapping, $mapping]);
            }
        }

        return $this->callResolveTargetEntity();
    }

    protected function callResolveTargetEntity(): MapEntityInterface
    {
        if (!$this->callResolver) {
            $eventManager = $this->container->findDefinition('doctrine.dbal.connection.event_manager');
            $eventManager->addMethodCall('addEventListener', [Events::loadClassMetadata, new Reference('doctrine.orm.listeners.resolve_target_entity')]);
            $this->callResolver();
        }

        return $this;
    }

    protected function remapMetadata(Definition $driver, string $class, string $mapFolder): MapEntityInterface
    {
        $calls = [];

        foreach ($driver->getMethodCalls() as $i => $call) {
            if ($call[1][1] && $call[1][1] === $class) {
                $call[1][1] = $class.'\\'.$mapFolder;
            }
            $calls[] = $call;
        }
        $driver->setMethodCalls($calls);

        return $this;
    }
//endregion Protected

//region SECTION: Private
    private function getResolveTargetEntity(): Definition
    {
        if ($this->resolveTargetEntityDefinition === null) {
            $this->resolveTargetEntityDefinition = $this->container->findDefinition('doctrine.orm.listeners.resolve_target_entity');
        }

        return $this->resolveTargetEntityDefinition;
    }

    /**
     * @param bool $callResolver
     *
     * @return self
     */
    private function callResolver(bool $callResolver = true): MapEntityInterface
    {
        $this->callResolver = $callResolver;

        return $this;
    }
//endregion Private

//region SECTION: Getters/Setters
    public function setContainer(ContainerBuilder $container): MapEntityInterface
    {
        $this->container = $container;

        return $this;
    }
//endregion Getters/Setters
}