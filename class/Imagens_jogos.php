<?php

include_once 'Conectar.php';

class Imagem
{
    private $id_img;
    private $id_jogo;
    private $descricao;
    private $imagem_jogo;
    private $gif_preview;
    private $con;

    function getId_img()
    {
        return $this->id_img;
    }
    function getId_jogo()
    {
        return $this->id_jogo;
    }
    function getImagem_jogo()
    {
        return $this->imagem_jogo;
    }

    function setId_img($id_img)
    {
        $this->id_img = $id_img;
    }
    function setId_jogo($id_jogo)
    {
        $this->id_jogo = $id_jogo;
    }
    function setImagem_jogo($imagem_jogo)
    {
        $this->imagem_jogo = $imagem_jogo;
    }
   
    function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("CALL salvar_categoria(?,?,?);");
            $sql->bindValue(1, $this->id, PDO::PARAM_INT);
            $sql->bindValue(2, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(3, $this->video, PDO::PARAM_STR);

            if ($sql->execute() == 1) {
                return "cadastrado";
            } else {
                return "erro";
            }
        } catch (PDOException $exc) {
            echo "Erro ao salvar " . $exc->getMessage();
        }
    } //salvar

    function editar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("UPDATE jogos SET nome = ?,
            link_jogo = ?,
            descricao = ?,
            lancamento = ?,
            autor = ?,
            creditos = ?,
            img_capa = ?,
            gif_preview  = ?
             WHERE id = ?");
            $sql->bindValue(1, $this->nome, PDO::PARAM_STR);
            $sql->bindValue(2, $this->link_jogo, PDO::PARAM_STR);
            $sql->bindValue(3, $this->descricao, PDO::PARAM_STR);
            $sql->bindValue(4, $this->lancamento, PDO::PARAM_STR);
            $sql->bindValue(5, $this->autor, PDO::PARAM_STR);
            $sql->bindValue(6, $this->creditos, PDO::PARAM_STR);
            $sql->bindValue(7, $this->img_capa);
            $sql->bindValue(8, $this->gif_preview);
            $sql->bindValue(9, $this->id, PDO::PARAM_STR);


            return $sql->execute() == 1 ? TRUE : FALSE;
        } catch (PDOException $exc) {
            echo "Erro ao editar " . $exc->getMessage();
        }
    } //salvar

    function consultar()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("SELECT i.*, j.* "
            . "FROM imagens i, jogo j "
            . "WHERE i.id_jogo = j.id "
            . "AND i.id_jogo = ?");
            $sql->bindValue(1, $this->id_jogo, PDO::PARAM_INT);
            if ($sql->execute() == 1) {
                return $sql->fetchAll();
            } else {
                return false;
            }

        } catch (PDOException $exc) {
            echo "Erro ao consultar " . $exc->getMessage();
        }
    } //consultar

    function excluir()
    {
        try {
            $this->con = new Conectar();
            $sql = $this->con->prepare("DELETE FROM imagens WHERE id_img = ?");
            $sql->bindValue(1, $this->id_img, PDO::PARAM_INT);

            return $sql->execute() == 1 ? "Excluído com sucesso" : "Erro ao excluir";
        } catch (PDOException $exc) {
            echo "Erro ao excluir" . $exc->getMessage();
        }
    } //salvar

}

//fim class
