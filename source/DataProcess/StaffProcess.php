<?php
require_once("source/DatabaseProcess.php");
require_once("source/Entity/Staff.php");
require_once("source/Entity/Department.php");
require_once("source/Entity/Project.php");

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
        $maxStaffId = "S" . substr($num, 1); //S -> staff 表示员工

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
     * @return array 返回部门对象数组
     */
    public function searchDepartments(string $staffId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_department", "StaffId", $staffId);
        $departments = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $arr = $databaseProcess->searchByField("department", "DepartmentId", $result[$i]["DepartmentId"]);
            $departments[] = new Department(
                $arr[0]["DepartmentId"],
                $arr[0]["DepartmentName"],
                $arr[0]["DepartmentAddress"]
            );
        }
        $databaseProcess->closeConnect();
        return $departments;
    }

    /**
     * 通过员工id查找员工拥有项目
     * 多对多: [员工] <--> [员工-项目] <--> [项目]
     * @param string $staffId 员工id
     * @return array 返回项目对象数组
     */
    public function searchProjects(string $staffId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_project", "StaffId", $staffId);
        $projects = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $arr = $databaseProcess->searchByField("project", "ProjectId", $result[$i]["ProjectId"]);
            $projects[] = new Project(
                $arr[0]["ProjectId"],
                $arr[0]["ProjectName"],
                $arr[0]["ProjectPathId"],
                $arr[0]["ProjectRemark"]
            );
        }
        $databaseProcess->closeConnect();
        return $projects;
    }

    /**
     * 通过员工id查找员工拥有任务
     * 多对多: [员工] <--> [员工-任务] <--> [任务]
     * @param string $staffId 员工id
     * @return array 返回任务对象数组
     */
    public function searchTasks(string $staffId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_task", "StaffId", $staffId);
        $tasks = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $arr = $databaseProcess->searchByField("task", "TaskId", $result[$i]["TaskId"]);
            $projects[] = new Project(
                $arr[0]["TaskId"],
                $arr[0]["TaskName"],
                $arr[0]["TaskRemark"],
                $arr[0]["Task"]
            );
        }
        return $projects;
    }
}