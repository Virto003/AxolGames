<?php
include_once 'Conectar.php';

class Jogo
{
    
    private $id;
    private $nome;
    private $link_jogo;
    private $descricao;
    private $lancamento;
    private $autor;
    private $creditos;
    private $img_capa;
    private $gif_preview;
    private $id_usuario;
    private $con;

    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getLink_jogo()
    {
        return $this->link_jogo;
    }

    function getDescricao()
    {
        return $this->descricao;
    }
    function getLancamento()
    {
        return $this->lancamento;
    }

    function getAutor()
    {
        return $this->autor;
    }
    function getCreditos() {
        return $this->creditos;
    }
    function getImg_capa()
    {
        return $this->img_capa;
    }
    function getGif_preview()
    {
        return $this->gif_preview;
    }
    function getId_usuario()
    {
        return $this->id_usuario;
    }



    function setId($id)
    {
        $this->id = $id;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setLink_jogo($link_jogo)
    {
        $this->link_jogo = $link_jogo;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setLancamento($lancamento) {
        $this->lancamento = $lancamento;
    }
    function setAutor($autor)
    {
        $this->autor = $autor;
    }

    function setCreditos($creditos)
    {
        $this->creditos = $creditos;
    }
    function setImg_capa($img_capa)
    {
        $this->img_capa = $img_capa;
    }
    function setGif_preview($gif_preview)
    {
        $this->gif_preview = $gif_preview;
    }
    function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("INSERT INTO jogo(id, nome, descricao, lancamento, autor, creditos, id_usuario) VALUES(?,?,?,?,?,?,?)");
            $sql->bindValue(1, $this->id, PDO::PARAM_STR);
            $sql->bindValue(2, $this->nome, PDO::PARAM_STR);
            $sql->bindValue(3, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(4, $this->lancamento);
            $sql->bindValue(5, $this->autor, PDO::PARAM_STR);
            $sql->bindValue(6, $this->creditos, PDO::PARAM_STR);
            $sql->bindValue(7, $this->id_usuario);

            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    } //salvar

    function editar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("UPDATE jogo SET nome = ?,
            descricao = ?,
            lancamento = ?,
            autor = ?,
            creditos = ? 
             WHERE id = ?");
            $sql->bindValue(1, $this->nome, PDO::PARAM_STR);
            $sql->bindValue(2, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(3, $this->lancamento);
            $sql->bindValue(4, $this->autor, PDO::PARAM_STR);
            $sql->bindValue(5, $this->creditos, PDO::PARAM_STR);
            $sql->bindValue(6, $this->id, PDO::PARAM_STR);


            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro ao editar " . $exc->getMessage();
        }
    } //salvar

    function consultar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * FROM jogo");
            if ($sql->execute() == 1) {
                return $sql->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar 1" . $exc->getMessage();
        }
    } //consultar

    function consultarPorID()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from jogo WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);

            return $sql->execute() == 1 ? $sql->fetchAll() : false;
        } catch (PDOException $exc) {
            echo "Erro ao consultar 2" . $exc->getMessage();
        }
    } //salvar
    function consultarPorNome()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from jogo WHERE nome = ?");
            $sql->bindValue(1, $this->nome, PDO::PARAM_STR);

            return $sql->execute() == 1 ? $sql->fetchAll() : false;
        } catch (PDOException $exc) {
            echo "Erro ao consultar 2" . $exc->getMessage();
        }
    } //salvar
    function consultarPorIdUsuario()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT * from jogo WHERE id_usuario = ?");
            $sql->bindValue(1, $this->id_usuario, PDO::PARAM_INT);

            return $sql->execute() == 1 ? $sql->fetchAll() : false;
        } catch (PDOException $exc) {
            echo "Erro ao consultar 3" . $exc->getMessage();
        }
    } //salvar


    function excluir()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare(" DELETE FROM imagens where id_jogo = ?;
             DELETE from jogo WHERE id = ?");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            $sql->bindValue(2, $this->id, PDO::PARAM_INT);

            
            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";
        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    } //salvar

}

//fim class
