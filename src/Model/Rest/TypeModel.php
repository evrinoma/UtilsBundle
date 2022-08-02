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

namespace Evrinoma\UtilsBundle\Model\Rest;

final class TypeModel
{
    public const TYPE = 'type';

    public const ERROR = -1;
    public const NOTICE = 1;
    public const INFO = 2;
    public const DEBUG = 3;

    public static array $types = [
        self::ERROR => 'ERROR',
        self::NOTICE => 'NOTICE',
        self::INFO => 'INFO',
        self::DEBUG => 'DEBUG',
    ];

    public static function toString($type): string
    {
        return self::$types[$type];
    }
}
