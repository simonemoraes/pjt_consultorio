<?php

class PacientesList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $formgrid;
    private $loaded;
    private $deleteButton;
    private static $database = 'consultorio';
    private static $activeRecord = 'Pacientes';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Pacientes';

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle('Listagem de paciente');


        $id = new TEntry('id');
        $dt_nasc = new TDate('dt_nasc');
        $dt_ult_atendimento = new TDate('dt_ult_atendimento');
        $nome = new TEntry('nome');
        $cpf = new TEntry('cpf');
        $nome_mae = new TEntry('nome_mae');
        $nome_pai = new TEntry('nome_pai');
        $responsavel = new TEntry('responsavel');
        $tipo_atendimento_descricao = new TEntry('tipo_atendimento_descricao');

        $id->setEditable(false);
        $dt_nasc->setDatabaseMask('yyyy-mm-dd');
        $dt_ult_atendimento->setDatabaseMask('yyyy-mm-dd');
        
        $dt_nasc->setMask('dd/mm/yyyy');
        $cpf->setMask('999.999.999-99');
        $dt_ult_atendimento->setMask('dd/mm/yyyy');
        
        $id->setSize(100);
        $cpf->setSize(240);
        $nome->setSize(420);
        $dt_nasc->setSize(150);
        $nome_mae->setSize(420);
        $nome_pai->setSize(420);
        $responsavel->setSize(420);
        $dt_ult_atendimento->setSize(140);
        $tipo_atendimento_descricao->setSize('70%');
                                    
        $row1 = $this->form->addFields([new TLabel('ID:', null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel('Data de Nascimento:', null, '14px', null)],[$dt_nasc],[],[]);
        $row3 = $this->form->addFields([new TLabel('Último Atendimento:', null, '14px', null)],[$dt_ult_atendimento],[],[]);
        $row4 = $this->form->addFields([new TLabel('Nome:', null, '14px', null)],[$nome],[],[]);
        $row5 = $this->form->addFields([new TLabel('CPF:', null, '14px', null)],[$cpf],[],[]);
        $row6 = $this->form->addFields([new TLabel('Nome da Mãe:', null, '14px', null)],[$nome_mae],[],[]);
        $row7 = $this->form->addFields([new TLabel('Nome do Pai:', null, '14px', null)],[$nome_pai],[],[]);
        $row8 = $this->form->addFields([new TLabel('Responsável:', null, '14px', null)],[$responsavel],[],[]);
        $row9 = $this->form->addFields([new TLabel('Tipo de Atendimento', null, '14px', null)],[$tipo_atendimento_descricao],[],[]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onexportcsv = $this->form->addAction('Exportar como CSV', new TAction([$this, 'onExportCsv']), 'fa:file-text-o #000000');

        $btn_onshow = $this->form->addAction('Cadastrar', new TAction(['PacientesForm', 'onShow']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', 'Id', 'center' , '70px');
        $column_nome = new TDataGridColumn('nome', 'Nome', 'left' , '350px');
        $column_cpf = new TDataGridColumn('cpf', 'CPF', 'left' , '120px');
        $column_dt_nasc_transformed = new TDataGridColumn('dt_nasc', 'Nascimento', 'left' , '120px');
        $column_dt_ult_atendimento_transformed = new TDataGridColumn('dt_ult_atendimento', 'Ult.Atendimento', 'left', '120px');
        $column_tipo_atendimento_descricao = new TDataGridColumn('tipo_atendimento->descricao', 'Tipo de atendimento ', 'left');
        
        $column_dt_nasc_transformed->setTransformer(function($value, $object, $row) 
        {
            if($value)
            {
                $date = new DateTime($value);
                return $date->format("d/m/Y");
            }
        });
        
        $column_dt_ult_atendimento_transformed->setTransformer(function($value, $object, $row) 
        {
            if($value)
            {
                $date = new DateTime($value);
                return $date->format("d/m/Y");
            }
        });    

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_cpf);
        $this->datagrid->addColumn($column_dt_nasc_transformed);
        $this->datagrid->addColumn($column_dt_ult_atendimento_transformed);
        $this->datagrid->addColumn($column_tipo_atendimento_descricao);

        $action_onEdit = new TDataGridAction(array('PacientesForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('PacientesList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel('Excluir');
        $action_onDelete->setImage('fa:trash-o #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(['Pessoas','Paciente']));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public function onExportCsv($param = null) 
    {
        try
        {
            $this->onSearch();

            TTransaction::open(self::$database); // open a transaction
            $repository = new TRepository(self::$activeRecord); // creates a repository for Customer
            $criteria = new TCriteria; // creates a criteria

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            $records = $repository->load($criteria); // load the objects according to criteria
            if ($records)
            {
                $file = 'tmp/'.uniqid().'.csv';
                $handle = fopen($file, 'w');
                $columns = $this->datagrid->getColumns();

                $csvColumns = [];
                foreach($columns as $column)
                {
                    $csvColumns[] = $column->getLabel();
                }
                fputcsv($handle, $csvColumns, ';');

                foreach ($records as $record)
                {
                    $csvColumns = [];
                    foreach($columns as $column)
                    {
                        $name = $column->getName();
                        $csvColumns[] = $record->{$name};
                    }
                    fputcsv($handle, $csvColumns, ';');
                }
                fclose($handle);

                TPage::openFile($file);
            }
            else
            {
                new TMessage('info', _t('No records found'));       
            }

            TTransaction::close(); // close the transaction
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new Pacientes($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('conjugue', 'like', "%{$data->id}%");// create the filter 
        }

        if (isset($data->dt_nasc) AND ( (is_scalar($data->dt_nasc) AND $data->dt_nasc !== '') OR (is_array($data->dt_nasc) AND (!empty($data->dt_nasc)) )) )
        {

            $filters[] = new TFilter('dt_nasc', '=', $data->dt_nasc);// create the filter 
        }

        if (isset($data->dt_ult_atendimento) AND ( (is_scalar($data->dt_ult_atendimento) AND $data->dt_ult_atendimento !== '') OR (is_array($data->dt_ult_atendimento) AND (!empty($data->dt_ult_atendimento)) )) )
        {

            $filters[] = new TFilter('dt_ult_atendimento', '=', $data->dt_ult_atendimento);// create the filter 
        }

        if (isset($data->nome) AND ( (is_scalar($data->nome) AND $data->nome !== '') OR (is_array($data->nome) AND (!empty($data->nome)) )) )
        {

            $filters[] = new TFilter('nome', 'like', "%{$data->nome}%");// create the filter 
        }

        if (isset($data->cpf) AND ( (is_scalar($data->cpf) AND $data->cpf !== '') OR (is_array($data->cpf) AND (!empty($data->cpf)) )) )
        {

            $filters[] = new TFilter('cpf', '=', $data->cpf);// create the filter 
        }

        if (isset($data->nome_mae) AND ( (is_scalar($data->nome_mae) AND $data->nome_mae !== '') OR (is_array($data->nome_mae) AND (!empty($data->nome_mae)) )) )
        {

            $filters[] = new TFilter('nome_mae', 'like', "%{$data->nome_mae}%");// create the filter 
        }

        if (isset($data->nome_pai) AND ( (is_scalar($data->nome_pai) AND $data->nome_pai !== '') OR (is_array($data->nome_pai) AND (!empty($data->nome_pai)) )) )
        {

            $filters[] = new TFilter('nome_pai', 'like', "%{$data->nome_pai}%");// create the filter 
        }

        if (isset($data->responsavel) AND ( (is_scalar($data->responsavel) AND $data->responsavel !== '') OR (is_array($data->responsavel) AND (!empty($data->responsavel)) )) )
        {

            $filters[] = new TFilter('responsavel', 'like', "%{$data->responsavel}%");// create the filter 
        }
        
        if (isset($data->tipo_atendimento_descricao) AND ( (is_scalar($data->tipo_atendimento_descricao) AND $data->tipo_atendimento_descricao !== '') OR (is_array($data->tipo_atendimento_descricao) AND (!empty($data->tipo_atendimento_descricao)) )) )
        {

            $filters[] = new TFilter('tipo_atendimento_id', 'in', "(SELECT id FROM tipo_atendimento WHERE descricao like '%{$data->tipo_atendimento_descricao}%')");// create the filter 
        }

        $param = array();
        $param['offset']     = 0;
        $param['first_page'] = 1;

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload($param);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'consultorio'
            TTransaction::open(self::$database);

            // creates a repository for Pacientes
            $repository = new TRepository(self::$activeRecord);
            $limit = 10;
            // creates a criteria
            $criteria = new TCriteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'asc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid

                    $this->datagrid->addItem($object);
                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  array('onReload', 'onSearch')))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

