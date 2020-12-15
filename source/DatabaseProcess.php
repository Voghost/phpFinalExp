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
     * @param string $table
     * @param string $field
     * @param mixed $value
     * @return array 返回二维数组
     */
    public function searchByField(string $table, string $field, $value): array
    {
        //tmp 占位符，判断是否要用引号
        $tmp = (is_numeric($value)) ? "" : "'";
        if ($value == null) {
            $sql = "select * from  {$table} where ${field} is null";
        } else {
            $sql = "select * from  {$table} where ${field} = {$tmp}{$value}{$tmp}";
        }
        $result = mysqli_query($this->link, $sql);
        $this->tryAndShowError($result);
        return mysqli_fetch_all($result, MYSQLI_BOTH);
    }


    /**
     * 更新表， 通过某个字段
     * @param string $table 表名
     * @param string $field 需要修改的字段名
     * @param string $fieldValue 字段需要更改的字段值
     * @param string $condition 条件
     * @param string $conditionValue 条件值
     * @return bool|mysqli_result 返回是否更新成功
     */
    public function updateByField(
        string $table,  //要修改的表
        string $field, //要修改的目标的id
        string $fieldValue, //要修改的目标的id值
        string $condition, //要修改的字段名
        string $conditionValue //要修改的字段值
    )
    {
        $sql = "update {$table} set {$field}='{$fieldValue}' where {$condition} = '{$conditionValue}'";
        $result = mysqli_query($this->link, $sql);
        $this->tryAndShowError($result); //检测是否出错
        return $result;
    }

    /**
     * 更新表， 通过数组(键值对)批量修改
     * @param string $table 表名
     * @param array $arr 数组(键值对)
     * @param array|null $conditions //条件 <可选>
     * @return bool|mysqli_result 返回是否更新成功
     */
    public function updateByArray(string $table, array $arr, array $conditions = null)
    {

        $id = key($arr);
        $idValue = current($arr);

        $tmp = "'";
        //如果是数字类型或为空值    ，不需要单引号
        if (is_numeric(current($arr)) || (current($arr)) == null) {
            $tmp = "";
        }

        $sql = "update {$table} set {$id} = {$tmp}{$idValue}{$tmp} ";
        next($arr);


        for ($i = 1; $i < count($arr); $i++) {
            $tmp = "'";

            //如果是数字类型或为空值    ，不需要单引号
            if (is_numeric(current($arr)) || (current($arr)) == null) {
                $tmp = "";
            }

            //如果为空值
            if (current($arr) == null) {
                $sql = $sql . ", " . key($arr) . "= null ";
            } else {
                $sql = $sql . ", " . key($arr) . "= {$tmp}" . current($arr) . "{$tmp} ";
            }
            next($arr);
        }

        if ($conditions == null) {
            $sql = $sql . "where {$id} = '{$idValue}'";
        } else {
            $sql = $sql . "where " . key($conditions) . "= '" . current($conditions) . "' ";
            next($conditions);
            for ($i = 1; $i < count($conditions); $i++) {
                $sql = $sql . "and " . key($conditions) . "= '" . current($conditions) . "'";
                next($conditions);
            }
        }

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


    /*
     * 添加记录(通过单纯数组)
     * @param $table
     * @param array $values
     * @return bool|mysqli_result
     */
    /*    public function insertValues($table, array $values)
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
        }*/


    /**
     * 通过(键值对)插入数据到数据库
     * @param $table
     * @param array $values
     * @return bool|mysqli_result
     */
    public function insertValues($table, array $values)
    {
        //如果是数字类型或为空值    ，不需要单引号
        $tmp = "'";
        if (is_numeric(current($values)) || (current($values)) == null) {
            $tmp = "";
        }


        $num = count($values);
        $key = key($values); //获取第数组第0的key值
        $value = "{$tmp}" . current($values) . "{$tmp}"; //获取第数组第0的value值
        next($values); //指针转向下一个数组

        for ($i = 1; $i < $num; $i++) {

            //如果是数字类型或为空值    ，不需要单引号
            $tmp = "'";
            if (is_numeric(current($values)) || (current($values)) == null) {
                $tmp = "";
            }

            $key = $key . ", " . key($values);
            if (current($values) == null) {
                $value = $value . ", null";
            } else {
                $value = $value . ", {$tmp}" . current($values) . "{$tmp}";
            }
            next($values);
        }

        $sql = "insert into {$table} (" . $key . ") values (" . $value . ")";
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
     * 查询某个字段的最大值
     * @param $table
     * @param $field
     * @return string
     */
    public function searchMax($table, $field): string
    {
        $sql = "select MAX({$field}) from {$table}";
        $result = mysqli_query($this->link, $sql);
        return mysqli_fetch_array($result)[0];
    }

    /**
     * 异常处理(输出异常)
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
            echo $e . "<br/>";
            echo mysqli_error($this->link);
            echo "</div>";
        }
    }

    /**
     * 关闭数据库
     */
    public function closeConnect()
    {
        mysqli_close($this->link);
        return null;
    }

}