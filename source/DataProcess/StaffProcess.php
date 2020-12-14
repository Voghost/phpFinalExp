<?php
require_once("source/DatabaseProcess.php");
require_once("source/Entity/Staff.php");

/**
 * 用于处理用户数据的类
 * Class StaffProcess
 */
class StaffProcess
{
    ///////////////////////////////////////////////////////////////
    /////////////////////      基本增删改查    //////////////////////
    ///////////////////////////////////////////////////////////////


    /**
     * 新建一条员工数据 (通过Staff对象)
     * @param Staff $staff
     */
    public function insertStaff(Staff $staff)
    {
        $databaseProcess = new DatabaseProcess();
        $maxStaffId = $databaseProcess->searchMax("staff", "StaffId");

        //字符串自加1
        $num = (int)substr($maxStaffId, 1);
        $num = $num + 100001;
        $maxStaffId = "S".substr($num,1); //S -> staff 表示员工

        $staff->setStaffId($maxStaffId);

        $databaseProcess->insertValues("staff", $staff->getArray());
        $databaseProcess->closeConnect();
    }


    /**
     * 通过员工id删除数据
     * @param string $staffId 员工id
     */
    public function deleteStaffById(string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("staff", "StaffId", $staffId);
    }


    /**
     * 只更新某个字段
     * @param string $staffId 员工的id
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateStaffById(string $staffId, string $key, string $value)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("staff", "StaffId", $staffId, $key, $value);
        $databaseProcess->closeConnect();
    }


    /**
     * 通过Staff对象实体更新
     * @param Staff $staff 需要更改的对象
     */
    public function updateStaffByEntity(Staff $staff)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByArray("staff", $staff->getArray());
        $databaseProcess->closeConnect();
    }


    /**
     * 通过员工的某个字段查找员工(们)的具体信息
     * @param string $field 字段名
     * @param string $value 字段值
     * @return array
     */
    public function searchStaff(string $field, string $value): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("staff", $field, $value);
        $databaseProcess->closeConnect();

        $staffs = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $staffs[] = new Staff($result[$i]["StaffId"],
                $result[$i]["StaffName"],
                $result[$i]["StaffPhone"],
                $result[$i]["StaffFileId"],
                $result[$i]["StaffPassword"]);
        }
        return $staffs;
    }



    ///////////////////////////////////////////////////////////////
    /////////////////////      (特有)扩展功能       /////////////////
    ///////////////////////////////////////////////////////////////

    /**
     * 通过员工id查找员工所属部门
     * 多对多: [员工] <--> [员工-部门] <--> [部门]
     * @param string $staffId 员工id
     */
    public function searchDepartment(string $staffId)
    {
        $databaseProcess = new DatabaseProcess();

        $department = $databaseProcess->searchByField("staff_department", "StaffId", "");

    }


}