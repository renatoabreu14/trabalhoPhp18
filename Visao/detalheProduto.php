<?php
/**
 * Created by PhpStorm.
 * User: Camilla Bim
 * Date: 26/06/2018
 * Time: 19:37
 */
require_once "../Controlador/ControllerProdutos.php";
$produto = new Produto();

if(isset($_GET['id'])){
    $produto = ControllerProdutos::buscarProdutoPorId($_GET['id']);

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
    </nav>

</section>

            <div class="col-10">
                <a href="produtos.php" class="btn btn-primary btn-sm">Voltar</a>
                <br>
        <?php


            if($produto->getId() <=0){
                echo "<h3>Nenhum cliente foi encontrado</h3>";
            }else{//mostrar os dados

                echo "<h3>Detalhes do Produto</h3><hr>";
                echo "<h6><label class='text-center'><b>Código do Produto<b>:&nbsp;</label>";
                echo utf8_decode($produto->getId());
                echo "<hr>";


                echo "<h6>Descrição</h6>";
                echo utf8_decode($produto->getDescricao());
                echo "<hr>";
                echo "<h6>Quantidade em Estoque</h6>";
                echo $produto->getEstoque();
                echo "<hr>";
                echo "<h6>Valor</h6>";
                echo "R$ "; echo $produto->getValorUnitario();
                echo "<hr>";
                echo "<h6>Marca</h6>";
                echo $produto->getMarca()->getDescricao();
                echo "<hr>";
                echo "<h6>Categoria</h6>";
                echo $produto->getCategoria()->getDescricao();

            }


            ?>
    <br>
    <br>

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
        <div class="col-12 text-center">
            <?php
            if(($_SESSION['usuario'])!=null){
                echo 'Olá! Seja bem-vindo(a) '. unserialize($_SESSION['usuario'])->getNome();
            }
            ?>
        </div>
    </div>
</section>

<!-- Configurando javascript bootstrap  -->
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>

</html>
