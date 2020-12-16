<?php

$dir = dirname(__FILE__);
require_once($dir."/../../source/DatabaseProcess.php");
require_once($dir."/../../source/Entity/Staff.php");
require_once($dir."/../../source/Entity/Department.php");
require_once($dir."/../../source/Entity/Project.php");
require_once($dir."/../../source/Entity/Task.php");

class FolderProcess
{
    /**
     * 新建一条文件数据 (通过Folder对象)
     * @param Folder $folder
     */
    public function insertFolder(Folder $folder)
    {
        $databaseProcess = new DatabaseProcess();
        $maxFolderId = $databaseProcess->searchMax("folder", "FolderId");

        //字符串自加1
        $num = (int)substr($maxFolderId, 1);
        $num = $num + 100001;
        $maxFolderId = "F" . substr($num, 1); //F -> folder 表示文件

        $folder->setFolderId($maxFolderId);

        $databaseProcess->insertValues("folder", $folder->getArray());
        $databaseProcess->closeConnect();

    }


    /**
     * 通过文件id删除数据
     * @param string $folderId
     */
    public function deleteFolderById(string $folderId)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->deleteByField("folder", "FolderId", $folderId);
    }


    /**
     * 只更新某个字段
     * @param string $folderId
     * @param string $key 要修改的字段
     * @param string $value 要修改的字段值
     */
    public function updateFolderById(string $folderId, string $key, string $value)
    {
        $databaseProcess = new DatabaseProcess();
        $databaseProcess->updateByField("folder", "FolderId", $folderId, $key, $value);
        $databaseProcess->closeConnect();
    }


    /**
     * 通过Staff对象实体更新
     * @param Folder $folder
     * @return bool|mysqli_result
     */
    public function updateFolderByEntity(Folder $folder)
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->updateByArray("folder", $folder->getArray());
        $databaseProcess->closeConnect();
        return $result;
    }


    /**
     * 通过员工的某个字段查找员工(们)的具体信息
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @return array
     */
    public function searchFolder(string $field, $value): array
    {
        $databaseProcess = new DatabaseProcess();
        $result = $databaseProcess->searchByField("folder", $field, $value);
        $databaseProcess->closeConnect();

        $folders = array();
        for ($i = 0; $i < count($result, 0); $i++) {
            $folders[] = new Folder($result[$i]["FolderId"],
                $result[$i]["FolderPath"],
                $result[$i]["FolderRemark"]);
        }
        return $folders;
    }


}
