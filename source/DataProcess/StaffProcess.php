<?php

$dir = dirname(__FILE__);
require_once($dir."/../../source/DatabaseProcess.php");
require_once($dir."/../../source/Entity/Staff.php");
require_once($dir."/../../source/Entity/Department.php");
require_once($dir."/../../source/Entity/Project.php");
require_once($dir."/../../source/Entity/Task.php");

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
     * @return bool|mysqli_result
     */
    public function updateStaffByEntity(Staff $staff)
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->updateByArray("staff", $staff->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过员工的某个字段查找员工(们)的具体信息
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @return array
     */
    public function searchStaff(string $field, $value): array
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

    /**
     * 通过员工的某些字段查找员工(们)的具体信息
     * @param array $arr
     * @return array
     */
    public function searchStaffByEntity(array $arr): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByArray($arr);
        $databaseProcess->closeConnect();

        $staffs = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $staffs[] = new Staff(
                $result[$i]["StaffId"],
                $result[$i]["StaffName"],
                $result[$i]["StaffName"],
                $result[$i]["StaffFileId"],
                $result[$i]["StaffPassword"]
            );
        }
        return staffs;
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
            $tasks[] = new Task(
                $arr[0]["TaskId"],
                $arr[0]["TaskName"],
                $arr[0]["TaskRemark"],
                $arr[0]["TaskStartDate"],
                $arr[0]["TaskEndDate"]
            );
        }
        $databaseProcess->closeConnect();
        return $tasks;
    }

    /**
     * 获取用户所有的项目状态
     * @param string $staffId
     * @return array
     */
    public function getProjectStatus(string $staffId): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("staff_project", "StaffId", $staffId);
        $databaseProcess->closeConnect();
        return $result;
    }

    /**
     * 获取用户所有的任务状态
     * @param string $staffId
     * @return array
     */
    public function getTaskStatus(string $staffId): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("staff_task", "StaffId", $staffId);
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 设置项目状态
     * @param string $staffId
     * @param string $projectId
     * @param bool $status
     * @return bool|mysqli_result
     */
    public function setProjectStatus(string $staffId, string $projectId, bool $status = true)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "ProjectStatus" => ($status == true) ? 1 : 0,
        );

        $condition = array(
            "StaffId" => $staffId,
            "ProjectId" => $projectId
        );

        $result = $databaseProcess->updateByArray("staff_project", $arr, $condition);
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 设置任务状态
     * @param string $staffId
     * @param string $taskId
     * @param bool $status
     * @return bool|mysqli_result
     */
    public function setTaskStatus(string $staffId, string $taskId, bool $status = true)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "TaskStatus" => ($status == true) ? 1 : 0,
        );

        $condition = array(
            "StaffId" => $staffId,
            "TaskId" => $taskId
        );

        $result = $databaseProcess->updateByArray("staff_task", $arr, $condition);
        $databaseProcess->closeConnect();
        return $result;
    }

    /**
     * 建立和部门的联系
     * @param string $staffId
     * @param string $departmentId
     * @return bool|mysqli_result
     */
    public function connectToDepartment(string $staffId, string $departmentId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "StaffId" => $staffId,
            "DepartmentId" => $departmentId
        );
        $result = $databaseProcess->insertValues("staff_department", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 建立和项目的联系
     * @param string $staffId
     * @param string $projectId
     * @return bool|mysqli_result
     */
    public function connectToProject(string $staffId, string $projectId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "StaffId" => $staffId,
            "ProjectId" => $projectId,
            "ProjectStatus" => 1  //项目新建默认是1
        );
        $result = $databaseProcess->insertValues("staff_project", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 建立和任务的联系
     * @param string $staffId
     * @param string $taskId
     * @return bool|mysqli_result
     */
    public function connectToTask(string $staffId, string $taskId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "StaffId" => $staffId,
            "TaskId" => $taskId,
            "TaskStatus" => 1  //项目新建默认是1
        );
        $result = $databaseProcess->insertValues("staff_task", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }



    /**
     * @param string $departmentId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function disconnectToDepartment(string $departmentId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "DepartmentId" => $departmentId,
            "StaffId" => $staffId
        );
        return $databaseProcess->deleteByValues("staff_department", $arr);

    }

    /**
     * @param string $projectId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function disconnectToProject(string $projectId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "DepartmentId" => $projectId,
            "StaffId" => $staffId
        );
        return $databaseProcess->deleteByValues("staff_project", $arr);

    }

    /**
     * @param string $taskId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function disconnectToTask(string $taskId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "TaskId" => $taskId,
            "StaffId" => $staffId
        );
        return $databaseProcess->deleteByValues("staff_task", $arr);

    }
}