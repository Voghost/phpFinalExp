<?php


class Task
{
    private $taskId;
    private $taskName;
    private $taskRemark;
    private $taskStartDate;
    private $taskEndDate;

    /**
     * Task constructor.
     * @param $taskId
     * @param $taskName
     * @param $taskRemark
     * @param $taskStartDate
     * @param $taskEndDate
     */
    public function __construct($taskId, $taskName, $taskRemark, $taskStartDate, $taskEndDate)
    {
        $this->taskId = $taskId;
        $this->taskName = $taskName;
        $this->taskRemark = $taskRemark;
        $this->taskStartDate = $taskStartDate;
        $this->taskEndDate = $taskEndDate;
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param mixed $taskId
     */
    public function setTaskId($taskId): void
    {
        $this->taskId = $taskId;
    }

    /**
     * @return mixed
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * @param mixed $taskName
     */
    public function setTaskName($taskName): void
    {
        $this->taskName = $taskName;
    }

    /**
     * @return mixed
     */
    public function getTaskRemark()
    {
        return $this->taskRemark;
    }

    /**
     * @param mixed $taskRemark
     */
    public function setTaskRemark($taskRemark): void
    {
        $this->taskRemark = $taskRemark;
    }

    /**
     * @return mixed
     */
    public function getTaskStartDate()
    {
        return $this->taskStartDate;
    }

    /**
     * @param mixed $taskStartDate
     */
    public function setTaskStartDate($taskStartDate): void
    {
        $this->taskStartDate = $taskStartDate;
    }

    /**
     * @return mixed
     */
    public function getTaskEndDate()
    {
        return $this->taskEndDate;
    }

    /**
     * @param mixed $taskEndDate
     */
    public function setTaskEndDate($taskEndDate): void
    {
        $this->taskEndDate = $taskEndDate;
    }

    public function getArray(): array
    {
        return array(
            "TaskId" => $this->taskId,
            "TaskName" => $this->taskName,
            "TaskRemark" => $this->taskRemark,
            "TaskStartDate" => $this->taskStartDate,
            "TaskEndDate" => $this->taskEndDate
        );
    }
}