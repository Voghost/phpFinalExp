<?php


class Folder
{
    private $FolderId;        //文件编号
    private $FolderPath;      //文件路径
    private $FolderRemark;    //文件描述

    /**
     * Folder constructor.
     * @param $FolderId
     * @param $FolderPath
     * @param $FolderRemark
     */
    public function __construct($FolderId, $FolderPath, $FolderRemark)
    {
        $this->FolderId = $FolderId;
        $this->FolderPath = $FolderPath;
        $this->FolderRemark = $FolderRemark;
    }

    /**
     * @return mixed
     */
    public function getFolderId()
    {
        return $this->FolderId;
    }

    /**
     * @param mixed $FolderId
     */
    public function setFolderId($FolderId): void
    {
        $this->FolderId = $FolderId;
    }

    /**
     * @return mixed
     */
    public function getFolderPath()
    {
        return $this->FolderPath;
    }

    /**
     * @param mixed $FolderPath
     */
    public function setFolderPath($FolderPath): void
    {
        $this->FolderPath = $FolderPath;
    }

    /**
     * @return mixed
     */
    public function getFolderRemark()
    {
        return $this->FolderRemark;
    }

    /**
     * @param mixed $FolderRemark
     */
    public function setFolderRemark($FolderRemark): void
    {
        $this->FolderRemark = $FolderRemark;
    }

    public function getArray(): array
    {
        return array(
            "FolderId" => $this->FolderId,
            "FolderPath" => $this->FolderPath,
            "FolderRemark" => $this->FolderRemark
        );
    }
}