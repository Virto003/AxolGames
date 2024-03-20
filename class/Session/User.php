<?php
 namespace App\Session;

 class User{

    /**
     * metodo responsável por iniciar a sessão
     * @return boolean
     */
    private static function init(){
        return session_status() !== PHP_SESSION_ACTIVE ? session_start() : true;
    }

    /** 
     * Metodo responsável por definir a sessão de login
     * @param string $name
     * @param string $email
     * @param string $picture
     */
    public static function login($name, $email, $picture){

        self::init();
         
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'picture' => $picture
        ];
    }
    /**
     * Funcão responsável por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLogged(){
        self::init();

        return isset($_SESSION['user']);
    }
    /**
     * Funcão responsável por retornar as informações guardadas na sessão de usuário
     * @return array
     */
    public static function getInfo(){
        self::init();

        return $_SESSION['user'] ?? [];
    }

    public static function logout(){
        self::init();

        unset($_SESSION['user']);
    }
 }

?>