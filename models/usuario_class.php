<?php

session_start();
    class Usuario{

        //Atributos da Classe
        public $id_funcionario;
        public $cpf;
        public $senha;
        public $id_nivel_funcionario;



        public function __construct(){
            require_once('bd_class.php');/*solicita o arquivo bd_class.php
                                           é ela que faz a conexão com o banco
                                            */

        }

        /*

        if(!isset(SESSION) &)


        */

        //faz o login com o usuário
        public function Login_usuario($usuario){

            $_SESSION["login"]=0;
            $_SESSION["id_funcionario"]=0;
            $count=0;
            $sql = "SELECT id_funcionario,usuario,id_nivel_acesso, senha FROM tbl_usuario_funcionario WHERE usuario = '" .$usuario->cpf . "'
             AND senha = '".$usuario->senha. "';";

            // echo $sql;


            //Instancia da classe do BD
            $conn = new Mysql_db();



            //chama o metodo para conectar no BD e guarda o retorno da conexao na variavel $PDO_conn
            $PDO_conn = $conn->Conectar();

            // Executa a query e salva em uma variavel
            $queryExecutada  = $PDO_conn -> query($sql);

            //Conta quantidade de linha
            $count = $queryExecutada->rowCount();

            if($count == 1){

                //IF para puxar um dado do banco de dados
                if ($puxaDadosDB = $queryExecutada->fetch(PDO::FETCH_ASSOC)) {
                  # code...
                  $id_funcionario = $puxaDadosDB['id_funcionario'];
                  $id_nivel_funcionario = $puxaDadosDB['id_nivel_acesso'];

                  $_SESSION["id_funcionario"]=$id_funcionario;  
                  $_SESSION["id_nivel_acesso"]=$id_nivel_funcionario;
                  $_SESSION["login"]=$count;



                }

            }
            
            if($puxaDadosDB = $queryExecutada->fetch(PDO::FETCH_ASSOC)){
                $id_funcionario = $puxaDadosDB['id_funcionario'];
              $id_nivel_funcionario = $puxaDadosDB['id_nivel_acesso'];

              $_SESSION["id_funcionario"]=$id_funcionario;  
              $_SESSION["id_nivel_acesso"]=$id_nivel_funcionario;
                
                echo($sql);
                
            }else{
                echo($sql);
            }

            if($_SESSION["login"]==1 ){
                header('location:CMS/index.php');

            }else if($_SESSION["login"]==1 && $id_nivel_funcionario == 5){

                header('location:CMS/');

            }else if($_SESSION["login"]==0){
                  $_SESSION["id_funcionario"]=="";
                header('location:index.php');
          }else if($_SESSION["login"]==1){
                $_SESSION["id_funcionario"]=$puxaDadosDB['id_funcionario'];
                header('location:CMS/');

            }



            // echo($count."To Aki");
            //Executa o Script no BD



            //Fecha a conexao com o Banco de Dados

            $conn -> Desconectar();

            //var_dump($sql);
        }

    }


?>
