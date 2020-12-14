<?php

class Staff
{
    private $staffId;           //用户id
    private $staffName;         //用户名
    private $staffPhone;        //用户电话
    private $staffFileId;       //用户文件id
    private $staffPassword;     //用户密码

    /**
     * Staff constructor.
     * @param $staffId
     * @param $staffName
     * @param $staffPhone
     * @param $staffFileId
     * @param $staffPassword
     */
    public function __construct($staffId, $staffName, $staffPhone, $staffFileId, $staffPassword)
    {
        $this->staffId = $staffId;
        $this->staffName = $staffName;
        $this->staffPhone = $staffPhone;
        $this->staffFileId = $staffFileId;
        $this->staffPassword = $staffPassword;
    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staffId;
    }

    /**
     * @param mixed $staffId
     */
    public function setStaffId($staffId): void
    {
        $this->staffId = $staffId;
    }

    /**
     * @return mixed
     */
    public function getStaffName()
    {
        return $this->staffName;
    }

    /**
     * @param mixed $staffName
     */
    public function setStaffName($staffName): void
    {
        $this->staffName = $staffName;
    }

    /**
     * @return mixed
     */
    public function getStaffPhone()
    {
        return $this->staffPhone;
    }

    /**
     * @param mixed $staffPhone
     */
    public function setStaffPhone($staffPhone): void
    {
        $this->staffPhone = $staffPhone;
    }

    /**
     * @return mixed
     */
    public function getStaffFileId()
    {
        return $this->staffFileId;
    }

    /**
     * @param mixed $staffFileId
     */
    public function setStaffFileId($staffFileId): void
    {
        $this->staffFileId = $staffFileId;
    }

    /**
     * @return mixed
     */
    public function getStaffPassword()
    {
        return $this->staffPassword;
    }

    /**
     * @param mixed $staffPassword
     */
    public function setStaffPassword($staffPassword): void
    {
        $this->staffPassword = $staffPassword;
    }




    /**
     * 将类转化为键值对
     */

    public function getArray(): array
    {
        return array(
            "StaffId" => $this->staffId,
            "StaffName" => $this->staffName,
            "StaffPhone" => $this->staffPhone,
            "StaffFileId" => $this->staffFileId,
            "StaffPassword" => $this->staffPassword
        );
    }
}