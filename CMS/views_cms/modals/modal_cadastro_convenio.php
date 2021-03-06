<?php

//$action = "modo=inserir";

$id="0";
$especialidade=null;
$texto=null;
$arquivo = null;
$imagem=null;
$file=null;

$variavel_style = "display:none;";


if(isset($_GET['modo'])){

    $variavel_style = "display:block";

    $modo = $_GET['modo'];

    if($modo=='buscarId'){
        $id=$_GET['id'];

        require_once("../../controller_cms/convenios_controller.php");/*da um require na convnio_controller*/
        require_once("../../model_cms/convenio_class.php");/*da um require na convenio_class*/

        // Instancio a controller
        $controller_convenio  = new controller_convenios();

        //Chama o metodo para Listar todos os registros
        $list = $controller_convenio::Buscar($id);

        //$id = $list->id_convenio;
        $titulo = $list->titulo;
        $texto = $list->texto;
        $imagem = $list->imagem;
        $status_imagem = $list->status_imagem;
        $ativo = $list->ativo;

    }
}
?>

<html>
    <head>
        <title>Modal</title>
        <link rel="stylesheet" type="text/css" href="../css/style_modal_cadastro_convenios.css">
        <style>
            #imagem_atual{
                width: 150px;
                height: 150px;
                margin-left: auto;
                margin-right: auto;
            }
            #imagem_atual img{
                width: 150px;
                height: 150px;
            }

        </style>
        <script>
            $(document).ready(function(){/*fechar a modal*/
               $(".fechar").click(function(){
                  $(".container_modal").fadeOut();
               });
            });
        </script>
    </head>

    <body>

         <script>
             $("#form").submit(function(event){
                  //Recupera o id gravado no Form pelo atribute-id
                  var id = $(this).data("id");
                  var modo = "";
                  if(id == '0')
                      modo='inserir';
                  else
                      modo='editar';

                //anula a ação do submit tradicional "botao" ou F5
                 event.preventDefault();

                 $.ajax({
                    type: "POST",
                    url: "../router.php?controller=convenio&modo="+modo+"&id="+id,
                    //alert (url);
                    data: new FormData($("#form")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    async:true,
                    success: function(dados){
                         $('.modal').html(dados);
                    }
                });

             });
         </script>
        <div class="main_modal"><!--main que segura tudo-->
            <div class="close_modal">
                <a href="#" class="fechar"><img src="../imagens/close.png"/></a>
            </div>

            <div class="content_modal">
                <form action="" method="post" id="form" data-id="<?php echo($id)?>" enctype="multipart/form-data">
                    <div class="content_logo"><!--content do logo e do titulo-->
                        <div class="logo">
                            <img src="../../imagens/logo_only_heart.png">
                        </div>
                        <div class="titulo">
                            <a>Convênios</a>
                        </div>
                    </div>

                    <div class="content_campos"><!--content dos campos de cadastro-->
                        <div class="campo"><!--campos--> <!--nome-->

                            <div class="input_campo">
                                <input value="" required type="text" class="input_big" placeholder="CONVÊNIO" name="txt_titulo">
                            </div>
                        </div>
                        <div class="campo"><!--campos--> <!--nome-->

                            <div class="input_campo">
                               <textarea required class="input_bigger" placeholder="DESCRIÇÃO DO CONVÊNIO" name="txt_texto" style="resize:none;"><?= $texto ?></textarea>
                            </div>
                        </div>
                        <div class="campo"><!--campos--> <!--nome-->

                            <div class="input_campo">
                                <b>Selecione uma imagem para o convenio :</b>

                                <input type="file"  name="file_convenio" id="file_convenio" >
                            </div>
                            <div id="imagem_atual" style="<?= $variavel_style ?>">
                                <img src="../<?= $imagem ?>" title="imagem atual" alt="imagem atual">

                            </div>
                        </div>
                        <div class="campo_botao">
                            <div class="botao">
                                <input id="bnt_cadastrar" type="submit" name="btn_cadastrar" value="Cadastrar" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
