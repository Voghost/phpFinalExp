<?php
require_once("source/DatabaseProcess.php");
require_once("source/Entity/Staff.php");

/**
 * 用于处理用户数据的类
 * Class StaffProcess
 */
class StaffProcess
{
    /**
     * 新建一条员工数据
     * @param Staff $staff
     */
    public function insertStaff(Staff $staff)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->insertValues($staff, $staff->getArray());
        $databaseProcess->closeConnect();
    }


    /**
     * 通过员工id删除数据
     * @param string $staffId 员工id
     */
    public function deleteStaffById(string $staffId){
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("staff","StaffId",$staffId);
    }


    /**
     * 只更新某个字段
     * @param string $staffId 员工的id
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateStaffById(string $staffId,string $key,string $value){
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("staff","StaffId",$staffId,$key,$value);
        $databaseProcess->closeConnect();
    }


    /**
     * 更新全部字段
     * @param Staff $staff
     */
    public function updateStaff(Staff $staff){

    }


}