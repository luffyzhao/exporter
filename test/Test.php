<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/12 16:25
 */

use LExport\Contracts\FromQuery;
use LExport\Contracts\WithHeadings;
use LExport\Contracts\WithMapping;

require '../vendor/autoload.php';

class Test implements FromQuery, WithHeadings, WithMapping
{

    public function query(int $offset, int $limit): array
    {
        return [['中国功夫', '男']];
    }

    public function totalCollection(): int
    {
        return 1000000;
    }

    public function limit(): int
    {
        return 1;
    }

    public function headings(): array
    {
        return ['姓名', '性别'];
    }

    public function map(array $data): array
    {
        return [
            $data[0],
        ];
    }
}