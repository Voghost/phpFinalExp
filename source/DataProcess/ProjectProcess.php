<?php
require_once("source/DatabaseProcess.php");
require_once("source/Entity/Staff.php");
require_once("source/Entity/Department.php");
require_once("source/Entity/Project.php");
require_once("source/Entity/Task.php");

class ProjectProcess
{
    /**
     * 新建一条项目数据 (通过Project对象)
     * @param Project $project
     */
    public function insertProject(Project $project)
    {
        $databaseProcess = new DatabaseProcess();
        $maxProjectId = $databaseProcess->searchMax("project", "ProjectId");

        //字符串自加1
        $num = (int)substr($maxProjectId, 1);
        $num = $num + 100001;
        $maxProjectId = "P" . substr($num, 1); //P -> project 表示项目

        $project->setProjectId($maxProjectId);

        $databaseProcess->insertValues("project", $project->getArray());
        $databaseProcess->closeConnect();

    }


    /**
     * 通过项目id删除数据
     * @param string $projectId
     */
    public function deleteProjectById(string $projectId)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("project", "StaffId", $projectId);
    }


    /**
     * 只更新某个字段
     * @param string $projectId
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateProjectById(string $projectId, string $key, string $value)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("staff", "StaffId", $projectId, $key, $value);
        $databaseProcess->closeConnect();
    }


    /**
     * 通过Project对象实体更新
     * @param Project $project
     * @return bool|mysqli_result
     */
    public function updateProjectByEntity(Project $project)
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->updateByArray("project", $project->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过项目的某个字段查找项目(们)的具体信息
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @return array
     */
    public function searchProject(string $field, $value): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("project", $field, $value);
        $databaseProcess->closeConnect();

        $projects = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $projects[] = new Project($result[$i]["ProjectId"],
                $result[$i]["ProjectName"],
                $result[$i]["ProjectPathId"],
                $result[$i]["ProjectRemark"]);
        }
        return $projects;
    }

    ///////////////////////////////////////////////////////////////
    /////////////////////      (特有)扩展功能       /////////////////
    ///////////////////////////////////////////////////////////////

    /**
     * 通过项目id查找员工
     * 多对多: [员工] <--> [员工-项目] <--> [项目]
     * @param string $projectId
     * @return array 返回员工对象数组
     */
    public function searchStaffs(string $projectId): array
    {
        $databaseProcess = new DatabaseProcess();

        $result = $databaseProcess->searchByField("staff_project", "ProjectId", $projectId);
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
     * @param string $projectId
     * @param string $staffId
     * @return bool|mysqli_result
     */
    public function connectToProject(string $projectId, string $staffId)
    {
        $databaseProcess = new DatabaseProcess();
        $arr = array(
            "ProjectId" => $projectId,
            "StaffId" => $staffId
        );
        $result = $databaseProcess->insertValues("staff_project", $arr);
        $databaseProcess->closeConnect();
        return $result;
    }
}