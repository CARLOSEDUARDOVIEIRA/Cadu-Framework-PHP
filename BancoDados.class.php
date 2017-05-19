<?php

/**
 * DESCRIÇÃO: Classe que implementa os métodos da classe DATABASE que por ser abstrata obriga as classes herdeiras a implementarem os seus métodos.
 *
 * @author Carlos Eduardo Vieira <cvieiraemail@gmail.com>
 */
require_once 'Conexao.php';

class BancoDados extends database {
    
//-----------------------------------Implementação das funções abstratas------------------    
    public function __construct() {}
	
    /**Método responsável por realizar um SELECT no banco de dados e trazer o resultado em um array.
    */
	public function selectVetor($sql, $params = null, $class = null){
        return parent::selectVetor($sql, $params, $class);
    }    

    /** Método responsável por realizar insert no banco de dados mySQL
     * @param String $sql - Variável com o comando SQL de INSERT para o banco de dados     
     * @return ultimo id inserido no banco de dados
     */
    public function insertBD($sql, $params = null) {
      return  parent::insertDB($sql, $params);
    }

    /** Método responsável por realizar SELECT no banco de dados 
      * @param null $class - Caso deseje especificar uma classe para receber o retorno, definido como null default.
     * @return resultado da pesquisa no banco de dados.
     */
    public function selectBD($sql, $params = null, $class = null) {
        return parent::selectDB($sql, $params, $class);
    }

    /** Metodo responsável por realizar UPDATE em uma tabela específica.     
     * @return numero de colunas afetadas durante a atualição
     */
    public function updateBD($sql, $params = null) {
        return parent::updateDB($sql, $params);
    }
    
    /** Método responsável por realizar DELETE no banco de dados    
     * @return número de linhas afetadas pela ação de deletar
     */
    public function deleteBD($sql, $params = null) {
        return parent::deleteDB($sql, $params);
    }    
}
