<?php

    class Auditoria{
        
        public $id_auditoria;
        public $data;
        public $hora;
        public $usuario;
        public $acao;
        
        
        public function Insert(){
            
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d');
            $hora = date('H:i');
            $usuario="1";
            $acao=" O usuario [josé], [inseriu] um usuário no banco ";
            
            $sql="INSERT INTO tbl_auditoria(data,hora,usuario,acao)
            VALUES('".$data."', '".$hora."', '".$usuario."','".$acao."' )";
            
            $conex = new Mysql_db();

            /*Chama o método para conectar no banco de dados e guarda o retorno da conexao na variavel*/
            $PDO_conex = $conex->Conectar();

            //Excutar o script no banco de dados
            if($PDO_conex->query($sql)){
                echo "<script>location.reload();</script>";

			}else {
				//Mensagem de erro
				echo "Error inserir no Banco de Dados";
                echo $sql;
			}
            //Fechar a conexão com o banco de dados
            echo $sql;
            $conex->Desconectar();
            
            
        }
        
        
        
    }

?>