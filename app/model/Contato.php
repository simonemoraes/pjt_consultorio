<?php

class Contato extends TRecord
{
    const TABLENAME  = 'contato';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    private $medico;
    private $paciente;
    private $tipo_contato;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('telefone');
        parent::addAttribute('email');
        parent::addAttribute('nome_contato');
        parent::addAttribute('tipo_contato_id');
        parent::addAttribute('paciente_id');
        parent::addAttribute('medico_id');
    }

    /**
     * Method set_medicos
     * Sample of usage: $var->medicos = $object;
     * @param $object Instance of Medicos
     */
    public function set_medico(Medicos $object)
    {
        $this->medico = $object;
        $this->medico_id = $object->id;
    }
    
    /**
     * Method get_medico
     * Sample of usage: $var->medico->attribute;
     * @returns Medicos instance
     */
    public function get_medico()
    {
        
        // loads the associated object
        if (empty($this->medico))
            $this->medico = new Medicos($this->medico_id);
        
        // returns the associated object
        return $this->medico;
    }
    /**
     * Method set_pacientes
     * Sample of usage: $var->pacientes = $object;
     * @param $object Instance of Pacientes
     */
    public function set_paciente(Pacientes $object)
    {
        $this->paciente = $object;
        $this->paciente_id = $object->id;
    }
    
    /**
     * Method get_paciente
     * Sample of usage: $var->paciente->attribute;
     * @returns Pacientes instance
     */
    public function get_paciente()
    {
        
        // loads the associated object
        if (empty($this->paciente))
            $this->paciente = new Pacientes($this->paciente_id);
        
        // returns the associated object
        return $this->paciente;
    }
    /**
     * Method set_tipos_contato
     * Sample of usage: $var->tipos_contato = $object;
     * @param $object Instance of TiposContato
     */
    public function set_tipo_contato(TiposContato $object)
    {
        $this->tipo_contato = $object;
        $this->tipo_contato_id = $object->id;
    }
    
    /**
     * Method get_tipo_contato
     * Sample of usage: $var->tipo_contato->attribute;
     * @returns TiposContato instance
     */
    public function get_tipo_contato()
    {
        
        // loads the associated object
        if (empty($this->tipo_contato))
            $this->tipo_contato = new TiposContato($this->tipo_contato_id);
        
        // returns the associated object
        return $this->tipo_contato;
    }
    
}

