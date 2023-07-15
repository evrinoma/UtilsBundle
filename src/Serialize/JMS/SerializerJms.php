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

namespace Evrinoma\UtilsBundle\Serialize\JMS;

use Evrinoma\UtilsBundle\Serialize\AbstractSerializerRegistry;
use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface as BasicSerializerInterface;

class SerializerJms extends AbstractSerializerRegistry implements SerializerInterface
{
    private BasicSerializerInterface $serializer;

    private ?SerializationContext $serializationContext = null;

    public function __construct(BasicSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function setGroup(string $name): SerializerInterface
    {
        if ($name) {
            $this->serializationContext = SerializationContext::create()->setGroups($name);
        }

        return $this;
    }

    public function serialize($data, $format = 'json'): string
    {
        return $this->serializer->serialize($data, $format, $this->serializationContext);
    }
}
