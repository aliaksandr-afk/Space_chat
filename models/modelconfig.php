<?php

class modelconfig 
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = '';
    private $db_name = 'test';
    private $site_url="";


    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->db_host;
    }

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->db_user;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->db_password;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->site_url;
    }

}

