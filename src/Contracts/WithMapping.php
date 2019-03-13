<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/12 16:23
 */

namespace LExport\Contracts;


interface WithMapping
{
    public function map(array $data): array;
}