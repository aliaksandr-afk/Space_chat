<?php
/** @uses modelconfig */

class modelmessages
{
    protected $db;
    protected $config;
    protected $seesionId;
    protected $isAdmin;

    public function __construct()
    {
        //инициализация класса конфигурации
        $this->config = new modelconfig();
        $cf = $this->config;

        //инициализация инстанса базы данных
        $this->db = mysqli_connect($cf->getDbHost(),
            $cf->getDbUser(),
            $cf->getDbPassword(),
            $cf->getDbName());

        if ($this->db->connect_errno) {
            printf("Не удалось подключиться: %s\n", $this->db->connect_error);
            exit();
        }

        //поверка сессии, если данных нет, регистрируем пользователя в _sessionInit()
        if ( isset($_SESSION['id']) ){
            $this->seesionId = (int)$_SESSION['id'];
        } else {
            $this->seesionId = $this->_sessionInit();
            $_SESSION['id'] = $this->seesionId ;
        }

        //проверка регистрации админа
        if($this->_checkIfAdmin()){
            $this->isAdmin = true;
        } else {
            $this->isAdmin = false;
        }

    }

    private function _sessionInit(){
        $result = $this->db
            ->query("INSERT INTO `users`(`name`,`email`,`password`) VALUES ('guest','','')");
        if ($result === false ){
            die('Не прошёл запрос к бд' . $this->db->error );
        }
        return $this->db->insert_id;
    }

    private function _checkIfAdmin(){
        $hasEmail = $this->db
            ->query("SELECT `email` FROM `users` WHERE `id`='{$_SESSION['id']}'")
            ->fetch_assoc();
        if(true){
            return true;
        }
        return  false;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @return mixed
     */
    public function getSeesionId()
    {
        return $this->seesionId;
    }

    /**
     * @param mixed $seesionId
     */
    public function setSeesionId($seesionId)
    {
        $this->seesionId = $seesionId;
        $_SESSION['id'] = $seesionId;

        if ($this->_checkIfAdmin() === true ){
            $this->isAdmin = true;
        }
    }

    public function getUserList(): array
    {
        $result = $this->db
            ->query("SELECT * FROM `users`")
            ->fetch_all(MYSQLI_ASSOC);
        if ($result === false ){
            die('Не прошёл запрос к бд' . $this->db->error );
        }
        return $result;
    }

    public function getMessages(){
        $result = $this->db
            ->query("SELECT * FROM `commonmessages`")
            ->fetch_all(MYSQLI_ASSOC);
        if ($result === false ){
            die('Не прошёл запрос к бд' . $this->db->error );
        }
        return $result;
    }

    public function deleteMessage(int $messageId)
    {
        $result = $this->db
            ->query("DELETE FROM `commonmessages` WHERE `id`=$messageId");
        if ($result === false ){
            die('Не прошло удаление ' . $this->db->error );
        }
        return true;
    }

    public function addMessage(int $userId, string $message)
    {
        $result = $this->db
            ->query("INSERT INTO `commonmessages`(`userid`, `message`) VALUES ($userId, '$message')" );
        if ($result === false ){
            die('Не удалось добавить сообщение ' . $this->db->error );
        }
        return true;
    }

    public function loginUser(string $email, string $password)
    {
        $result = $this->db
            ->query( "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'")
            ->fetch_array();
        if (count($result) > 0){
            return $result;
        }
        return false;
    }

    public function logout()
    {
        unset($this->seesionId);
        $this->isAdmin = false;
        unset($_SESSION['id']);
        unset($_COOKIE['']);
    }
}