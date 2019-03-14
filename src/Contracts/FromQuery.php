<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/12 15:59
 */

namespace LExport\Contracts;


interface FromQuery
{
    public function query(int $offset, int $limit): array;

    public function limit(): int;
}