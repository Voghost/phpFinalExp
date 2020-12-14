<?php


class Project
{
    private $projectId;      //项目编号
    private $projectName;    //项目名
    private $projectPathId;  //项目地址
    private $projectRemark;  //项目描述

    /**
     * Project constructor.
     * @param $projectId
     * @param $projectName
     * @param $projectPathId
     * @param $projectRemark
     */
    public function __construct($projectId, $projectName, $projectPathId, $projectRemark)
    {
        $this->projectId = $projectId;
        $this->projectName = $projectName;
        $this->projectPathId = $projectPathId;
        $this->projectRemark = $projectRemark;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return mixed
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @param mixed $projectName
     */
    public function setProjectName($projectName): void
    {
        $this->projectName = $projectName;
    }

    /**
     * @return mixed
     */
    public function getProjectPathId()
    {
        return $this->projectPathId;
    }

    /**
     * @param mixed $projectPathId
     */
    public function setProjectPathId($projectPathId): void
    {
        $this->projectPathId = $projectPathId;
    }

    /**
     * @return mixed
     */
    public function getProjectRemark()
    {
        return $this->projectRemark;
    }

    /**
     * @param mixed $projectRemark
     */
    public function setProjectRemark($projectRemark): void
    {
        $this->projectRemark = $projectRemark;
    }

    public function getArray(): array
    {
        return array(
            "ProjectId" => $this->projectId,
            "ProjectName" => $this->projectName,
            "ProjectPathId" => $this->projectPathId,
            "ProjectRemark" => $this->projectRemark,
        );
    }
}