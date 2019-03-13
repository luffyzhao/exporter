<?php

namespace LExport\Library;

use Exception;

class ExcelCsv
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
     * @throws Exception
     */
    public function __construct()
    {
        if ($this->_fd === false) {
            $this->_fd = fopen('php://output', 'w');
            if ($this->_fd === false) {
                throw new Exception('can‘t open php://output');
            }
        }
    }

    /**
     * 添加表头
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/11 14:12
     */
    public function setHeader(array $data)
    {
        fputcsv($this->_fd, $data, ',', '"');
    }

    /**
     * 添加内容
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/11 14:17
     */
    public function setBody(array $data)
    {
        fputcsv($this->_fd, $data, ',', '"');
    }

    /**
     * 批量添加内容
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/12 15:55
     */
    public function setBodies(array $data){
        foreach ($data as $value){
            $this->setBody($value);
        }
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