<?php
$dir = dirname(__FILE__);
require_once($dir."/../../source/DatabaseProcess.php");
require_once($dir."/../../source/Entity/Staff.php");
require_once($dir."/../../source/Entity/Department.php");
require_once($dir."/../../source/Entity/Project.php");
require_once($dir."/../../source/Entity/Task.php");

class TaskProcess
{
    /**
     * 新建一条任务数据 (通过Task对象)
     * @param Task $task
     */
    public function insertTask(Task $task)
    {
        $databaseProcess = new DatabaseProcess();
        $maxTaskId = $databaseProcess->searchMax("task", "TaskId");

        //字符串自加1
        $num = (int)substr($maxTaskId, 1);
        $num = $num + 100001;
        $maxTaskId = "T" . substr($num, 1); //T -> task 表示任务

        $task->setTaskId($maxTaskId);

        $databaseProcess->insertValues("task", $task->getArray());
        $databaseProcess->closeConnect();

    }


    /**
     * 通过任务id删除数据
     * @param string $taskId
     */
    public function deleteTaskById(string $taskId)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("task", "TaskId", $taskId);
    }


    /**
     * 只更新某个字段
     * @param string $taskId
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateTaskById(string $taskId, string $key, string $value)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("task", "TaskId", $taskId, $key, $value);
        $databaseProcess->closeConnect();
    }


    /**
     * 通过Task对象实体更新
     * @param Task $task
     * @return bool|mysqli_result
     */
    public function updateTaskByEntity(Task $task)
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->updateByArray("task", $task->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过任务的某个字段查找任务(们)的具体信息
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @return array
     */
    public function searchTask(string $field, $value): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("task", $field, $value);
        $databaseProcess->closeConnect();

        $tasks = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $tasks[] = new Task($result[$i]["TaskId"],
                $result[$i]["TaskName"],
                $result[$i]["TaskRemark"],
                $result[$i]["TaskStartDate"],
                $result[$i]["TaskEndDate"]);
        }
        return $tasks;
    }

    /**
     * 通过任务的某些字段查找任务(们)的具体信息
     * @param array $arr
     * @return array
     */
    public function searchTaskByEntity(array $arr): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByArray($arr);
        $databaseProcess->closeConnect();

        $tasks = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $tasks[] = new Task(
                $result[$i]["TaskId"],
                $result[$i]["TaskName"],
                $result[$i]["TaskRemark"],
                $result[$i]["TaskStartDate"],
                $result[$i]["TaskEndDate"]
            );
        }
        return $tasks;
    }

    ///////////////////////////////////////////////////////////////
    /////////////////////      (特有)扩展功能       /////////////////
    ///////////////////////////////////////////////////////////////

    /**
     * 通过任务id查找员工
     * 多对多: [员工] <--> [员工-任务] <--> [任务]
     * @param string $taskId
     * @return array 返回员工对象数组
     */
    public function searchStaffs(string $taskId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_task", "TaskId", $taskId);
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
     * @param string $taskId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function connectToTask(string $taskId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "TaskId" => $taskId,
            "StaffId" => $staffId
        );
        $result = $databaseProcess->insertValues("staff_task", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }

    /**
     * @param string $taskId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function disconnectToStaff(string $taskId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "TaskId" => $taskId,
            "StaffId" => $staffId
        );
        return $databaseProcess->deleteByValues("staff_task", $arr);

    }
}