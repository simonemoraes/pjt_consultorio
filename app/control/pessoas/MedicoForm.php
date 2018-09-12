<?php





class MedicoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'consultorio';
    private static $activeRecord = 'Medicos';
    private static $primaryKey = 'id';
    private static $formName = 'form_Medicos';

    
    
    
    
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
        $this->form->setFormTitle('Cadastro de Médico');

        
        
        
        
        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $cpf = new TEntry('cpf');
        $crm = new TEntry('crm');
        $medico_especialidades_medico_especialidade_id = new TDBCombo('medico_especialidades_medico_especialidade_id', 'consultorio', 'Especialidades', 'id', '{especialidade}','especialidade asc'  );
        $enderecos_medico_cep = new TEntry('enderecos_medico_cep');
        $button_buscar1 = new TButton('button_buscar1');
        $enderecos_medico_logradouro = new TEntry('enderecos_medico_logradouro');
        $enderecos_medico_numero = new TEntry('enderecos_medico_numero');
        $enderecos_medico_bairro = new TEntry('enderecos_medico_bairro');
        $enderecos_medico_complemento = new TEntry('enderecos_medico_complemento');
        $enderecos_medico_cidade = new TEntry('enderecos_medico_cidade');
        $enderecos_medico_estado = new TEntry('enderecos_medico_estado');
        $enderecos_medico_tipo_endereco_id = new TDBCombo('enderecos_medico_tipo_endereco_id', 'consultorio', 'TiposEnderecos', 'id', '{descricao}','descricao asc'  );
        $contato_medico_telefone = new TEntry('contato_medico_telefone');
        $contato_medico_email = new TEntry('contato_medico_email');
        $contato_medico_nome_contato = new TEntry('contato_medico_nome_contato');
        $contato_medico_tipo_contato_id = new TDBCombo('contato_medico_tipo_contato_id', 'consultorio', 'TiposContato', 'id', '{descricao}','descricao asc'  );
        $medico_especialidades_medico_id = new THidden('medico_especialidades_medico_id');
        $enderecos_medico_id = new THidden('enderecos_medico_id');
        $contato_medico_id = new THidden('contato_medico_id');

        $nome->addValidation('nome', new TRequiredValidator()); 
        $cpf->addValidation('cpf', new TRequiredValidator()); 
        $crm->addValidation('crm', new TRequiredValidator());        
        
        $cpf->setMask('999.999.999-99');
        $contato_medico_telefone->setMask('(99)99999-9999');
        $enderecos_medico_numero->setMask('9!');
        
        $id->setEditable(false);
        $button_buscar1->setAction(new TAction([$this, 'onSearchCep']), 'Buscar');
        $button_buscar1->addStyleClass('btn-primary');
        $button_buscar1->setImage('fa:search #ffffff');
        $id->setSize(120);
        $cpf->setSize(300);
        $nome->setSize(420);
        $crm->setSize('70%');
        $contato_medico_email->setSize(300);
        $enderecos_medico_cep->setSize(150);
        $enderecos_medico_cidade->setSize(300);
        $contato_medico_telefone->setSize(300);
        $enderecos_medico_estado->setSize(150);
        $enderecos_medico_bairro->setSize(300);
        $enderecos_medico_numero->setSize(150);
        $enderecos_medico_logradouro->setSize(420);
        $contato_medico_nome_contato->setSize(420);
        $enderecos_medico_complemento->setSize(150);
        $contato_medico_tipo_contato_id->setSize(300);
        $enderecos_medico_tipo_endereco_id->setSize(300);
        $medico_especialidades_medico_especialidade_id->setSize(300);

        $this->form->appendPage('Identificação');
        $row1 = $this->form->addContent([new TFormSeparator('Dados Pessoais', '#333333', '18', '#eeeeee')]);
        $row2 = $this->form->addFields([new TLabel('Id:', null, '14px', null)],[$id],[],[]);
        $row3 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$nome],[],[]);
        $row4 = $this->form->addFields([new TLabel('CPF:', null, '14px', null)],[$cpf],[],[]);
        $row5 = $this->form->addFields([new TLabel('CRM:', null, '14px', null)],[$crm],[],[]);
        $row6 = $this->form->addContent([new TFormSeparator('Especialidade', '#333333', '18', '#eeeeee')]);
        $row7 = $this->form->addFields([new TLabel('Especialidade:', null, '14px', null)],[$medico_especialidades_medico_especialidade_id]);
        $row8 = $this->form->addFields([$medico_especialidades_medico_id]);                 
        $add_medico_especialidades_medico = new TButton('add_medico_especialidades_medico');

        $action_medico_especialidades_medico = new TAction(array($this, 'onAddMedicoEspecialidadesMedico'));

        $add_medico_especialidades_medico->setAction($action_medico_especialidades_medico, 'Adicionar');
        $add_medico_especialidades_medico->setImage('fa:plus #000000');

        $this->form->addFields([$add_medico_especialidades_medico]);

        $this->medico_especialidades_medico_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->medico_especialidades_medico_list->style = 'width:100%';
        $this->medico_especialidades_medico_list->class .= ' table-bordered';
        $this->medico_especialidades_medico_list->disableDefaultClick();
        $this->medico_especialidades_medico_list->addQuickColumn('', 'edit', 'left', 10);
        $this->medico_especialidades_medico_list->addQuickColumn('', 'delete', 'left', 10);

        $column_medico_especialidades_medico_especialidade_id = $this->medico_especialidades_medico_list->addQuickColumn('Especialidade', 'medico_especialidades_medico_especialidade_id', 'left', '90%');

        $this->medico_especialidades_medico_list->createModel();
        $this->form->addContent([$this->medico_especialidades_medico_list]);
                
        $this->form->appendPage('Endereço');
        $row9 = $this->form->addContent([new TFormSeparator('Dados do Endereço', '#333333', '18', '#eeeeee')]);
        $row10 = $this->form->addFields([new TLabel('Cep:', null, '14px', null)],[$enderecos_medico_cep,$button_buscar1],[],[]);
        $row11 = $this->form->addFields([new TLabel('Logradouro:', null, '14px', null)],[$enderecos_medico_logradouro],[new TLabel('Número:', null, '14px', null)],[$enderecos_medico_numero]);
        $row12 = $this->form->addFields([new TLabel('Bairro:', null, '14px', null)],[$enderecos_medico_bairro],[new TLabel('Complemento:', null, '14px', null)],[$enderecos_medico_complemento]);
        $row13 = $this->form->addFields([new TLabel('Cidade:', null, '14px', null)],[$enderecos_medico_cidade],[new TLabel('Estado:', null, '14px', null)],[$enderecos_medico_estado]);
        $row14 = $this->form->addFields([new TLabel('Tipo de Endereço:', null, '14px', null)],[$enderecos_medico_tipo_endereco_id],[],[]);
        $row15 = $this->form->addFields([$enderecos_medico_id]);         
        $add_enderecos_medico = new TButton('add_enderecos_medico');

        $action_enderecos_medico = new TAction(array($this, 'onAddEnderecosMedico'));

        $add_enderecos_medico->setAction($action_enderecos_medico, 'Adicionar');
        $add_enderecos_medico->setImage('fa:plus #000000');

        $this->form->addFields([$add_enderecos_medico]);

        $this->enderecos_medico_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->enderecos_medico_list->style = 'width:100%';
        $this->enderecos_medico_list->class .= ' table-bordered';
        $this->enderecos_medico_list->disableDefaultClick();
        $this->enderecos_medico_list->addQuickColumn('', 'edit', 'left', 50);
        $this->enderecos_medico_list->addQuickColumn('', 'delete', 'left', 50);

        $column_enderecos_medico_cep = $this->enderecos_medico_list->addQuickColumn('Cep', 'enderecos_medico_cep', 'left');
        $column_enderecos_medico_logradouro = $this->enderecos_medico_list->addQuickColumn('Logradouro', 'enderecos_medico_logradouro', 'left');
        $column_enderecos_medico_numero = $this->enderecos_medico_list->addQuickColumn('Número', 'enderecos_medico_numero', 'left');
        $column_enderecos_medico_complemento = $this->enderecos_medico_list->addQuickColumn('Complemento', 'enderecos_medico_complemento', 'left');
        $column_enderecos_medico_bairro = $this->enderecos_medico_list->addQuickColumn('Bairro', 'enderecos_medico_bairro', 'left');
        $column_enderecos_medico_cidade = $this->enderecos_medico_list->addQuickColumn('Cidade', 'enderecos_medico_cidade', 'left');
        $column_enderecos_medico_estado = $this->enderecos_medico_list->addQuickColumn('Estado', 'enderecos_medico_estado', 'left');
        $column_enderecos_medico_tipo_endereco_id = $this->enderecos_medico_list->addQuickColumn('Tipo de Endereço', 'enderecos_medico_tipo_endereco_id', 'left');

        $this->enderecos_medico_list->createModel();
        $this->form->addContent([$this->enderecos_medico_list]);
        

        $this->form->appendPage('Contato');
        $row16 = $this->form->addContent([new TFormSeparator('Dados para Contato', '#333333', '18', '#eeeeee')]);
        $row17 = $this->form->addFields([new TLabel('Telefone:', null, '14px', null)],[$contato_medico_telefone]);
        $row18 = $this->form->addFields([new TLabel('Email:', null, '14px', null)],[$contato_medico_email]);
        $row19 = $this->form->addFields([new TLabel('Nome do Contato:', null, '14px', null)],[$contato_medico_nome_contato]);
        $row20 = $this->form->addFields([new TLabel('Tipo de Contato:', null, '14px', null)],[$contato_medico_tipo_contato_id]);
        $row21 = $this->form->addFields([$contato_medico_id]);         
        $add_contato_medico = new TButton('add_contato_medico');

        $action_contato_medico = new TAction(array($this, 'onAddContatoMedico'));

        $add_contato_medico->setAction($action_contato_medico, 'Adicionar');
        $add_contato_medico->setImage('fa:plus #000000');

        $this->form->addFields([$add_contato_medico]);

        $this->contato_medico_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->contato_medico_list->style = 'width:100%';
        $this->contato_medico_list->class .= ' table-bordered';
        $this->contato_medico_list->disableDefaultClick();
        $this->contato_medico_list->addQuickColumn('', 'edit', 'left', 10);
        $this->contato_medico_list->addQuickColumn('', 'delete', 'left', 10);

        $column_contato_medico_telefone = $this->contato_medico_list->addQuickColumn('Telefone', 'contato_medico_telefone', 'left', '150');
        $column_contato_medico_email = $this->contato_medico_list->addQuickColumn('Email', 'contato_medico_email', 'left', '250');
        $column_contato_medico_nome_contato = $this->contato_medico_list->addQuickColumn('Nome do Contato', 'contato_medico_nome_contato', 'left', '300');
        $column_contato_medico_tipo_contato_id = $this->contato_medico_list->addQuickColumn('Tipo de Contato', 'contato_medico_tipo_contato_id', 'left');

        $this->contato_medico_list->createModel();
        $this->form->addContent([$this->contato_medico_list]);
        
        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");
        
        // create the form actions
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');
        
        // vertical box container
        $container = new TVBox;
        $container->add($this->etapa);
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        //$container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);

        parent::add($container);

    }
    
    
    
    
    
    
    
    public static function onSearchCep($param = null) 
    {
        try 
        {
            //code here
            $resultado = @file_get_contents('https://viacep.com.br/ws/'.$param['enderecos_medico_cep'].'/json/');

            $result = json_decode($resultado);

             if($result !== null)
             {

                 $data = new StdClass;

                 $data->enderecos_medico_logradouro = $result->{'logradouro'};
                 $data->enderecos_medico_bairro = $result->{'bairro'};
                 $data->enderecos_medico_cidade = $result->{'localidade'};
                 $data->enderecos_medico_estado = $result->{'uf'}; 
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

            $object = new Medicos(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data
            
            $especialidadeMedico_session = TSession::getValue('medico_especialidades_medico_items');
            $enderecoMedico_session = TSession::getValue('enderecos_medico_items');
            $contatoMedico_session = TSession::getValue('contato_medico_items');
            
            // Verifica se existe especialidade cadastrada 
            if(empty($especialidadeMedico_session)){

                throw new Exception('Preencha pelo menos uma Especialidade!');         
            }

            // Verifica se existe endereco cadastrado
            if($enderecoMedico_session == NULL)
              {
                  throw new Exception('Preencha pelo menos um Endereço!');
              } 

             // Verifica se existe contato cadastrado  
             if($contatoMedico_session == NULL)
             {
                 throw new Exception('Preencha pelo menos um Contato!');
             }
          
            $object->store(); // save the object 

            $medico_especialidades_medico_items = $this->storeItems('MedicoEspecialidades', 'medico_id', $object, 'medico_especialidades_medico', function($masterObject, $detailObject){ 

                //code here

            }); 

            $contato_medico_items = $this->storeItems('Contato', 'medico_id', $object, 'contato_medico', function($masterObject, $detailObject){ 

                //code here

            }); 

            $enderecos_medico_items = $this->storeItems('Enderecos', 'medico_id', $object, 'enderecos_medico', function($masterObject, $detailObject){ 

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

                $object = new Medicos($key); // instantiates the Active Record 

                $medico_especialidades_medico_items = $this->loadItems('MedicoEspecialidades', 'medico_id', $object, 'medico_especialidades_medico', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $contato_medico_items = $this->loadItems('Contato', 'medico_id', $object, 'contato_medico', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $enderecos_medico_items = $this->loadItems('Enderecos', 'medico_id', $object, 'enderecos_medico', function($masterObject, $detailObject, $objectItems){ 

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

        TSession::setValue('medico_especialidades_medico_items', null);
        TSession::setValue('enderecos_medico_items', null);
        TSession::setValue('contato_medico_items', null);

        $this->onReload();
    }

    public function onAddMedicoEspecialidadesMedico( $param )
    {
        try
        {
            $data = $this->form->getData();
            
            
            if(!$data->medico_especialidades_medico_especialidade_id)
            {
            
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'especialidade'));
            }else{
                new TMessage('info', 'Especialidade inserida com sucesso!');
            }             

            $medico_especialidades_medico_items = TSession::getValue('medico_especialidades_medico_items');
            $key = isset($data->medico_especialidades_medico_id) && $data->medico_especialidades_medico_id ? $data->medico_especialidades_medico_id : uniqid();
            $fields = []; 

            $fields['medico_especialidades_medico_especialidade_id'] = $data->medico_especialidades_medico_especialidade_id;
            $medico_especialidades_medico_items[ $key ] = $fields;

            TSession::setValue('medico_especialidades_medico_items', $medico_especialidades_medico_items);

            $data->medico_especialidades_medico_id = '';
            $data->medico_especialidades_medico_especialidade_id = '';

            $this->form->setData($data);
            
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditMedicoEspecialidadesMedico( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('medico_especialidades_medico_items');

        // get the session item
        $item = $items[$param['medico_especialidades_medico_id_row_id']];

        $data->medico_especialidades_medico_especialidade_id = $item['medico_especialidades_medico_especialidade_id'];

        $data->medico_especialidades_medico_id = $param['medico_especialidades_medico_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }

    public function onDeleteMedicoEspecialidadesMedico( $param )
    {
        $data = $this->form->getData();

        $data->medico_especialidades_medico_especialidade_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('medico_especialidades_medico_items');

        // delete the item from session
        unset($items[$param['medico_especialidades_medico_id_row_id']]);
        TSession::setValue('medico_especialidades_medico_items', $items);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadMedicoEspecialidadesMedico( $param )
    {
        $items = TSession::getValue('medico_especialidades_medico_items'); 

        $this->medico_especialidades_medico_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteMedicoEspecialidadesMedico')); 
                $action_del->setParameter('medico_especialidades_medico_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditMedicoEspecialidadesMedico'));  
                $action_edi->setParameter('medico_especialidades_medico_id_row_id', $key);  

                $button_del = new TButton('delete_medico_especialidades_medico'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_medico_especialidades_medico'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->medico_especialidades_medico_especialidade_id = '';
                if(isset($item['medico_especialidades_medico_especialidade_id']) && $item['medico_especialidades_medico_especialidade_id'])
                {
                    TTransaction::open('consultorio');
                    $especialidades = Especialidades::find($item['medico_especialidades_medico_especialidade_id']);
                    if($especialidades)
                    {
                        $rowItem->medico_especialidades_medico_especialidade_id = $especialidades->render('{especialidade}');
                    }
                    TTransaction::close();
                }

                $row = $this->medico_especialidades_medico_list->addItem($rowItem);

                $cont++;
            } 
        } 
        
    } 

    public function onAddEnderecosMedico( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->enderecos_medico_logradouro)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'logradouro'));
            }             
            if(!$data->enderecos_medico_bairro)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'bairro'));
            }             
            if(!$data->enderecos_medico_cidade)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'cidade'));
            }             
            if(!$data->enderecos_medico_estado)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'estado'));
            }             
            if(!$data->enderecos_medico_tipo_endereco_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'tipo de endereco'));
            }             

            $enderecos_medico_items = TSession::getValue('enderecos_medico_items');
            $key = isset($data->enderecos_medico_id) && $data->enderecos_medico_id ? $data->enderecos_medico_id : uniqid();
            $fields = []; 

            $fields['enderecos_medico_cep'] = $data->enderecos_medico_cep;
            $fields['enderecos_medico_logradouro'] = $data->enderecos_medico_logradouro;
            $fields['enderecos_medico_numero'] = $data->enderecos_medico_numero;
            $fields['enderecos_medico_bairro'] = $data->enderecos_medico_bairro;
            $fields['enderecos_medico_complemento'] = $data->enderecos_medico_complemento;
            $fields['enderecos_medico_cidade'] = $data->enderecos_medico_cidade;
            $fields['enderecos_medico_estado'] = $data->enderecos_medico_estado;
            $fields['enderecos_medico_tipo_endereco_id'] = $data->enderecos_medico_tipo_endereco_id;
            $enderecos_medico_items[ $key ] = $fields;

            TSession::setValue('enderecos_medico_items', $enderecos_medico_items);

            $data->enderecos_medico_id = '';
            $data->enderecos_medico_cep = '';
            $data->enderecos_medico_logradouro = '';
            $data->enderecos_medico_numero = '';
            $data->enderecos_medico_bairro = '';
            $data->enderecos_medico_complemento = '';
            $data->enderecos_medico_cidade = '';
            $data->enderecos_medico_estado = '';
            $data->enderecos_medico_tipo_endereco_id = '';

            $this->form->setData($data);
            
            new TMessage('info', 'Endereço inserido com sucesso!');

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditEnderecosMedico( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('enderecos_medico_items');

        // get the session item
        $item = $items[$param['enderecos_medico_id_row_id']];

        $data->enderecos_medico_cep = $item['enderecos_medico_cep'];
        $data->enderecos_medico_logradouro = $item['enderecos_medico_logradouro'];
        $data->enderecos_medico_numero = $item['enderecos_medico_numero'];
        $data->enderecos_medico_bairro = $item['enderecos_medico_bairro'];
        $data->enderecos_medico_complemento = $item['enderecos_medico_complemento'];
        $data->enderecos_medico_cidade = $item['enderecos_medico_cidade'];
        $data->enderecos_medico_estado = $item['enderecos_medico_estado'];
        $data->enderecos_medico_tipo_endereco_id = $item['enderecos_medico_tipo_endereco_id'];

        $data->enderecos_medico_id = $param['enderecos_medico_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }

    public function onDeleteEnderecosMedico( $param )
    {
        $data = $this->form->getData();

        $data->enderecos_medico_cep = '';
        $data->enderecos_medico_logradouro = '';
        $data->enderecos_medico_numero = '';
        $data->enderecos_medico_bairro = '';
        $data->enderecos_medico_complemento = '';
        $data->enderecos_medico_cidade = '';
        $data->enderecos_medico_estado = '';
        $data->enderecos_medico_tipo_endereco_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('enderecos_medico_items');

        // delete the item from session
        unset($items[$param['enderecos_medico_id_row_id']]);
        TSession::setValue('enderecos_medico_items', $items);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadEnderecosMedico( $param )
    {
        
        $items = TSession::getValue('enderecos_medico_items'); 

        $this->enderecos_medico_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteEnderecosMedico')); 
                $action_del->setParameter('enderecos_medico_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditEnderecosMedico'));  
                $action_edi->setParameter('enderecos_medico_id_row_id', $key);  

                $button_del = new TButton('delete_enderecos_medico'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_enderecos_medico'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->medico_especialidades_medico_especialidade_id = '';
                if(isset($item['medico_especialidades_medico_especialidade_id']) && $item['medico_especialidades_medico_especialidade_id'])
                {
                    TTransaction::open('consultorio');
                    $especialidades = Especialidades::find($item['medico_especialidades_medico_especialidade_id']);
                    if($especialidades)
                    {
                        $rowItem->medico_especialidades_medico_especialidade_id = $especialidades->render('{especialidade}');
                    }
                    TTransaction::close();
                }

                $rowItem->enderecos_medico_cep = isset($item['enderecos_medico_cep']) ? $item['enderecos_medico_cep'] : '';
                $rowItem->enderecos_medico_logradouro = isset($item['enderecos_medico_logradouro']) ? $item['enderecos_medico_logradouro'] : '';
                $rowItem->enderecos_medico_numero = isset($item['enderecos_medico_numero']) ? $item['enderecos_medico_numero'] : '';
                $rowItem->enderecos_medico_bairro = isset($item['enderecos_medico_bairro']) ? $item['enderecos_medico_bairro'] : '';
                $rowItem->enderecos_medico_complemento = isset($item['enderecos_medico_complemento']) ? $item['enderecos_medico_complemento'] : '';
                $rowItem->enderecos_medico_cidade = isset($item['enderecos_medico_cidade']) ? $item['enderecos_medico_cidade'] : '';
                $rowItem->enderecos_medico_estado = isset($item['enderecos_medico_estado']) ? $item['enderecos_medico_estado'] : '';
                $rowItem->enderecos_medico_tipo_endereco_id = '';
                if(isset($item['enderecos_medico_tipo_endereco_id']) && $item['enderecos_medico_tipo_endereco_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_enderecos = TiposEnderecos::find($item['enderecos_medico_tipo_endereco_id']);
                    if($tipos_enderecos)
                    {
                        $rowItem->enderecos_medico_tipo_endereco_id = $tipos_enderecos->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $row = $this->enderecos_medico_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddContatoMedico( $param )
    {
        try
        {
            $data = $this->form->getData();
            
            // Verifica se existe o campo email e se o campo não está vazio
            if(isset($data->contato_medico_email) && !empty($data->contato_medico_email)){
                $email = $data->contato_medico_email;
                
                // Valida email com a funçao filter_var
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    new TMessage('info', 'Contato inserido com sucesso!');
                } else {
                    throw new Exception('Digite um email válido!');
                }
            }

            $contato_medico_items = TSession::getValue('contato_medico_items');
            $key = isset($data->contato_medico_id) && $data->contato_medico_id ? $data->contato_medico_id : uniqid();
            $fields = []; 

            $fields['contato_medico_telefone'] = $data->contato_medico_telefone;
            $fields['contato_medico_email'] = $data->contato_medico_email;
            $fields['contato_medico_nome_contato'] = $data->contato_medico_nome_contato;
            $fields['contato_medico_tipo_contato_id'] = $data->contato_medico_tipo_contato_id;
            $contato_medico_items[ $key ] = $fields;

            TSession::setValue('contato_medico_items', $contato_medico_items);

            $data->contato_medico_id = '';
            $data->contato_medico_telefone = '';
            $data->contato_medico_email = '';
            $data->contato_medico_nome_contato = '';
            $data->contato_medico_tipo_contato_id = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditContatoMedico( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('contato_medico_items');

        // get the session item
        $item = $items[$param['contato_medico_id_row_id']];

        $data->contato_medico_telefone = $item['contato_medico_telefone'];
        $data->contato_medico_email = $item['contato_medico_email'];
        $data->contato_medico_nome_contato = $item['contato_medico_nome_contato'];
        $data->contato_medico_tipo_contato_id = $item['contato_medico_tipo_contato_id'];

        $data->contato_medico_id = $param['contato_medico_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }

    public function onDeleteContatoMedico( $param )
    {
        $data = $this->form->getData();

        $data->contato_medico_telefone = '';
        $data->contato_medico_email = '';
        $data->contato_medico_nome_contato = '';
        $data->contato_medico_tipo_contato_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('contato_medico_items');

        // delete the item from session
        unset($items[$param['contato_medico_id_row_id']]);
        TSession::setValue('contato_medico_items', $items);

        // reload sale items
        $this->onReload( $param );
    }

    public function onReloadContatoMedico( $param )
    {
    
        $items = TSession::getValue('contato_medico_items'); 

        $this->contato_medico_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteContatoMedico')); 
                $action_del->setParameter('contato_medico_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditContatoMedico'));  
                $action_edi->setParameter('contato_medico_id_row_id', $key);  

                $button_del = new TButton('delete_contato_medico'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_contato_medico'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit = $button_edi;
                $rowItem->delete = $button_del;

                $rowItem->medico_especialidades_medico_especialidade_id = '';
                if(isset($item['medico_especialidades_medico_especialidade_id']) && $item['medico_especialidades_medico_especialidade_id'])
                {
                    TTransaction::open('consultorio');
                    $especialidades = Especialidades::find($item['medico_especialidades_medico_especialidade_id']);
                    if($especialidades)
                    {
                        $rowItem->medico_especialidades_medico_especialidade_id = $especialidades->render('{especialidade}');
                    }
                    TTransaction::close();
                }

                $rowItem->enderecos_medico_cep = isset($item['enderecos_medico_cep']) ? $item['enderecos_medico_cep'] : '';
                $rowItem->enderecos_medico_logradouro = isset($item['enderecos_medico_logradouro']) ? $item['enderecos_medico_logradouro'] : '';
                $rowItem->enderecos_medico_numero = isset($item['enderecos_medico_numero']) ? $item['enderecos_medico_numero'] : '';
                $rowItem->enderecos_medico_bairro = isset($item['enderecos_medico_bairro']) ? $item['enderecos_medico_bairro'] : '';
                $rowItem->enderecos_medico_complemento = isset($item['enderecos_medico_complemento']) ? $item['enderecos_medico_complemento'] : '';
                $rowItem->enderecos_medico_cidade = isset($item['enderecos_medico_cidade']) ? $item['enderecos_medico_cidade'] : '';
                $rowItem->enderecos_medico_estado = isset($item['enderecos_medico_estado']) ? $item['enderecos_medico_estado'] : '';
                $rowItem->enderecos_medico_tipo_endereco_id = '';
                if(isset($item['enderecos_medico_tipo_endereco_id']) && $item['enderecos_medico_tipo_endereco_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_enderecos = TiposEnderecos::find($item['enderecos_medico_tipo_endereco_id']);
                    if($tipos_enderecos)
                    {
                        $rowItem->enderecos_medico_tipo_endereco_id = $tipos_enderecos->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $rowItem->contato_medico_telefone = isset($item['contato_medico_telefone']) ? $item['contato_medico_telefone'] : '';
                $rowItem->contato_medico_email = isset($item['contato_medico_email']) ? $item['contato_medico_email'] : '';
                $rowItem->contato_medico_nome_contato = isset($item['contato_medico_nome_contato']) ? $item['contato_medico_nome_contato'] : '';
                $rowItem->contato_medico_tipo_contato_id = '';
                if(isset($item['contato_medico_tipo_contato_id']) && $item['contato_medico_tipo_contato_id'])
                {
                    TTransaction::open('consultorio');
                    $tipos_contato = TiposContato::find($item['contato_medico_tipo_contato_id']);
                    if($tipos_contato)
                    {
                        $rowItem->contato_medico_tipo_contato_id = $tipos_contato->render('{descricao}');
                    }
                    TTransaction::close();
                }

                $row = $this->contato_medico_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {
           
        TSession::setValue('medico_especialidades_medico_items', null);
        TSession::setValue('enderecos_medico_items', null);
        TSession::setValue('contato_medico_items', null);

        $this->onReload();

    } 

    public function onReload($params = null)
    {
        $this->loaded = TRUE;
        $this->onReloadMedicoEspecialidadesMedico($params);
        $this->onReloadEnderecosMedico($params);
        $this->onReloadContatoMedico($params);
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

}

