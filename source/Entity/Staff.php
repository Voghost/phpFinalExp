<?php

class Staff
{
    public string $userName = "test";  //用户名
    public $password;  //密码
    public $phoneNum;

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    /**
     * @param mixed $phoneNum
     */
    public function setPhoneNum($phoneNum): void
    {
        $this->phoneNum = $phoneNum;
    } //手机号




}