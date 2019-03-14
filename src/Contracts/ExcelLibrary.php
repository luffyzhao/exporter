<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/14 14:31
 */

namespace LExport\Contracts;


interface ExcelLibrary
{
    public function setRow(array $data);

    public function setRows(array $data);
}