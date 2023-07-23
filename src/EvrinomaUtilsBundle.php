<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle;

use Evrinoma\UtilsBundle\DependencyInjection\Compiler\EntityManagerPass;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\SerializerConfigurationPass;
use Evrinoma\UtilsBundle\DependencyInjection\EvrinomaUtilsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaUtilsBundle extends Bundle
{
    public const BUNDLE = 'utils';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new EntityManagerPass())
            ->addCompilerPass(new SerializerConfigurationPass());
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaUtilsExtension();
        }

        return $this->extension;
    }
}
