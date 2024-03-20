
    <?php
    include_once 'Conectar.php';

    class Usuario
    {

        private $id;
        private $nome;
        private $email;
        private $blacklist;
        private $whitelist;
        private $con;

        function getId()
        {
            return $this->id;
        }
        function getNome()
        {
            return $this->nome;
        }
        function getEmail()
        {
            return $this->email;
        }
        function getWhitelist()
        {
            return $this->whitelist;
        }
        function getBlacklist()
        {
            return $this->blacklist;
        }



        function setId($id)
        {
            $this->id = $id;
        }
        function setNome($nome)
        {
            $this->nome = $nome;
        }
        function setEmail($email)
        {
            $this->email = $email;
        }
        function setBlacklist($blacklist)
        {
            $this->blacklist = $blacklist;
        }
        function setWhitelist($whitelist)
        {
            $this->whitelist = $whitelist;
        }



        function consultarPorId()
        {
            try {
                $this->con = new Conectar();
                $sql = $this->con->prepare("SELECT * from usuario WHERE id = ?");
                $sql->bindValue(1, $this->id, PDO::PARAM_INT);

                return $sql->execute() == 1 ? $sql->fetchAll() : false;
            } catch (PDOException $exc) {
                echo "Erro ao consultar 4" . $exc->getMessage();
            }
        }

        function consultar()
        {
            try {
                $this->con = new Conectar();
                $sql = $this->con->prepare("SELECT * from usuario");
                return $sql->execute() == 1 ? $sql->fetchAll() : false;
            } catch (PDOException $exc) {
                echo "Erro ao consultar 1" . $exc->getMessage();
            }
        }


    }

//fim class
