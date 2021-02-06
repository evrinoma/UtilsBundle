<?php


namespace Evrinoma\UtilsBundle;

use Evrinoma\UtilsBundle\DependencyInjection\EvrinomaUtilsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaUtilsBundle extends Bundle
{
    public const UTILS_BUNDLE = 'utils';

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaUtilsExtension();
        }
        return $this->extension;
    }
}