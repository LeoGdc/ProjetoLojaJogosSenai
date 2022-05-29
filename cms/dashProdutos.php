<?php
//variavel criada para diferenciar no action do formulario qual ação deveria ser levada para a router (inserir ou editar).
    //nas condições abaixo, mudamos o action dessa variavel para a ação de editar.
    $form = (string)"router.php?component=produto&action=inserir";
    //valida se a utilização de variaveis de sessao esta ativa no servidor
    if(session_status()){
        //valida se a variavel de sessao dados contato não esta vazia
         if(!empty($_SESSION['dadosProduto'])){
             $id        = $_SESSION['dadosProduto']['idproduto'];
             $nome       = $_SESSION['dadosProduto']['nome'];
             $descricao = $_SESSION['dadosProduto']['descricao'];
             $foto = $_SESSION['dadosProduto']['foto'];
             $idcategoria = $_SESSION['dadosProduto']['idcategoria'];

             //mudamos a ação do form para editar o registro no click do bt "salvar"
             $form = "router.php?component=produto&action=editar&id=".$id;

             //destroi uma variavel da memoria do server
             unset($_SESSION['dadosProduto']);
         }
    }

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/produto.css">

    <title>.</title>
</head>
<body>
   <main>
       <div id=caixa>
           <div id="topo">
                <div id="titulo">
                    <p class="cms">CMS</p>
                    <p class="tg">Torrent Games</p>
                    <p class="gerenciamento">Gerenciamento de Conteúdo do Site</p>
                </div>
                <div id="img">
                    <img id="logo"src="img/Tg.png" alt="">

                </div>
           </div>
           <div id="atalhos">
               <div id="buttons">  
                   <button id=adm>
                        <img id="admin" src="img/admin.jpg" alt="">
                    </button>
                    <button id=categorias>
                        <a href="dashCategorias.php">
                            <img id="admin" src="img/categorias.png" alt="">
                        </a>
                    </button>
                    <button id=contatos>
                        <a href="DashContatos.php">
                            <img id="admin" src="img/contato.jpg" alt="">
                        </a>
                    </button>
                    <button id=usuarios>
                        <img id="admin" src="img/user.png" alt="">
                    </button>
                </div>
                <Div id=sair>
                    <button id="salir">
                        <img id="imgs"src="img/Vector.png" alt="">
                    </button>
                </Div>
            </div>
         
            <div id="sessao">
            <div id="cadastroInformacoes">
                <!-- enctype="multipart/form-data essa opção é obrigatoria para enviar arquivos do formulario em htmlk para o servidor -->
                <form  action="<?=$form?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label>adicione um Usuario</label>
                        </div>
                        <div id="adiconarSalvar">
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=isset($nome)?$nome:null ?>" placeholder="Digite o nome" maxlength="100" id="inputText">
                        </div>
                        <div>
                            <input type="text" name="txtDescricao" value="<?=isset($descricao)?$descricao:null?>" placeholder="Digite a descrição"  id="inputText">
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="categoria">
                                <option value="">Selecione uma categoria
                                </option>
                                <?php
                                    require_once('controller/controllerCategorias.php');
                                    $listarCategorias = listarCategoria();

                                    foreach($listarCategorias as $item){
                                        ?>
                                            <option <?=$idcategoria==$item['idcategoria']?'selected':null?> value="<?=$item['idcategoria']?>"<?=$item['nome']?></option>
                                            <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <input type="file" name="foto" accept=".jpg, .png, .jpeg, .gif">
                        </div>
                        <div class="enviar">
                            <button type="submit" name="btnEnviar" value="Salvar">
                                <img src="img/salvar.png" alt="" id="imgSalvarCategoria">
                            </button>
                        </div>
                        </div>
                    </div>
                <div id="consultaDeDados">
                    <table id="tblConsulta">
                        <tr>
                            <th id="tblTitulo" colspan="6">
                                <h1> usuarios</h1>
                            </th>
                        </tr>
                        <tr id="tblLinhasNome">
                            <td class="tblcontato destaque">Nome</td>
                            <td class="tblcontato destaque">Opção</td>
                        </tr>
                <?php
                    require_once('controller/controllerUsuarios.php');
                    $listaUsuarios = listarUsuario();

                    if($listaUsuarios){
                        foreach ($listaUsuarios as $item) {
                ?>
                <tr id="tblLinhas">
                    <td class="tblColunas_registros"><?=$item['nome']?>
                        <a onclick="return confirm('Deseja realmente Excluir este item?');" href="router.php?component=produto&action=deletar&id=<?=$item['id']?>">
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                        </a>
                        <a href="router.php?component=produto&action=buscar&id=<?=$item['id']?>">
                            <img src="img/edicao.png" class="excluir" alt="">
                        </a>
                    </td>
                </tr>
                <?php
                        } 
                    }
                ?>
            </table>
        </div>
   </main>
</body>
</html>