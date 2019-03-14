<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/12 16:06
 */

namespace LExport;


use LExport\Contracts\ExcelLibrary;
use LExport\Contracts\FromQuery;
use LExport\Contracts\WithHeadings;
use LExport\Contracts\WithMapping;
use LExport\Contracts\WithRowsTotal;
use LExport\Library\ExcelCsv;

class Exporter
{
    private $export = null;

    /**
     * Exporter constructor.
     * @param FromQuery $export
     * @throws \Exception
     */
    public function __construct(FromQuery $export)
    {
        if($export instanceof WithRowsTotal){
            if($export->totalCollection() >= 1048576){
                throw new \Exception('导出最大行数为 1048576 ！');
            }
        }

        $this->export = $export;
    }

    /**
     * 导出
     * @param string $filename
     * @throws \Exception
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 16:12
     */
    public function download(string $filename){
        $this->outputHead($filename);
        $excel = new ExcelCsv('php://output');
        $this->build($excel);
    }


    /**
     * @param ExcelLibrary $excel
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/14 14:34
     */
    protected function build(ExcelLibrary $excel){
        $export = $this->export;
        $limit = $export->limit();

        if($export instanceof WithHeadings){
            $excel->setRow($export->headings());
        }

        if($export instanceof WithRowsTotal){
            $total = $export->totalCollection();
            if($total > 0){
                $maxPage = ceil($total / $limit);
                for ($i = 1; $i <= $maxPage; $i++){
                    $excel->setRows(
                        $this->mapping(
                            $export->query((($i-1) * $limit), $limit)
                        )
                    );
                }
            }
        }else{
            $i = 1;
            while($bodies = $export->query((($i-1) * $limit), $limit)){
                $excel->setRows(
                    $this->mapping(
                        $bodies
                    )
                );
                $i++;
            }
        }

    }

    /**
     * @param $bodies
     * @return mixed
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/14 14:38
     */
    protected function mapping($bodies){
        $export = $this->export;
        if($export instanceof WithMapping){
            foreach ($bodies as $key => $data){
                $bodies[$key] = $data;
            }
        }
        return $bodies;
    }

    /**
     * 设置下载文件
     * @param $filename
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 16:29
     */
    protected function outputHead($filename){
        header('Content-Type: text/csv');
        header('Content-Type: charset=utf-8');
        header('Content-Disposition: attachment;filename='. $filename);
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}