<?php

require('../verifica.php');

?>
<html>
    <head>
        <title>Sistema Interno HHealth</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style_footer.css">
        <link rel="stylesheet" type="text/css" href="../css/style_nivel_funcionario.css">
        <link rel="stylesheet" type="text/css" href="../css/style_menu_lateral.css">

        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>


        <script>/*Modal*/
            $(document).ready(function(){

                $(".novo").click(function(){
                    $(".container_modal").toggle(2000);
                });

                $(".editar").click(function(){
                    $(".container_modal").fadeIn(2000);

                });


            });

            //Cadastrar
            function Cadastrar(){

                $.ajax({
                    type:"POST",
                    url:"../modals/modal_tipo_quarto.php",
                    success: function(dados){
                        $(".modal").html(dados);
                    }
                });
            }

            //Editar
            function Editar(IdIten){
                $.ajax({
                    type:"GET",
                    url:"../modals/modal_tipo_quarto.php",
                    data: {modo:'buscarId',id:IdIten},
                    success: function(dados){
                        $('.modal').html(dados);
                    }

                });
            }

            //Excluir
            function Excluir(idIten){
                //anula a ação do submit tradicional "botao" ou F5
                event.preventDefault();

                if(confirm('Tem certeza?')){

                $.ajax({
                    type:"GET",
                    data: {id:idIten},
                    url: "../router.php?controller=tipo_quarto&modo=excluir&id="+idIten,
                    success: function(dados){
                        //console.log(dados);
                        $('.col_2').html(dados);
                        //alert(dados);
                    }
                });

                }
            }






        </script>

    </head>
    <body>
        <div class="container_modal"><!--container da modal-->
            <div class="modal"><!--modal-->
            </div>
        </div>
        <div id="principal">
            <header>
                SISTEMA INTERNO HHEALTH
            </header>
            <div class="alinha_conteudo">

            </div>
            <?php include_once('menu_lateral.php');  ?>
            <div class="main">
                <div id="container_cad_paciente">
                      <div class="cabecalho">
                           <div class="txt_cabecalho">
                                 <p>Tipo quarto</p>
                           </div>
                           <div class="img_nivel">
                                <a class="novo" href="#" onclick="Cadastrar()">

                                    <img src="../imagens/add.png">
                                </a>
                           </div>
                      </div>
                    <div class="col_2">
                        <div class="titulo_tabela">
                            <div class="lb_titulo">TIPO</div>
                            <div class="lb_titulo">DESCRIÇÃO</div>
                            <div class="lb_titulo">OPÇÕES</div>
                        </div>

                        <?php

                            include_once('../controllers/tipo_quarto_controller.php');
                            include_once('../models/tipo_quarto_class.php');

                                $controller_tipo_quarto  = new controllerTipoQuarto();

                                //Chama o metodo para Listar todos os registros
                                $list = $controller_tipo_quarto::Listar();

                                if(!empty($list)){
                                $cont = 0;

                                while ($cont < count($list)) {
                        ?>
                                    <div class="linha_tabela">
                                        <div class="item_tabela"><?= $list[$cont]->nivel ?></div>
                                        <div class="item_tabela"><?= $list[$cont]->descricao ?></div>
                                        <div class="item_tabela icones_tabela">

                                            <a href="#" class="editar" onclick="Editar(<?php echo($list[$cont]->id_tipo_quarto);?>)">
                                                <img src="../imagens/edit.png" alt="editar" title="editar">
                                            </a>
                                            <a href="#" class="excluir" onclick="Excluir(<?php echo($list[$cont]->id_tipo_quarto);?>)">
                                                <img src="../imagens/shutdown.png" alt="excluir" title="excluir">
                                            </a>
                                        </div>
                                    </div>
                        <?php

                                $cont +=1;
                                }
                              }

                        ?>
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por CPI - 2018
            </footer>
        </div>
    </body>
</html>
