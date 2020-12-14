<?php


class Department
{
    private $departmentId;       //部门编号
    private $departmentName;     //部门名称
    private $departmentAddress;  //部门地址

    /**
     * Department constructor.
     * @param $departmentId
     * @param $departmentName
     * @param $departmentAddress
     */
    public function __construct($departmentId, $departmentName, $departmentAddress)
    {
        $this->departmentId = $departmentId;
        $this->departmentName = $departmentName;
        $this->departmentAddress = $departmentAddress;
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param mixed $departmentId
     */
    public function setDepartmentId($departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return mixed
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * @param mixed $departmentName
     */
    public function setDepartmentName($departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    /**
     * @return mixed
     */
    public function getDepartmentAddress()
    {
        return $this->departmentAddress;
    }

    /**
     * @param mixed $departmentAddress
     */
    public function setDepartmentAddress($departmentAddress): void
    {
        $this->departmentAddress = $departmentAddress;
    }

    public function getArray(): array
    {
        return array(
            "DepartmentId" => $this->departmentId,
            "DepartmentName" => $this->departmentName,
            "DepartmentAddress" => $this->departmentAddress
        );
    }
}