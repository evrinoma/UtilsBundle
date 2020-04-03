<?php


namespace Evrinoma\UtilsBundle;

use Evrinoma\UtilsBundle\DependencyInjection\EvrinomaUtilsBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaUtilsBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaUtilsBundleExtension();
        }
        return $this->extension;
    }
}