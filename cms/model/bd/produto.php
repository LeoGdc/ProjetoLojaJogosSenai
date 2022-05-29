<?php
/**************************************************************************
 * Objetivo: responsavel de manipular os dados dentro   BD 
 *              (insert,update,select e delete)
 * 
 * Autor: Leonardo
 * Data:29/05/2022
 * Versão: 1.0
 * 
 *************************************************************************/
//impor
require_once('conexaoMySql.php');
 //função para realizar o insert no BD
function insertProduto($dadosProduto){
    //abre a conexão com o BD
    $conexao = conexaoMysql();
    $sql = "insert into tblproduto
        (nome,
        descricao,
        foto,
        idcategorias,
    values
    ('".$dadosProduto['nome']."',
    '".$dadosProduto['descricao']."',
    '".$dadosProduto['foto']."',
    '".$dadosProduto['idcategorias']."');";

   
    //executa o script no BD
        //Validação para verificar  se o script sql esta correto
    if(mysqli_query($conexao, $sql))
    {
        //validação para ver se al inha for gravada no bd 
        if(mysqli_affected_rows($conexao))
        {
            fecharConexaoMySql($conexao);
            $statusResposta = true;
            }
            else{
                fecharConexaoMySql($conexao);
                $statusResposta = false;
            }
        }else{
            fecharConexaoMySql($conexao);
            $statusResposta = false;
        }

        fecharConexaoMySql($conexao);
        return $statusResposta;
        
    }

//função para realizar update no BD
function updateProduto($dadosProduto){
    $statusResposta =(boolean) false;
     //abre a conexão com o BD
     $conexao = conexaoMysql();
     $sql = "update tblproduto set
            nome       =   '".$dadosProduto['nome']."',
            descricao   =   '".$dadosProduto['descricao']."' ,
            foto    =   '".$dadosProduto['foto']."',
            idcategorias     =   '".$dadosProduto['idcategorias']."',
        where idproduto = ".$dadosProduto['id'];
         
   
     //executa o script no BD
         //Validação para verificar  se o script sql esta correto
     if(mysqli_query($conexao, $sql))
     {
         //validação para ver se al inha for gravada no bd 
         if(mysqli_affected_rows($conexao))
         {
             fecharConexaoMySql($conexao);
             $statusResposta = true;
             }
             else{
                 fecharConexaoMySql($conexao);
                 $statusResposta = false;
             }
         }else{
             fecharConexaoMySql($conexao);
             $statusResposta = false;
         }
 
         fecharConexaoMySql($conexao);
         return $statusResposta;
         
}
//função para realizar delete no BD
function deleteProduto($id){

    //abre a conexão com o BD
    $conexao = conexaoMysql();
    
    //Script para deletar um resgistro no bd 
    $sql = "delete from tblproduto where idproduto=".$id;

    //valida se o script esta correto, sem erro de sixtaxe e executa o BD
    if(mysqli_query($conexao, $sql)){

        //valida se o BD teve sucesso na execução do script
        if(mysqli_affected_rows($conexao))
        $statusResposta =true;
    }

    //fecha a conexão com o BD mySql
    fecharConexaoMySql($conexao);

    return $statusResposta;
  

}
//função para listar todos os contatos do BD
function selectAllProduto(){
    //Abre as conexão com o BD
    $conexao = conexaoMysql();
    //Script para listar todos os dados no BD
    $sql = "select * from tblProduto order by idproduto desc";
    //Executa o script sql no BD e guarda o retorno dos dados, se houver 
    $result = mysqli_query($conexao, $sql);
    //valida se o BD retornou os registro
    if($result){
        //mysqli_fetch_assoc() - permite converter os dados do BD em array de manipulação no PHP
        //Nesta, repetição estamos, convertendo os dados do BD em um Array ($rsDados) , além de
        // o proprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a repetição
        $cont = 0;
        while($rsDados = mysqli_fetch_assoc($result)){
            //Criar um array com os dados BD
                $arrayDados{$cont} = array(
                    "id"        => $rsDados['idproduto'],
                    "nome"      => $rsDados['nome'],
                    "descricao"  => $rsDados['descricao'],
                    "foto"   => $rsDados['foto'],
                    "idcategorias"     => $rsDados['idcategorias']
                );
            $cont++;
         }
            //solicita o fechamento da conexão com o BD
            fecharConexaoMySql($conexao);
            if(isset($arrayDados))
                return $arrayDados;
            else 
                return false;
    }
}
//função para buscar um contato no BD atraves do id do registro
function selectByIdProduto($id){
    
     //Abre as conexão com o BD
     $conexao = conexaoMysql();
     //Script para listar todos os dados no BD
     $sql = "select * from tblproduto where idproduto =".$id;
     //Executa o script sql no BD e guarda o retorno dos dados, se houver 
     $result = mysqli_query($conexao, $sql);
     //valida se o BD retornou os registro
     if($result){
         //mysqli_fetch_assoc() - permite converter os dados do BD em array de manipulação no PHP
         //Nesta, repetição estamos, convertendo os dados do BD em um Array ($rsDados) , além de
         // o proprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a repetição
         
         if($rsDados = mysqli_fetch_assoc($result)){
             //Criar um array com os dados BD
                 $arrayDados = array(
                     "id"       => $rsDados['idproduto'],
                     "nome"     => $rsDados['nome'],
                     "descricao" => $rsDados['descricao'],
                     "foto"  => $rsDados['foto'],
                     "idcategorias"    => $rsDados['idcategorias']
                 );
          }
             //solicita o fechamento da conexão com o BD
             fecharConexaoMySql($conexao);
 
             return $arrayDados;
     }
}
?>