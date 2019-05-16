<?php

class PacientesForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'consultorio';
    private static $activeRecord = 'Pacientes';
    private static $primaryKey = 'id';
    private static $formName = 'form_Pacientes';

    use Adianti\Base\AdiantiMasterDetailTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle('Cadastro de paciente');


        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $idade = new TEntry('idade');
        $dt_nasc = new TDate('dt_nasc');
        $sexo = new TCombo('sexo');
        $cpf = new TEntry('cpf');
        $estado_civil = new TCombo('estado_civil');
        $rg = new TEntry('rg');
        $orgao_emissor = new TEntry('orgao_emissor');
        $nome_mae = new TEntry('nome_mae');
        $nome_pai = new TEntry('nome_pai');
        $dt_cadastro = new TDate('dt_cadastro');
        $dt_ult_atendimento = new TDate('dt_ult_atendimento');
        $profissao = new TEntry('profissao');
        $responsavel = new TEntry('responsavel');
        $empresa = new TEntry('empresa');
        $conjugue = new TEntry('conjugue');
        $observacao = new TText('observacao');
        $tipo_atendimento_id = new TRadioGroup('tipo_atendimento_id');
        $convenios_paciente_operadora_id = new TDBCombo('convenios_paciente_operadora_id', 'consultorio', 'Operadora', 'id', '{nome}','nome asc');
        $convenios_paciente_matricula = new TEntry('convenios_paciente_matricula');
        $convenios_paciente_plano_id = new TDBCombo('convenios_paciente_plano_id', 'consultorio', 'Plano', 'id', '{nome}','nome asc'  );
        $convenios_paciente_validade = new TDate('convenios_paciente_validade');
        $convenios_paciente_tipo_plano_id = new TDBCombo('convenios_paciente_tipo_plano_id', 'consultorio', 'TipoPlano', 'id', '{descricao}','descricao asc'  );
        $convenios_paciente_via_cartao = new TEntry('convenios_paciente_via_cartao');
        $enderecos_paciente_cep = new TEntry('enderecos_paciente_cep');
        $button_buscar = new TButton('button_buscar');
        $enderecos_paciente_logradouro = new TEntry('enderecos_paciente_logradouro');
        $enderecos_paciente_numero = new TEntry('enderecos_paciente_numero');
        $enderecos_paciente_bairro = new TEntry('enderecos_paciente_bairro');
        $enderecos_paciente_complemento = new TEntry('enderecos_paciente_complemento');
        $enderecos_paciente_cidade = new TEntry('enderecos_paciente_cidade');
        $enderecos_paciente_estado = new TEntry('enderecos_paciente_estado');
        $enderecos_paciente_tipo_endereco_id = new TDBCombo('enderecos_paciente_tipo_endereco_id', 'consultorio', 'TiposEnderecos', 'id', '{descricao}','descricao asc'  );
        $contato_paciente_telefone = new TEntry('contato_paciente_telefone');
        $contato_paciente_email = new TEntry('contato_paciente_email');
        $contato_paciente_nome_contato = new TEntry('contato_paciente_nome_contato');
        $contato_paciente_tipo_contato_id = new TDBCombo('contato_paciente_tipo_contato_id', 'consultorio', 'TiposContato', 'id', '{descricao}','descricao asc'  );
        $convenios_paciente_id = new THidden('convenios_paciente_id');
        $enderecos_paciente_id = new THidden('enderecos_paciente_id');
        $contato_paciente_id = new THidden('contato_paciente_id');
        
        $tipo_atendimento_id->setChangeAction(new TAction([$this,'onHideSeparatorPlanoSaude']));
        
        $contato_paciente_email->setExitAction(new TAction([$this,'verificaCampoEmail']));

        $nome->addValidation('Nome', new TRequiredValidator()); 
        $dt_nasc->addValidation('data de nascimento', new TRequiredValidator()); 
        $cpf->addValidation('cpf', new TRequiredValidator()); 
        $dt_cadastro->addValidation('data de cadastro', new TRequiredValidator());
         
        $tipo_atendimento_id->setLayout('horizontal');
        $id->setEditable(false);
        $tipo_atendimento_id->setValue('1');
        $button_buscar->setAction(new TAction([$this, 'onSearchCep']), 'Buscar');
        $button_buscar->addStyleClass('btn-primary');
        $button_buscar->setImage('fa:search #ffffff');       
                        
        $sexo->addItems(['1'=>'Masculino','2'=>'Feminino']);
        $tipo_atendimento_id->addItems(['1'=>'Particular','2'=>'Convênio']);
        $estado_civil->addItems(['1'=>'Solteiro','2'=>'Casado','3'=>'Separado','4'=>'Divorciado','5'=>'Outros']);

        $dt_nasc->setDatabaseMask('yyyy-mm-dd');
        $dt_cadastro->setDatabaseMask('yyyy-mm-dd');
        $dt_ult_atendimento->setDatabaseMask('yyyy-mm-dd');
        $convenios_paciente_validade->setDatabaseMask('yyyy-mm-dd');

        $rg->setMask('99.999.999-9');
        $dt_nasc->setMask('dd/mm/yyyy');
        $cpf->setMask('999.999.999-99');
        $dt_cadastro->setMask('dd/mm/yyyy');
        $dt_ult_atendimento->setMask('dd/mm/yyyy');
        $convenios_paciente_validade->setMask('dd/mm/yyyy');
        $contato_paciente_telefone->setMask('(99)99999-9999');

        $id->setSize(100);
        $rg->setSize(300);
        $cpf->setSize(290);
        $nome->setSize(410);
        $idade->setSize(140);
        $sexo->setSize('72%');
        $dt_nasc->setSize(140);
        $nome_pai->setSize(420);
        $nome_mae->setSize(420);
        $empresa->setSize('72%');
        $conjugue->setSize('72%');
        $dt_cadastro->setSize(150);
        $profissao->setSize('72%');
        $responsavel->setSize('72%');
        $observacao->setSize(420, 70);
        $estado_civil->setSize('70%');
        $orgao_emissor->setSize('72%');
        $tipo_atendimento_id->setSize(80);
        $dt_ult_atendimento->setSize(150);
        $enderecos_paciente_cep->setSize(150);
        $contato_paciente_email->setSize(300);
        $enderecos_paciente_numero->setSize(150);
        $contato_paciente_telefone->setSize(300);
        $enderecos_paciente_bairro->setSize(300);
        $enderecos_paciente_cidade->setSize(300);
        $enderecos_paciente_estado->setSize(200);
        $convenios_paciente_validade->setSize(150);
        $convenios_paciente_matricula->setSize(300);
        $convenios_paciente_plano_id->setSize('72%');
        $contato_paciente_nome_contato->setSize(420);
        $convenios_paciente_via_cartao->setSize(150);
        
        $enderecos_paciente_logradouro->setSize(420);
        $enderecos_paciente_complemento->setSize(150);
        $contato_paciente_tipo_contato_id->setSize(300);
        $convenios_paciente_operadora_id->setSize('72%');
        $convenios_paciente_tipo_plano_id->setSize('72%');
        $enderecos_paciente_tipo_endereco_id->setSize(300);


        $nome->autofocus = 'autofocus';

        $this->form->appendPage('Identificação');
        $row1 = $this->form->addContent([new TFormSeparator('Dados Pessoais', '#333333', '18', '#eeeeee')]);
        $row2 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id]);
        $row3 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$nome],[new TLabel('Idade:', null, '14px', null)],[$idade]);
        $row4 = $this->form->addFields([new TLabel('Data de Nascimento:', null, '14px', null)],[$dt_nasc],[new TLabel('Sexo:', null, '14px', null)],[$sexo]);
        $row5 = $this->form->addFields([new TLabel('CPF:', null, '14px', null)],[$cpf],[new TLabel('Estado Civil:', null, '14px', null)],[$estado_civil]);
        $row6 = $this->form->addFields([new TLabel('RG:', null, '14px', null)],[$rg],[new TLabel('Órgão Emissor:', null, '14px', null)],[$orgao_emissor]);
        $row7 = $this->form->addContent([new TFormSeparator('Filiação', '#333333', '18', '#eeeeee')]);
        $row8 = $this->form->addFields([new TLabel('Nome da Mãe:', null, '14px', null)],[$nome_mae],[],[]);
        $row9 = $this->form->addFields([new TLabel('Nome do Pai:', null, '14px', null)],[$nome_pai],[],[]);
        $row10 = $this->form->addContent([new TFormSeparator('Outras Informações', '#333333', '18', '#eeeeee')]);
        $row11 = $this->form->addFields([new TLabel('Data de Cadastro:', null, '14px', null)],[$dt_cadastro],[new TLabel('Ultimo Atendimento:', null, '14px', null)],[$dt_ult_atendimento]);
        $row12 = $this->form->addFields([new TLabel('Profissão:', null, '14px', null)],[$profissao],[new TLabel('Responsável:', null, '14px', null)],[$responsavel]);
        $row13 = $this->form->addFields([new TLabel('Nome da Empresa:', null, '14px', null)],[$empresa],[new TLabel('Cônjugue:', null, '14px', null)],[$conjugue]);
        $row14 = $this->form->addFields([new TLabel('Observação:', null, '14px', null)],[$observacao]);
        $row15 = $this->form->addFields([new TLabel('Tipo de Atendimento:', null, '14px', null)],[$tipo_atendimento_id],[],[]);      
        $row16 = $this->form->addContent([new TFormSeparator('Plano de Saúde', '#333333', '18', '#eeeeee')]);
        $row17 = $this->form->addFields([new TLabel('Operadora:', null, '14px', null)],[$convenios_paciente_operadora_id],[new TLabel('Matricula:', null, '14px', null)],[$convenios_paciente_matricula]);
        $row18 = $this->form->addFields([new TLabel('Plano:', null, '14px', null)],[$convenios_paciente_plano_id],[new TLabel('Validade:', null, '14px', null)],[$convenios_paciente_validade]);
        $row19 = $this->form->addFields([new TLabel('Tipo de Plano:', null, '14px', null)],[$convenios_paciente_tipo_plano_id],[new TLabel('Via cartao:', null, '14px', null)],[$convenios_paciente_via_cartao]);
        $row20 = $this->form->addFields([$convenios_paciente_id]);         
        $add_convenios_paciente = new TButton('add_convenios_paciente');
       
        $action_convenios_paciente = new TAction(array($this, 'onAddConveniosPaciente'));
        
        $add_convenios_paciente->setAction($action_convenios_paciente, 'Adicionar');
        $add_convenios_paciente->setImage('fa:plus #000000');

        $this->form->addFields([$add_convenios_paciente]);

        $this->convenios_paciente_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->convenios_paciente_list->style = 'width:100%';
        $this->convenios_paciente_list->class .= ' table-bordered';
        $this->convenios_paciente_list->disableDefaultClick();
        $this->convenios_paciente_list->addQuickColumn('', 'edit', 'left', 50);
        $this->convenios_paciente_list->addQuickColumn('', 'delete', 'left', 50);

        $column_convenios_paciente_operadora_id = $this->convenios_paciente_list->addQuickColumn('Operadora', 'convenios_paciente_operadora_id', 'left');
        $column_convenios_paciente_matricula = $this->convenios_paciente_list->addQuickColumn('Matricula', 'convenios_paciente_matricula', 'left');
        $column_convenios_paciente_plano_id = $this->convenios_paciente_list->addQuickColumn('Plano', 'convenios_paciente_plano_id', 'left');
        $column_convenios_paciente_tipo_plano_id = $this->convenios_paciente_list->addQuickColumn('Tipo de Plano', 'convenios_paciente_tipo_plano_id', 'left');
        $column_convenios_paciente_validade = $this->convenios_paciente_list->addQuickColumn('Validade', 'convenios_paciente_validade', 'left');
        $column_convenios_paciente_via_cartao = $this->convenios_paciente_list->addQuickColumn('Via cartao', 'convenios_paciente_via_cartao', 'left');

      
        $this->convenios_paciente_list->createModel();
        $this->form->addContent([$this->convenios_paciente_list]);

        $this->form->appendPage('Endereço');
        $row21= $this->form->addContent([new TFormSeparator('Dados do Endereço', '#333333', '18', '#eeeeee')]);
        $row22 = $this->form->addFields([new TLabel('Cep:', null, '14px', null)],[$enderecos_paciente_cep,$button_buscar],[],[]);
        $row23 = $this->form->addFields([new TLabel('Logradouro:', null, '14px', null)],[$enderecos_paciente_logradouro],[new TLabel('Número:', null, '14px', null)],[$enderecos_paciente_numero]);
        $row24 = $this->form->addFields([new TLabel('Bairro:', null, '14px', null)],[$enderecos_paciente_bairro],[new TLabel('Complemento:', null, '14px', null)],[$enderecos_paciente_complemento]);
        $row25 = $this->form->addFields([new TLabel('Cidade:', null, '14px', null)],[$enderecos_paciente_cidade],[new TLabel('Estado:', null, '14px', null)],[$enderecos_paciente_estado]);
        $row26 = $this->form->addFields([new TLabel('Tipo de Endereço:', null, '14px', null)],[$enderecos_paciente_tipo_endereco_id],[],[]);
        $row27 = $this->form->addFields([$enderecos_paciente_id]);         
        $add_enderecos_paciente = new TButton('add_enderecos_paciente');
        
        

        $action_enderecos_paciente = new TAction(array($this, 'onAddEnderecosPaciente'));

        $add_enderecos_paciente->setAction($action_enderecos_paciente, 'Adicionar');
        $add_enderecos_paciente->setImage('fa:plus #000000');

        $this->form->addFields([$add_enderecos_paciente]);

        $this->enderecos_paciente_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->enderecos_paciente_list->style = 'width:100%';
        $this->enderecos_paciente_list->class .= ' table-bordered';
        $this->enderecos_paciente_list->disableDefaultClick();
        $this->enderecos_paciente_list->addQuickColumn('', 'edit', 'left', 50);
        $this->enderecos_paciente_list->addQuickColumn('', 'delete', 'left', 50);

        $column_enderecos_paciente_cep = $this->enderecos_paciente_list->addQuickColumn('Cep', 'enderecos_paciente_cep', 'left');
        $column_enderecos_paciente_logradouro = $this->enderecos_paciente_list->addQuickColumn('Logradouro', 'enderecos_paciente_logradouro', 'left');
        $column_enderecos_paciente_numero = $this->enderecos_paciente_list->addQuickColumn('Número', 'enderecos_paciente_numero', 'left');
        $column_enderecos_paciente_complemento = $this->enderecos_paciente_list->addQuickColumn('Complemento', 'enderecos_paciente_complemento', 'left');
        $column_enderecos_paciente_bairro = $this->enderecos_paciente_list->addQuickColumn('Bairro', 'enderecos_paciente_bairro', 'left');
        $column_enderecos_paciente_cidade = $this->enderecos_paciente_list->addQuickColumn('Cidade', 'enderecos_paciente_cidade', 'left');
        $column_enderecos_paciente_estado = $this->enderecos_paciente_list->addQuickColumn('Estado', 'enderecos_paciente_estado', 'left');
        $column_enderecos_paciente_tipo_endereco_id = $this->enderecos_paciente_list->addQuickColumn('Tipo de Endereço', 'enderecos_paciente_tipo_endereco_id', 'left');

        $this->enderecos_paciente_list->createModel();
        $this->form->addContent([$this->enderecos_paciente_list]);

        $this->form->appendPage('Contato');
        $row28 = $this->form->addContent([new TFormSeparator('Dados para Contato', '#333333', '18', '#eeeeee')]);
        $row29 = $this->form->addFields([new TLabel('Telefone:', null, '14px', null)],[$contato_paciente_telefone],[],[]);
        $row30 = $this->form->addFields([new TLabel('Email:', null, '14px', null)],[$contato_paciente_email],[],[]);
        $row31 = $this->form->addFields([new TLabel('Nome do Contato:', null, '14px', null)],[$contato_paciente_nome_contato]);
        $row32 = $this->form->addFields([new TLabel('Tipo de Contato:', null, '14px', null)],[$contato_paciente_tipo_contato_id]);
        $row33 = $this->form->addFields([$contato_paciente_id]);         
        $add_contato_paciente = new TButton('add_contato_paciente');

        $action_contato_paciente = new TAction(array($this, 'onAddContatoPaciente'));

        $add_contato_paciente->setAction($action_contato_paciente, 'Adicionar');
        $add_contato_paciente->setImage('fa:plus #000000');

        $this->form->addFields([$add_contato_paciente]);

        $this->contato_paciente_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->contato_paciente_list->style = 'width:100%';
        $this->contato_paciente_list->class .= ' table-bordered';
        $this->contato_paciente_list->disableDefaultClick();
        $this->contato_paciente_list->addQuickColumn('', 'edit', 'left', 10);
        $this->contato_paciente_list->addQuickColumn('', 'delete', 'left', 10);

        $column_contato_paciente_telefone = $this->contato_paciente_list->addQuickColumn('Telefone', 'contato_paciente_telefone', 'left', '150');
        $column_contato_paciente_email = $this->contato_paciente_list->addQuickColumn('Email', 'contato_paciente_email', 'left', '250');
        $column_contato_paciente_nome_contato = $this->contato_paciente_list->addQuickColumn('Nome do Contato', 'contato_paciente_nome_contato', 'left', '300');
        $column_contato_paciente_tipo_contato_id = $this->contato_paciente_list->addQuickColumn('Tipo de Contato', 'contato_paciente_tipo_contato_id', 'left');

        $this->contato_paciente_list->createModel();
        $this->form->addContent([$this->contato_paciente_list]);

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");
           
        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);

        parent::add($container);

    }
    
    public static function verificaCampoEmail($param = null) 
    {
        try 
        {
            //code here
            //Verifica se ao digitar o email se o campo está vazio
            if(isset($param['contato_paciente_email']) && !empty($param['contato_paciente_email'])){
                $email = $param['contato_paciente_email'];

                // Valida email com a funçao filter_var
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   throw new Exception('Digite um email válido!');
                }
            }
            //</autoCode>
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }
    
    //Açao do radio button
    public static function onHideSeparatorPlanoSaude($param = null)
    {
        $botaoField = 'add_convenios_paciente'; 
        $tipo_atendimento_id = $param['tipo_atendimento_id'];
        TSession::getValue('convenios_paciente_items');
        
        self::onVerifyTypeOfCare($tipo_atendimento_id);
    }

    // Metodo que retorna endereço de acordo co cep digitado
    public static function onSearchCep($param = null) 
    {
    
        try 
        {
            //code here
            $resultado = @file_get_contents('https://viacep.com.br/ws/'.$param['enderecos_paciente_cep'].'/json/');
        
            $result = json_decode($resultado);

             if($result !== null)
             {

                 $data = new StdClass;

                 $data->enderecos_paciente_logradouro = $result->{'logradouro'};
                 $data->enderecos_paciente_bairro = $result->{'bairro'};
                 $data->enderecos_paciente_cidade = $result->{'localidade'};
                 $data->enderecos_paciente_estado = $result->{'uf'}; 
                 TForm::sendData(self::$formName, $data);
             }
             else
             {
                new TMessage('error', "O Cep digitado é inválido!!");
                return true;  

             }

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction
 
             /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Pacientes(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data
            
            $convenioPaciente_session = TSession::getValue('convenios_paciente_items');
            $enderecoPaciente_session = TSession::getValue('enderecos_paciente_items');
            $contatoPaciente_session  = TSession::getValue('contato_paciente_items');           
            
            //Recupera o valor do tipo_atendimento
            $obj_tipoAtendimento = $object->tipo_atendimento_id;
            
            //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
            $this->onVerifyTypeOfCare($obj_tipoAtendimento);

            // Verifica se existe convenio cadastrado                        
            if($obj_tipoAtendimento == "2"){
                        //var_dump($convenioPaciente_session);          
                 if($convenioPaciente_session == NULL){

                     throw new Exception('Favor preencher os dados do Plano de Saúde!');
                 }
            }
            // Verifica se existe endereço cadastrado 
            if($enderecoPaciente_session == NULL){
                 throw new Exception('Preencha pelo menos um Endereço válido!');
            }

             // Verifica se existe contato cadastrado 
             if($contatoPaciente_session == NULL){
                throw new Exception('Preencha pelo menos um Contato válido!');
            }
            
            var_dump($object);

            $object->store(); // save the object 
            

            $contato_paciente_items = $this->storeItems('Contato', 'paciente_id', $object, 'contato_paciente', function($masterObject, $detailObject){ 

                //code here

            }); 

            $enderecos_paciente_items = $this->storeItems('Enderecos', 'paciente_id', $object, 'enderecos_paciente', function($masterObject, $detailObject){ 

                //code here

            }); 

            $convenios_paciente_items = $this->storeItems('Convenios', 'paciente_id', $object, 'convenios_paciente', function($masterObject, $detailObject){ 

                //code here

            }); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);
            
            

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
        
        
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Pacientes($key); // instantiates the Active Record 
                
                //Recupera o valor do tipo_atendimento
                $obj_tipoAtendimento = $object->get_tipo_atendimento();

                //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
                $this->onVerifyTypeOfCare($obj_tipoAtendimento->id);
                   

                $contato_paciente_items = $this->loadItems('Contato', 'paciente_id', $object, 'contato_paciente', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $enderecos_paciente_items = $this->loadItems('Enderecos', 'paciente_id', $object, 'enderecos_paciente', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $convenios_paciente_items = $this->loadItems('Convenios', 'paciente_id', $object, 'convenios_paciente', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $this->form->setData($object); // fill the form 

                $this->onReload();
                    
                   
                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        TSession::setValue('convenios_paciente_items', null);
        TSession::setValue('enderecos_paciente_items', null);
        TSession::setValue('contato_paciente_items', null);

        $this->onReload();
    }

    public function onAddConveniosPaciente( $param)
    {
        try
        {
            $data = $this->form->getData();
                        
            if(!$data->convenios_paciente_operadora_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Operadora'));
            }             
            if(!$data->convenios_paciente_plano_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Plano'));
            }             
            if(!$data->convenios_paciente_validade)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'validade'));
            }             
            if(!$data->convenios_paciente_tipo_plano_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Tipo de Plano'));
            }
                       
            $convenios_paciente_items = TSession::getValue('convenios_paciente_items');
            $key = isset($data->convenios_paciente_id) && $data->convenios_paciente_id ? $data->convenios_paciente_id : uniqid();
            $fields = []; 

            $fields['convenios_paciente_operadora_id'] = $data->convenios_paciente_operadora_id;
            $fields['convenios_paciente_matricula'] = $data->convenios_paciente_matricula;
            $fields['convenios_paciente_plano_id'] = $data->convenios_paciente_plano_id;
            $fields['convenios_paciente_validade'] = $data->convenios_paciente_validade;
            $fields['convenios_paciente_tipo_plano_id'] = $data->convenios_paciente_tipo_plano_id;
            $fields['convenios_paciente_via_cartao'] = $data->convenios_paciente_via_cartao;
            $convenios_paciente_items[ $key ] = $fields;
                       
            //Recupera o valor do tipo_atendimento
            $obj_tipoAtendimento = $data->tipo_atendimento_id;
                    
            //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
            $this->onVerifyTypeOfCare($obj_tipoAtendimento);
            
            TSession::setValue('convenios_paciente_items', $convenios_paciente_items);
                                     
            $data->convenios_paciente_id = '';
            $data->convenios_paciente_operadora_id = '';
            $data->convenios_paciente_matricula = '';
            $data->convenios_paciente_plano_id = '';
            $data->convenios_paciente_validade = '';
            $data->convenios_paciente_tipo_plano_id = '';
            $data->convenios_paciente_via_cartao = '';

            $this->form->setData($data);            
            
            new TMessage('info', 'Plano de Saúde adicionado com sucesso!');
          
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditConveniosPaciente( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('convenios_paciente_items');

        // get the session item
        $item = $items[$param['convenios_paciente_id_row_id']];

        $data->convenios_paciente_operadora_id = $item['convenios_paciente_operadora_id'];
        $data->convenios_paciente_matricula = $item['convenios_paciente_matricula'];
        $data->convenios_paciente_plano_id = $item['convenios_paciente_plano_id'];
        $data->convenios_paciente_validade = $item['convenios_paciente_validade'];
        $data->convenios_paciente_tipo_plano_id = $item['convenios_paciente_tipo_plano_id'];
        $data->convenios_paciente_via_cartao = $item['convenios_paciente_via_cartao'];

        $data->convenios_paciente_id = $param['convenios_paciente_id_row_id'];
        
        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }

    public function onDeleteConveniosPaciente( $param )
    {
        $data = $this->form->getData();
                
        $data->convenios_paciente_operadora_id = '';
        $data->convenios_paciente_matricula = '';
        $data->convenios_paciente_plano_id = '';
        $data->convenios_paciente_validade = '';
        $data->convenios_paciente_tipo_plano_id = '';
        $data->convenios_paciente_via_cartao = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('convenios_paciente_items');
        
        
      
        // delete the item from session
        unset($items[$param['convenios_paciente_id_row_id']]);
        TSession::setValue('convenios_paciente_items', $items);
        
        $convenio_session = TSession::getValue('convenios_paciente_items');
        
        if(isset($convenio_session)){
            if(empty($convenio_session)){
                //Atualiza o objeto $param com o valor recebido pela sessao
                $param['tipo_atendimento_id'] = "1";
                $tipoAtendimento = $param['tipo_atendimento_id'];
               
                //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
                $this->onVerifyTypeOfCare($tipoAtendimento);
                //Atualiza o objeto $data com o valor do $param
                $data->tipo_atendimento_id = $param['tipo_atendimento_id'];
                //Seta o valor atualizado para o field do formulario
                $this->form->setData($data);                                                            
            }
        }
      
        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadConveniosPaciente( $param, $tipoAtendimento = null )
    {
        $items = TSession::getValue('convenios_paciente_items'); 

        $this->convenios_paciente_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteConveniosPaciente')); 
                $action_del->setParameter('convenios_paciente_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditConveniosPaciente'));  
                $action_edi->setParameter('convenios_paciente_id_row_id', $key);  

                $button_del = new TButton('delete_convenios_paciente'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_convenios_paciente'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;      

                $rowItem->convenios_paciente_operadora_id = '';
                if(isset($item['convenios_paciente_operadora_id']) && $item['convenios_paciente_operadora_id'])
                {
                    TTransaction::open('consultorio');
                    $operadora = Operadora::find($item['convenios_paciente_operadora_id']);
                    if($operadora)
                    {
                        $rowItem->convenios_paciente_operadora_id = $operadora->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_matricula = isset($item['convenios_paciente_matricula']) ? $item['convenios_paciente_matricula'] : '';
                $rowItem->convenios_paciente_plano_id = '';
                if(isset($item['convenios_paciente_plano_id']) && $item['convenios_paciente_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $plano = Plano::find($item['convenios_paciente_plano_id']);
                    if($plano)
                    {
                        $rowItem->convenios_paciente_plano_id = $plano->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_validade = isset($item['convenios_paciente_validade']) ? $item['convenios_paciente_validade'] : '';
                $rowItem->convenios_paciente_tipo_plano_id = '';
                if(isset($item['convenios_paciente_tipo_plano_id']) && $item['convenios_paciente_tipo_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $tipo_plano = TipoPlano::find($item['convenios_paciente_tipo_plano_id']);
                    if($tipo_plano)
                    {
                        $rowItem->convenios_paciente_tipo_plano_id = $tipo_plano->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_via_cartao = isset($item['convenios_paciente_via_cartao']) ? $item['convenios_paciente_via_cartao'] : '';

                $row = $this->convenios_paciente_list->addItem($rowItem);

                $cont++;
            }
        }else{
            $this->onVerifyTypeOfCare($param);
        }  
        
        
    } 

    public function onAddEnderecosPaciente( $param )
    {
        try
        {
            $data = $this->form->getData();
                  
            if(!$data->enderecos_paciente_logradouro)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'logradouro'));
            }             
            if(!$data->enderecos_paciente_bairro)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'bairro'));
            }             
            if(!$data->enderecos_paciente_cidade)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'cidade'));
            }             
            if(!$data->enderecos_paciente_estado)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'estado'));
            }             
            if(!$data->enderecos_paciente_tipo_endereco_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'tipo de endereco'));
            } 
            
            // Verifica se existe tipo de atendimento e manda a variavel por parametro no metodo onVerifyTypeOfCare.
            // Este método recebe um parametro do tipo string referente ao tipo de atendimento selecionado
            // Ele retorna os campos do plano de saude habilitados ou desabilitados de acordo com o valor passado
             if($param['tipo_atendimento_id']){                   
                  $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
              }

            $enderecos_paciente_items = TSession::getValue('enderecos_paciente_items');
            $key = isset($data->enderecos_paciente_id) && $data->enderecos_paciente_id ? $data->enderecos_paciente_id : uniqid();
            $fields = []; 

            $fields['enderecos_paciente_cep'] = $data->enderecos_paciente_cep;
            $fields['enderecos_paciente_logradouro'] = $data->enderecos_paciente_logradouro;
            $fields['enderecos_paciente_numero'] = $data->enderecos_paciente_numero;
            $fields['enderecos_paciente_bairro'] = $data->enderecos_paciente_bairro;
            $fields['enderecos_paciente_complemento'] = $data->enderecos_paciente_complemento;
            $fields['enderecos_paciente_cidade'] = $data->enderecos_paciente_cidade;
            $fields['enderecos_paciente_estado'] = $data->enderecos_paciente_estado;
            $fields['enderecos_paciente_tipo_endereco_id'] = $data->enderecos_paciente_tipo_endereco_id;
            $enderecos_paciente_items[ $key ] = $fields;

            TSession::setValue('enderecos_paciente_items', $enderecos_paciente_items);

            $data->enderecos_paciente_id = '';
            $data->enderecos_paciente_cep = '';
            $data->enderecos_paciente_logradouro = '';
            $data->enderecos_paciente_numero = '';
            $data->enderecos_paciente_bairro = '';
            $data->enderecos_paciente_complemento = '';
            $data->enderecos_paciente_cidade = '';
            $data->enderecos_paciente_estado = '';
            $data->enderecos_paciente_tipo_endereco_id = '';

            $this->form->setData($data);
            
            new TMessage('info', 'Endereço adicionado com sucesso!');

            $this->onReload( $param );
            
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditEnderecosPaciente( $param )
    {
         $data = $this->form->getData();
 
        // read session items
        $items = TSession::getValue('enderecos_paciente_items');

        // get the session item
        $item = $items[$param['enderecos_paciente_id_row_id']];

        $data->enderecos_paciente_cep = $item['enderecos_paciente_cep'];
        $data->enderecos_paciente_logradouro = $item['enderecos_paciente_logradouro'];
        $data->enderecos_paciente_numero = $item['enderecos_paciente_numero'];
        $data->enderecos_paciente_bairro = $item['enderecos_paciente_bairro'];
        $data->enderecos_paciente_complemento = $item['enderecos_paciente_complemento'];
        $data->enderecos_paciente_cidade = $item['enderecos_paciente_cidade'];
        $data->enderecos_paciente_estado = $item['enderecos_paciente_estado'];
        $data->enderecos_paciente_tipo_endereco_id = $item['enderecos_paciente_tipo_endereco_id'];

        $data->enderecos_paciente_id = $param['enderecos_paciente_id_row_id'];

        // fill product fields
        $this->form->setData( $data );
        
        $this->onReload( $param);
    }

    public function onDeleteEnderecosPaciente( $param )
    {
        $data = $this->form->getData();

        $data->enderecos_paciente_cep = '';
        $data->enderecos_paciente_logradouro = '';
        $data->enderecos_paciente_numero = '';
        $data->enderecos_paciente_bairro = '';
        $data->enderecos_paciente_complemento = '';
        $data->enderecos_paciente_cidade = '';
        $data->enderecos_paciente_estado = '';
        $data->enderecos_paciente_tipo_endereco_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('enderecos_paciente_items');

        // delete the item from session
        unset($items[$param['enderecos_paciente_id_row_id']]);
        TSession::setValue('enderecos_paciente_items', $items);
        
        //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
        if($param['tipo_atendimento_id']){
            $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
        }
        
        // reload sale items
        $this->onReload( $param );
    }
    


    public function onReloadEnderecosPaciente( $param )
    {
        $items = TSession::getValue('enderecos_paciente_items'); 
        
        $this->enderecos_paciente_list->clear(); 
        
        if(!isset($param['tipo_atendimento_id'])){        
             $tipoAtendimento = "null";    
             $this->onVerifyTypeOfCare($tipoAtendimento);
         }else{         
             $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
         } 

        if($items) 
        { 
        
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteEnderecosPaciente')); 
                $action_del->setParameter('enderecos_paciente_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditEnderecosPaciente'));  
                $action_edi->setParameter('enderecos_paciente_id_row_id', $key);  

                $button_del = new TButton('delete_enderecos_paciente'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_enderecos_paciente'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;
                
                 if(isset($item['enderecos_paciente_items']) && !empty($item['enderecos_paciente_items'])){
                 
                     TTransaction::open('consultorio');
                     $paciente = Pacientes::find($item['enderecos_paciente_paciente_id']);
                       
                 }   

                $rowItem->convenios_paciente_operadora_id = '';
                if(isset($item['convenios_paciente_operadora_id']) && $item['convenios_paciente_operadora_id'])
                {
                    TTransaction::open('consultorio');
                    $operadora = Operadora::find($item['convenios_paciente_operadora_id']);
                    if($operadora)
                    {
                        $rowItem->convenios_paciente_operadora_id = $operadora->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_matricula = isset($item['convenios_paciente_matricula']) ? $item['convenios_paciente_matricula'] : '';
                $rowItem->convenios_paciente_plano_id = '';
                if(isset($item['convenios_paciente_plano_id']) && $item['convenios_paciente_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $plano = Plano::find($item['convenios_paciente_plano_id']);
                    if($plano)
                    {
                        $rowItem->convenios_paciente_plano_id = $plano->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_validade = isset($item['convenios_paciente_validade']) ? $item['convenios_paciente_validade'] : '';
                $rowItem->convenios_paciente_tipo_plano_id = '';
                if(isset($item['convenios_paciente_tipo_plano_id']) && $item['convenios_paciente_tipo_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $tipo_plano = TipoPlano::find($item['convenios_paciente_tipo_plano_id']);
                    if($tipo_plano)
                    {
                        $rowItem->convenios_paciente_tipo_plano_id = $tipo_plano->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_via_cartao = isset($item['convenios_paciente_via_cartao']) ? $item['convenios_paciente_via_cartao'] : '';
                $rowItem->enderecos_paciente_cep = isset($item['enderecos_paciente_cep']) ? $item['enderecos_paciente_cep'] : '';
                $rowItem->enderecos_paciente_logradouro = isset($item['enderecos_paciente_logradouro']) ? $item['enderecos_paciente_logradouro'] : '';
                $rowItem->enderecos_paciente_numero = isset($item['enderecos_paciente_numero']) ? $item['enderecos_paciente_numero'] : '';
                $rowItem->enderecos_paciente_bairro = isset($item['enderecos_paciente_bairro']) ? $item['enderecos_paciente_bairro'] : '';
                $rowItem->enderecos_paciente_complemento = isset($item['enderecos_paciente_complemento']) ? $item['enderecos_paciente_complemento'] : '';
                $rowItem->enderecos_paciente_cidade = isset($item['enderecos_paciente_cidade']) ? $item['enderecos_paciente_cidade'] : '';
                $rowItem->enderecos_paciente_estado = isset($item['enderecos_paciente_estado']) ? $item['enderecos_paciente_estado'] : '';
                $rowItem->enderecos_paciente_tipo_endereco_id = '';
                if(isset($item['enderecos_paciente_tipo_endereco_id']) && $item['enderecos_paciente_tipo_endereco_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_enderecos = TiposEnderecos::find($item['enderecos_paciente_tipo_endereco_id']);
                    if($tipos_enderecos)
                    {
                        $rowItem->enderecos_paciente_tipo_endereco_id = $tipos_enderecos->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $row = $this->enderecos_paciente_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddContatoPaciente( $param )
    {
        try
        {
        
        
            $data = $this->form->getData();
          
            if(!$data->contato_paciente_tipo_contato_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'telefone ou email, nome do contato e tipo de contato'));
            } 
                  
            //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
            if($param['tipo_atendimento_id']){
                $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
            }

            $contato_paciente_items = TSession::getValue('contato_paciente_items');
            $key = isset($data->contato_paciente_id) && $data->contato_paciente_id ? $data->contato_paciente_id : uniqid();
            $fields = []; 

            $fields['contato_paciente_telefone'] = $data->contato_paciente_telefone;
            $fields['contato_paciente_email'] = $data->contato_paciente_email;
            $fields['contato_paciente_nome_contato'] = $data->contato_paciente_nome_contato;
            $fields['contato_paciente_tipo_contato_id'] = $data->contato_paciente_tipo_contato_id;
            $contato_paciente_items[ $key ] = $fields;
            
            TSession::setValue('contato_paciente_items', $contato_paciente_items);
            
            
            $data->contato_paciente_id = '';
            $data->contato_paciente_telefone = '';
            $data->contato_paciente_email = '';
            $data->contato_paciente_nome_contato = '';
            $data->contato_paciente_tipo_contato_id = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditContatoPaciente( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('contato_paciente_items');

        // get the session item
        $item = $items[$param['contato_paciente_id_row_id']];

        $data->contato_paciente_telefone = $item['contato_paciente_telefone'];
        $data->contato_paciente_email = $item['contato_paciente_email'];
        $data->contato_paciente_nome_contato = $item['contato_paciente_nome_contato'];
        $data->contato_paciente_tipo_contato_id = $item['contato_paciente_tipo_contato_id'];

        $data->contato_paciente_id = $param['contato_paciente_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }

    public function onDeleteContatoPaciente( $param )
    {
        $data = $this->form->getData();

        $data->contato_paciente_telefone = '';
        $data->contato_paciente_email = '';
        $data->contato_paciente_nome_contato = '';
        $data->contato_paciente_tipo_contato_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('contato_paciente_items');

        // delete the item from session
        unset($items[$param['contato_paciente_id_row_id']]);
        TSession::setValue('contato_paciente_items', $items);
        
        //verifica qual o tipo de atendimento para tratar os fields de preenchimento do convenio
        if($param['tipo_atendimento_id']){
            $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
        }        

        // reload sale items
        $this->onReload( $param );
    }
  
    public function onReloadContatoPaciente( $param)
    {
        $items = TSession::getValue('contato_paciente_items'); 
        
        $this->onVerifyTypeOfCare('null');
        
        $this->contato_paciente_list->clear(); 

        if($items) 
        { 

            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteContatoPaciente')); 
                $action_del->setParameter('contato_paciente_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditContatoPaciente'));  
                $action_edi->setParameter('contato_paciente_id_row_id', $key);  

                $button_del = new TButton('delete_contato_paciente'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_contato_paciente'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;
                
                

                $rowItem->convenios_paciente_operadora_id = '';
                if(isset($item['convenios_paciente_operadora_id']) && $item['convenios_paciente_operadora_id'])
                {
                    TTransaction::open('consultorio');
                    $operadora = Operadora::find($item['convenios_paciente_operadora_id']);
                    if($operadora)
                    {
                        $rowItem->convenios_paciente_operadora_id = $operadora->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_matricula = isset($item['convenios_paciente_matricula']) ? $item['convenios_paciente_matricula'] : '';
                $rowItem->convenios_paciente_plano_id = '';
                if(isset($item['convenios_paciente_plano_id']) && $item['convenios_paciente_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $plano = Plano::find($item['convenios_paciente_plano_id']);
                    if($plano)
                    {
                        $rowItem->convenios_paciente_plano_id = $plano->render('{nome}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_validade = isset($item['convenios_paciente_validade']) ? $item['convenios_paciente_validade'] : '';
                $rowItem->convenios_paciente_tipo_plano_id = '';
                if(isset($item['convenios_paciente_tipo_plano_id']) && $item['convenios_paciente_tipo_plano_id'])
                {
                    TTransaction::open('consultorio');
                    $tipo_plano = TipoPlano::find($item['convenios_paciente_tipo_plano_id']);
                    if($tipo_plano)
                    {
                        $rowItem->convenios_paciente_tipo_plano_id = $tipo_plano->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $rowItem->convenios_paciente_via_cartao = isset($item['convenios_paciente_via_cartao']) ? $item['convenios_paciente_via_cartao'] : '';
                $rowItem->enderecos_paciente_cep = isset($item['enderecos_paciente_cep']) ? $item['enderecos_paciente_cep'] : '';
                $rowItem->enderecos_paciente_logradouro = isset($item['enderecos_paciente_logradouro']) ? $item['enderecos_paciente_logradouro'] : '';
                $rowItem->enderecos_paciente_numero = isset($item['enderecos_paciente_numero']) ? $item['enderecos_paciente_numero'] : '';
                $rowItem->enderecos_paciente_bairro = isset($item['enderecos_paciente_bairro']) ? $item['enderecos_paciente_bairro'] : '';
                $rowItem->enderecos_paciente_complemento = isset($item['enderecos_paciente_complemento']) ? $item['enderecos_paciente_complemento'] : '';
                $rowItem->enderecos_paciente_cidade = isset($item['enderecos_paciente_cidade']) ? $item['enderecos_paciente_cidade'] : '';
                $rowItem->enderecos_paciente_estado = isset($item['enderecos_paciente_estado']) ? $item['enderecos_paciente_estado'] : '';
                $rowItem->enderecos_paciente_tipo_endereco_id = '';
                if(isset($item['enderecos_paciente_tipo_endereco_id']) && $item['enderecos_paciente_tipo_endereco_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_enderecos = TiposEnderecos::find($item['enderecos_paciente_tipo_endereco_id']);
                    if($tipos_enderecos)
                    {
                        $rowItem->enderecos_paciente_tipo_endereco_id = $tipos_enderecos->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $rowItem->contato_paciente_telefone = isset($item['contato_paciente_telefone']) ? $item['contato_paciente_telefone'] : '';
                $rowItem->contato_paciente_email = isset($item['contato_paciente_email']) ? $item['contato_paciente_email'] : '';
                $rowItem->contato_paciente_nome_contato = isset($item['contato_paciente_nome_contato']) ? $item['contato_paciente_nome_contato'] : '';
                $rowItem->contato_paciente_tipo_contato_id = '';
                if(isset($item['contato_paciente_tipo_contato_id']) && $item['contato_paciente_tipo_contato_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_contato = TiposContato::find($item['contato_paciente_tipo_contato_id']);
                    if($tipos_contato)
                    {
                        $rowItem->contato_paciente_tipo_contato_id = $tipos_contato->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $row = $this->contato_paciente_list->addItem($rowItem);

                $cont++;
            } 
        }else{
            $this->onVerifyTypeOfCare($param['tipo_atendimento_id']);
        }  
    } 
  
    public function onShow($param = null)
    {
        
        TSession::setValue('convenios_paciente_items', null);
        TSession::setValue('enderecos_paciente_items', null);
        TSession::setValue('contato_paciente_items', null);

        $this->onReload();

    } 
    
    
     
    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadConveniosPaciente($params);
        $this->onReloadEnderecosPaciente($params);
        $this->onReloadContatoPaciente($params);
                       
    }
        
    public function show() 
    { 
        $param = func_get_arg(0);
        
                        
        if(!empty($param['current_tab']))
        {
            $this->form->setCurrentPage($param['current_tab']);
        }
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
    
    public static function onVerifyTypeOfCare($params = null)
    {
       if($params == null or $params == "1"){
            TDBCombo::disableField(self::$formName, 'convenios_paciente_operadora_id');
            TDBCombo::disableField(self::$formName, 'convenios_paciente_plano_id');
            TDBCombo::disableField(self::$formName, 'convenios_paciente_tipo_plano_id');
            TEntry::disableField(self::$formName, 'convenios_paciente_matricula');
            TDate::disableField(self::$formName, 'convenios_paciente_validade');
            TEntry::disableField(self::$formName, 'convenios_paciente_via_cartao');
            TButton::disableField(self::$formName, 'add_convenios_paciente');
       }
    
       if($params == "2"){
            TDBCombo::enableField(self::$formName, 'convenios_paciente_operadora_id');
            TDBCombo::enableField(self::$formName, 'convenios_paciente_operadora_id');
            TDBCombo::enableField(self::$formName, 'convenios_paciente_plano_id');
            TDBCombo::enableField(self::$formName, 'convenios_paciente_tipo_plano_id');
            TEntry::enableField(self::$formName, 'convenios_paciente_matricula');
            TDate::enableField(self::$formName, 'convenios_paciente_validade');
            TEntry::enableField(self::$formName, 'convenios_paciente_via_cartao');
            TButton::enableField(self::$formName, 'add_convenios_paciente');
       }
       
    }
    
}

