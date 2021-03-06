<?php

    class controller_pre_agendamento{
        public $id_agendamento;
        public $id_paciente;
        public $id_especialidade;
        public $id_funcionario;
        public $id_unidade;
        public $data;
        public $hora;

       public function Novo($id){

          require_once ('models/pre_atendimento_class.php');
          include_once('models/auditoria_paciente_class.php');
          //Instancia da classe Contato
          $agendamento = new Pre_Agendamento();

          //Carregando os dados digitados pelo usuário nos atributos da classe
          $agendamento->id_paciente = $id;
          $agendamento->paciente="teste";
          // $agendamento->id_especialidade = $_POST['slt_especialidade'];
          $agendamento->id_funcionario = $_POST['slc_medico'];
          $agendamento->id_unidade = $_POST['slc_unid'];
          $agendamento->data = $_POST['date_pre_atendimento'];
          $agendamento->hora = $_POST['txt_tempo'];
          $agendamento->acao = "Agendou";


          //Chama o metodo Insert da classe Contato
          //Existe também a posibilidade de chamar o metodo da seguinte forma:
          //$contato::Insert($contato);
          $auditoria = new Auditoria_paciente();

          $auditoria::Insert($agendamento);
          $agendamento::Insert($agendamento);

            //return $id_ende;

		}

		public function Listar(){
			//Instancia da classe contatos
			$agendamento = new Agendamento();

			//Chama o método para selecionar os registros



			return $agendamento::Select();
		}

    public function ListarEstados(){
			//Instancia da classe contatos
			$estados = new Endereco;

			//Chama o método para selecionar os registros

			return $estados::SelectAllStates();
		}

      public function Buscar(){
			//GUARDA O ID DO CONTATO PASSADO NA VIEW
			$idEndereco = $_GET['id_ende'];

			//INSTANCIA A CLASSE CONTATO
			$endereco = new Endereco();

			//DEFINE O ID DO CONTATO COM O VALOR DA VARIÁVEL
			$endereco->id_endereco = $idEndereco;

			//CHAMA O MÉTODO DA MODEL PARA APAGAR O REGISTRO
			$endereco = $endereco::SelectById($endereco);

            return $endereco;
			//require_once('../modals/modal_cad_especialidade.php');
		}

        /*Atualiza um registro existente*/
		public function Editar(){
            require_once ('model_cms/endereco_class.php');
			//GUARDA O ID DO CONTATO PASSADO NA VIEW
			$idEndereco = $_GET['id_ende'];

			//INSTANCIA A CLASSE CONTATO
			$endereco = new Endereco();

			//DEFINE O ID DO CONTATO COM O VALOR DA VARIÁVEL
			$endereco->id_endereco = $idEndereco;

			$endereco->cep = $_POST['txt_cep'];
            $endereco->logradouro = $_POST['txt_logradouro'];
            $endereco->numero = $_POST['txt_numero'];
            $endereco->id_estado = $_POST['slt_estado'];
            $endereco->cidade = $_POST['txt_cidade'];
            $endereco->bairro = $_POST['txt_bairro'];

            $endereco::Update($endereco);
		}

        public function Excluir(){
			//GUARDA O ID DO CONTATO PASSADO NA VIEW
			$idEndereco = $_GET['id'];

			//INSTANCIA A CLASSE CONTATO
			$endereci = new Endereco();

			//DEFINE O ID DO CONTATO COM O VALOR DA VARIÁVEL
			$endereco->id_endereco = $idEndereco;

			//CHAMA O MÉTODO DA MODEL PARA APAGAR O REGISTRO
			$endereco::Delete($endereco);

		}


    }

?>
