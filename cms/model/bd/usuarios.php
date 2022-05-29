<?php
/**************************************************************************
 * Objetivo: responsavel de manipular os dados dentro   BD 
 *              (insert,update,select e delete)
 * 
 * Autor: Leonardo
 * Data:5/09/2022
 * Versão: 1.0
 * 
 *************************************************************************/

 //impor

 require_once('conexaoMySql.php');

function insertUsuario($dadosUsuario){

    
    $conexao =conexaoMysql();

    $sql = "insert into tblusuarios
            (nome,
            usuario,
            email,
            senha)
        values
        ('".$dadosUsuario['nome']."',
        '".$dadosUsuario['usuario']."',
        '".$dadosUsuario['email']."',
        '".$dadosUsuario['senha']."');";


    
    if(mysqli_query($conexao, $sql)){

        if(mysqli_affected_rows($conexao)){
           
            $statusResposta = true;
        }
        else{
            
            $statusResposta = false;
        }
    }else{
       
        $statusResposta = false;
    }
        fecharConexaoMySql($conexao);
        return $statusResposta;


}
function updateUsuario($dadosUsuario){
    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();
    $sql = "update tblusuarios set 
            nome  = '".$dadosUsuario['nome']."',
            usuario = '".$dadosUsuario['usuario']."',
            email = '".$dadosUsuario['email']."',
            senha = '".$dadosUsuario['senha']."'
        where idusuario = ".$dadosUsuario['id'];


        
        if(mysqli_query($conexao, $sql))
        {
            //validação para ver se al inha for gravada no bd 
            if(mysqli_affected_rows($conexao))
            {
                
                $statusRespota = true;
                }
                else{
                    
                    $statusRespota = false;
                }
            }else{
               
                $statusRespota = false;
            }
    
            fecharConexaoMySql($conexao);
            return $statusRespota;

}
function deleteUsuario($id){
     $conexao = conexaoMysql();

     $sql = "delete from tblusuarios where idusuario=".$id;

         //valida se o script esta correto, sem erro de sixtaxe e executa o BD
         if(mysqli_query($conexao, $sql)){
            if(mysqli_affected_rows($conexao)){
                $statusResultado = true;
            }else{
                $statusResultado = false;
            }
      
           }else{
            $statusResultado = false;
           }
      
          fecharConexaoMysql($conexao);
  
          return $statusResultado;
}
function selectAllUsuarios() {
    $conexao = conexaoMysql();

    $sql = "select * from tblusuarios order by idusuario desc";

    $result = mysqli_query($conexao, $sql);

    if($result){
        $cont = 0;

        while($rsDados = mysqli_fetch_assoc($result)){

            $arrayDados{$cont} = array(
                "id" => $rsDados['idusuario'],
                "nome" => $rsDados['nome'],
                "usuario" => $rsDados['usuario'],
                "email" => $rsDados['email'],
                "senha" => $rsDados['senha']
            );
            $cont++;
        }

        fecharConexaoMySql($conexao);
        if(isset($arrayDados)){
            return $arrayDados;
        }else{
            return false;
        }
    }

}
function selectByIdUsuario($id){
    $conexao = conexaoMysql();

    $sql = "select * from tblusuarios where idusuario =".$id;

    $result = mysqli_query($conexao, $sql);

    

    if($result){

        if($rsDados = mysqli_fetch_assoc($result)){

            $arrayDados = array(
                "idusuario"    => $rsDados['idusuario'],
                "nome"  => $rsDados['nome'],
                "usuario" => $rsDados['usuario'],
                "email" => $rsDados['email'],
                "senha" => $rsDados['senha']
            );
          
              
        }  
        fecharConexaoMySql($conexao);

            return $arrayDados;
    }

}


?>