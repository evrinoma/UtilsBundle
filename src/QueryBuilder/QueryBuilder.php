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

namespace Evrinoma\UtilsBundle\QueryBuilder;

use Doctrine\ORM\QueryBuilder as BaseQueryBuilder;

final class QueryBuilder extends BaseQueryBuilder implements QueryBuilderInterface
{
    use QueryBuilderTrait;
}
