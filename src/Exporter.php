<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/12 16:06
 */

namespace LExport;


use LExport\Contracts\FromQuery;
use LExport\Contracts\WithHeadings;
use LExport\Contracts\WithMapping;
use LExport\Library\ExcelCsv;

class Exporter
{
    /**
     * 导出
     * @param FromQuery $export
     * @param string $fileName
     * @throws \Exception
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 16:12
     */
    public function download(FromQuery $export, string $fileName){
        $this->setFileName($fileName);
        $this->putQuery($export);
    }

    /**
     * @param FromQuery $export
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 16:41
     * @throws \Exception
     */
    protected function putQuery(FromQuery $export){
        $excel = new ExcelCsv();

        if($export instanceof WithHeadings){
            $excel->setHeader($export->headings());
        }

        $total = $export->totalCollection();

        if($total >= 1048576){
            throw new \Exception('csv 最大行数为 1048576 ！');
        }

        if($total > 0){
            $limit = $export->limit();
            $maxPage = ceil($total / $limit);

            for ($i = 1; $i <= $maxPage; $i++){
                $bodies = $export->query((($i-1) * $limit), $limit);

                if($export instanceof WithMapping){
                    foreach ($bodies as $data){
                        $excel->setBody($export->map($data));
                    }
                }else{
                    $excel->setBodies($bodies);
                }
            }
        }
    }

    /**
     * 设置下载文件
     * @param $fileName
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 16:29
     */
    protected function setFileName($fileName){
        header('Content-Type: text/csv');
        header('Content-Type: charset=utf-8');
        header('Content-Disposition: attachment;filename='. $fileName);
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}