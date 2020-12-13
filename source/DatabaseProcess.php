<?php

class DatabaseProcess
{
    private $link;

    /**
     * DatabaseProcess constructor.
     */
    public function __construct()
    {
        $hostName = "10.62.98.193";
        $userName = "phpTest";
        $password = "phpTest";
        $database = "business_management";
        $this->link = mysqli_connect($hostName, $userName, $password, $database);
    }


    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }


    /**
     * 查找某个表, 符合某个字段的内容(数组)
     * table: 表名, $field: 字段名, $value:字段值
     * @param $table
     * @param $field
     * @param $value
     * @return array
     */
    public function searchByField($table, $field, $value): array
    {
        $sql = "select * from  {$table} where ${field} = '{$value}'";
        $result = mysqli_query($this->link, $sql);
        $this->tryAndShowError($result);
        return mysqli_fetch_all($result);
    }


    /**
     * 更新表， 通过某个字段
     * @param string $table 表名
     * @param string $field 需要修改的字段名
     * @param string $fieldValue 字段需要更改的字段值
     * @param string $condition 条件
     * @param string $conditionValue 条件值
     * @return bool|mysqli_result
     */
    public function updateByField(
        string $table,
        string $field,
        string $fieldValue,
        string $condition,
        string $conditionValue
    )
    {
        $sql = "update {$table} set {$field}='{$fieldValue}' where {$condition} = '{$conditionValue}'";
        $result = mysqli_query($this->link, $sql);
        $this->tryAndShowError($result); //检测是否出错
        return $result;
    }


    /**
     * 删除记录, 通过某个字段
     * @param $table
     * @param $field
     * @param $value
     * @return bool|mysqli_result
     */
    public function deleteByField($table, $field, $value)
    {
        $sql = "delete from ${table} where $field = '$value'";
        $result = mysqli_query($this->link, $sql);
    }


    /**
     * 添加记录
     * @param $table
     * @param array $values
     * @return bool|mysqli_result
     */
    public function insertByField($table, array $values)
    {
        $num = count($values);
        $str = "'" . $values[0] . "'";
        for ($i = 1; $i < $num; $i++) {
            if ($values[$i] == null) {
                $values[$i] = "null";
                $str = $str . ", " . $values[$i];
                continue;
            }
            $str = $str . ", '" . $values[$i] . "'";
        }
        $sql = "insert into {$table} values(" . $str . ")";
        $result = mysqli_query($this->link, $sql);
        $this->tryAndShowError($result);
        return $result;
    }


    /**
     * 获取某个表的总长度
     * @param $table
     * @return  int
     */
    public function numOfRows($table): int
    {
        $sql = "select count(*) from {$table}";
        $result = mysqli_query($this->link, $sql);
        return mysqli_fetch_array($result)[0];
    }


    /**
     * @param $result
     */
    private function tryAndShowError($result)
    {
        try {
            if (!$result) {
                throw new mysqli_sql_exception(">>>>ERROR !!<<<<");
            }
        } catch (mysqli_sql_exception $e) {
            echo "<div style='color: red; font-size: 12px; font-weight: bolder; margin: 0'>";
            echo "<pre/>";
            echo $e;
            echo "</div>";
        }
    }

    /**
     * 关闭数据库
     */
    public function closeConnect()
    {
        mysqli_close($this . $this->link);
        return null;
    }

}