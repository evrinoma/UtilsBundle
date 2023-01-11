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

namespace Evrinoma\UtilsBundle\Lib;

final class MbString
{
    public static function mb_strrev($str, $encoding = 'UTF-8')
    {
        return mb_convert_encoding(strrev(mb_convert_encoding($str, 'UTF-16BE', $encoding)), $encoding, 'UTF-16LE');
    }
}
