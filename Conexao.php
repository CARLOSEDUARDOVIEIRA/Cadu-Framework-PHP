<?php

/**
 * DESCRIÇÃO: Arquivo de conexão com o banco de dados mySQL - Classe abstrata (Não pode ser instânciada.)
 *
 * @author Desconhecido - Adaptado por Carlos Eduardo Vieira <cvieiraemail@gmail.com> 
 */
abstract class database {
    
    private static $dbtype   = "mysql";
    private static $host     = "localhost";
    private static $port     = "3306";
    private static $user     = "nome_usuario_banco";
    private static $password = "senha_banco_dados";
    private static $db       = "nome_banco_dados";
       
    //metodos para setar os dados
    private function getDBType()  {return self::$dbtype;}
    private function getHost()    {return self::$host;}
    private function getPort()    {return self::$port;}
    private function getUser()    {return self::$user;}
    private function getPassword(){return self::$password;}
    private function getDB()      {return self::$db;}
    
    private function __construct(){} 
    private function __clone(){} //Evita que a classe seja clonada
     
    //Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas
    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
    //Realiza a conexão com o banco de dados
    private function connect(){
        try
        {
            $this->conexao = new PDO($this->getDBType().":host=".$this->getHost().";port=".$this->getPort().";dbname=".$this->getDB(), $this->getUser(), $this->getPassword());
        }
        catch (PDOException $i)
        {
            //Exibe Exceção
            die("Erro:" . $i->getMessage() . "Erro de Conexão com o banco de dados");
        }
         
        return ($this->conexao);
    }
     
    private function disconnect(){
        $this->conexao = null;
    }

    /*SELECT retorna os valores em um vetor*/
    public function selectVetor($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->fetchAll(PDO::FETCH_ASSOC) or die(print_r($query->errorInfo(), true));
        return $rs;
    }

    /*SELECT: retorna os valores para um objeto e se nao passar uma classe como parametro retorna um array de objetos*/
    public function selectBD($sql,$params=null,$class=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
         
        if(isset($class)){
            $rs = $query->fetchAll(PDO::FETCH_CLASS,$class) or die(print_r($query->errorInfo(), true));
        }else{
            $rs = $query->fetchAll(PDO::FETCH_OBJ) or die(print_r($query->errorInfo(), true));
        }
        self::__destruct();
        return $rs;
    }
     
    /*INSERT: insere valores no banco de dados e retorna o último id inserido*/
    public function insertBD($sql,$params=null){
        $conexao=$this->connect();
        $query=$conexao->prepare($sql);
        $query->execute($params);
        $rs = $conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
     
    /*UPDATE: altera valores do banco de dados e retorna o número de linhas afetadas*/
    public function updateBD($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
     
    /*DELETE: excluí valores do banco de dados retorna o número de linhas afetadas*/
    public function deleteBD($sql,$params=null){
        $query=$this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
    
}

?>



