<?php

namespace LExport\Library;

use Exception;
use LExport\Contracts\ExcelLibrary;

class ExcelCsv implements ExcelLibrary
{
    /**
     * output 句柄
     * @var bool
     */
    private $_fd = false;

    /**
     * 初始化
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/11 13:41
     * @param string $file
     * @throws Exception
     */
    public function __construct(string $file = 'php://output')
    {
        $this->_fd = fopen($file, 'w+');
        if ($this->_fd === false) {
            throw new Exception('can‘t open ' . $file);
        }
    }

    /**
     * 添加内容
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/11 14:17
     */
    public function setRow(array $data)
    {
        $this->writeCsvData($data);
    }

    /**
     * 批量添加内容
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 15:55
     */
    public function setRows(array $data)
    {
        foreach ($data as $value) {
            $this->setRow($value);
        }
    }

    /**
     * 数据写入csv文件
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/14 14:26
     */
    private function writeCsvData(array $data)
    {
        fputcsv($this->_fd, $data, ',', '"');
    }

    /**
     * 构析函数
     */
    public function __destruct()
    {
        if (!empty($this->_fd)) {
            fclose($this->_fd);
        }
    }

}