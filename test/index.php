<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/11 14:29
 */

require '../vendor/autoload.php';
require './Test.php';

(new \LExport\Exporter)->download(new Test, '文件.csv');

