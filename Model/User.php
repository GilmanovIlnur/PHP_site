<?php


class User
{
    private $username;
    private $password;
    private $repeatedPassword;
    private $name;
    private $lastName;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $repeatedPassword
     * @param $name
     * @param $lastName
     */

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
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
    public function getRepeatedPassword()
    {
        return $this->repeatedPassword;
    }

    /**
     * @param mixed $repeatedPassword
     */
    public function setRepeatedPassword($repeatedPassword): void
    {
        $this->repeatedPassword = $repeatedPassword;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

}