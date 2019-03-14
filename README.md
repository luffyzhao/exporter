## csv 数据分批导出

最大可导 `1048576` 行数据，导10条和导10w条数据内存消耗是一样的。使用方法请查看 `test` 目录。

- [FromQuery](./src/Contracts/FromQuery.php) 
- [WithHeadings](./src/Contracts/WithHeadings.php) 
- [WithMapping](./src/Contracts/WithMapping.php) 
- [WithRowsTotal](./src/Contracts/WithRowsTotal.php) 

> WithRowsTotal 接口都可以，用 WithRowsTotal 接就得先查有多少条数据，不用 WithRowsTotal 就是 while 到最后没有数据