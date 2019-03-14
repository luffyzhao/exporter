<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/11 14:29
 */

require '../vendor/autoload.php';
require './Test.php';

try {
    (new \LExport\Exporter(new Test))->download('文件.csv');
} catch (Exception $e) {
}

// Test 类用不用 WithRowsTotal 接口都可以，用 WithRowsTotal 接就得先查有多少条数据，不用 WithRowsTotal 就是 while 到最后没有数据
