<?php
$dir = dirname(__FILE__);
require_once($dir."/../../source/DatabaseProcess.php");
require_once($dir."/../../source/Entity/Staff.php");
require_once($dir."/../../source/Entity/Department.php");
require_once($dir."/../../source/Entity/Project.php");
require_once($dir."/../../source/Entity/Task.php");


class DepartmentProcess
{
    ///////////////////////////////////////////////////////////////
    /////////////////////      基本增删改查    //////////////////////
    ///////////////////////////////////////////////////////////////


    /**
     * 新建一条部门数据 (通过Department对象)
     * @param Department $department
     * @return bool|mysqli_result
     */
    public function insertDepartment(Department $department)
    {
        $databaseProcess = new DatabaseProcess();
        $maxDepartmentId = $databaseProcess->searchMax("department", "DepartmentId");

        //字符串自加1
        $num = (int)substr($maxDepartmentId, 1);
        $num = $num + 1001;
        $maxStaffId = "D" . substr($num, 1); //S -> staff 表示员工

        $department->setDepartmentId($maxStaffId);

        $result =$databaseProcess->insertValues("department", $department->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过部门id删除数据
     * @param string $departmentId
     */
    public function deleteDepartmentById(string $departmentId)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("department", "DepartmentId", $departmentId);
    }


    /**
     * 只更新某个字段
     * @param string $departmentId
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateStaffById(string $departmentId, string $key, string $value)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("staff", "StaffId", $departmentId, $key, $value);
        $databaseProcess->closeConnect();
    }


    /**
     * 通过Staff对象实体更新
     * @param Department $department
     * @return bool|mysqli_result
     */
    public function updateDepartmentByEntity(Department $department)
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->updateByArray("department", $department->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过部门的某个字段查找部门(们)的具体信息
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @return array
     */
    public function searchDepartment(string $field, $value): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("department", $field, $value);
        $databaseProcess->closeConnect();

        $staffs = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $staffs[] = new Department(
                $result[$i]["DepartmentId"],
                $result[$i]["DepartmentName"],
                $result[$i]["DepartmentAddress"]
            );
        }
        return $staffs;
    }


    ///////////////////////////////////////////////////////////////
    /////////////////////      (特有)扩展功能       /////////////////
    ///////////////////////////////////////////////////////////////

    /**
     * 通过部门id查找员工所属部门
     * 多对多: [员工] <--> [员工-部门] <--> [部门]
     * @param string $departmentId
     * @return array 返回员工对象数组
     */
    public function searchStaffs(string $departmentId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_department", "DepartmentId", $departmentId);
        $staffs = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $arr = $databaseProcess->searchByField("staff", "StaffId", $result[$i]["StaffId"]);
            $staffs[] = new Staff(
                $arr[0]["StaffId"],
                $arr[0]["StaffName"],
                $arr[0]["StaffPhone"],
                $arr[0]["StaffFileId"],
                $arr[0]["StaffPassword"],
            );
        }
        $databaseProcess->closeConnect();
        return $staffs;
    }

    /**
     * 建立和员工的联系
     * @param string $departmentId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function connectToDepartment(string $departmentId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "DepartmentId" => $departmentId,
            "StaffId" => $staffId
        );
        $result = $databaseProcess->insertValues("staff_department", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }


}