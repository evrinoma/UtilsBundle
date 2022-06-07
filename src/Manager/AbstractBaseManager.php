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

namespace Evrinoma\UtilsBundle\Manager;

/**
 * @deprecated
 */
abstract class AbstractBaseManager implements BaseInterface
{
    /**
     * @var mixed
     */
    protected $data = [];

    /**
     * @return mixed
     */
    public function hasSingleData()
    {
        return 1 === \count($this->data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return AbstractEntityManager
     */
    public function setData($data)
    {
        $this->data = $data ?? [];

        return $this;
    }
}
