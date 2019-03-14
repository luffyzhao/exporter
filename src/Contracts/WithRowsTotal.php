<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/14 14:20
 */

namespace LExport\Contracts;


interface WithRowsTotal
{
    public function totalCollection(): int;
}