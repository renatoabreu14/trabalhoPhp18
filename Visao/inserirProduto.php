<?php
/**
 * Created by PhpStorm.
 * User: Camilla
 * Date: 30/06/2018
 * Time: 19:36
 */

require_once "../modelo/Produto.class.php";
require_once "../Controlador/ControllerMarca.php";
require_once "../Controlador/ControllerCategoria.php";
require_once "../Controlador/ControllerProdutos.php";
require_once "../Controlador/Conexao.php";
require_once "../controlador/verificaLogin.php";

$produto = new Produto();

$listaMarca = ControllerMarca::buscarTodos();

$listaCategoria = ControllerCategoria::buscarTodos();

if(isset($_GET['id'])){
    $produto = ControllerProdutos::buscarProdutoPorId($_GET['id']);
}

if (isset($_POST['enviar'])){
    $produto->setId($_POST['id']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setEstoque($_POST['estoque']);
    $produto->setValorUnitario($_POST['valor_unitario']);
    $produto->getMarca()->setId($_POST['marca']);
    $produto->getCategoria()->setId($_POST['categoria']);

    ControllerProdutos::salvar($produto);

    header('Location: produtos.php');
}


?>

<html>

<head>
    <title>VendaS/A - Aqui você encontra de tudo!</title>
    <!-- Configurando bootstrap-->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        h5{
            color: #6c757d;
            padding: 5px;
            font-size: 18pt;
        }

        a:hover h5{
            color: white;
            transition:all 0.3s ease;
            animation: none;
            text-decoration: none;
        }

        a{
            text-decoration: none;
        }

        a :active{
            color: black;

        }

        h3{
            color: #005cbf;
            font-family: Roboto;
            padding-top: 35px;
        }

    </style>
</head>
<body>


<section id="cabecalho">

    <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">
        <h3>VendaS/A  </h3>

        <div class="col-md-1 d-md-block row">
            <br>
            <ul class="nav nav-tabs">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cadastro</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="produtos.php">Produtos</a>
                        <a class="dropdown-item" href="clientes.php">Clientes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="marca.php">Marcas</a>
                        <a class="dropdown-item" href="categoria.php">Categoria</a>
                    </div>
                </li>
            </ul>

            <div class="col-md-8 d-md-block">
                <li class="btn-group btn-danger ">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="btn-group"></i>Sair</a>
                </li>
            </div>
        </div>
        <div class="col-12 text-center">
            <?php
            if(($_SESSION['usuario'])!=null){
                echo 'Olá! Seja bem-vindo(a) '. unserialize($_SESSION['usuario'])->getNome();
            }
            ?>
        </div>
    </nav>

</section>



            <div class="col-md-12 d-md-block">


                <form action="#" method="post"> <!-- # chama o proprio arquivo-->
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-success btn-sm" name="enviar">Salvar</button>
                        <a href="produtos.php" class="btn btn-danger btn-sm" name="cancelar">Cancelar</a>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $produto->getId();?>">
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Descrição</label>
                            <input type="text" name="descricao" placeholder="Descrição do Produto" class="form-control" value="<?php echo $produto->getDescricao();?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Estoque</label>
                            <input type="number" name="estoque" placeholder="Qtd em estoque" class="form-control" value="<?php echo $produto->getEstoque();?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label>Valor Unitário</label>
                            <input type="number" name="valor_unitario" placeholder="R$ 00,00" class="form-control" value="<?php echo $produto->getValorUnitario();?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label class="label">Marca</label>
                            <select name="marca" class="form-control">
                                <?php
                                foreach ($listaMarca as $marca) {
                                    if($produto->getMarca()->getId() == $marca->getId()){
                                        echo "<option value='".$marca->getId()."' selected>".$marca->getDescricao()."</option>";
                                    }else{
                                        echo "<option value='".$marca->getId()."'>".$marca->getDescricao()."</option>";
                                    }
                                }

                                ?>
                            </select>
                        </div>


<!--                    <div class="form-group">-->
                        <div class="col-6">
                            <label class="label">Categoria</label>
                            <select name="categoria" class="form-control">
                                <?php
                                foreach ($listaCategoria as $categoria) {
                                    if($produto->getCategoria()->getId() == $categoria->getId()){
                                        echo "<option value='".$categoria->getId()."' selected>".$categoria->getDescricao()."</option>";
                                    }else{
                                        echo "<option value='".$categoria->getId()."'>".$categoria->getDescricao()."</option>";
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    </div>

<section id="modalSair">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" se está pronto para sair da sessão.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../Controlador/logout.php">Sair</a>
                </div>
            </div>
        </div>

    </div>
</section>





    <!-- Configurando javascript bootstrap  -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
