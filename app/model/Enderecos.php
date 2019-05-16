<?php

class Enderecos extends TRecord
{
    const TABLENAME  = 'enderecos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    const ENDERECO = '1';
    
    private $medico;
    private $paciente;
    private $tipo_endereco;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cep');
        parent::addAttribute('logradouro');
        parent::addAttribute('numero');
        parent::addAttribute('complemento');
        parent::addAttribute('bairro');
        parent::addAttribute('cidade');
        parent::addAttribute('estado');
        parent::addAttribute('tipo_endereco_id');
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
     * Method set_tipos_enderecos
     * Sample of usage: $var->tipos_enderecos = $object;
     * @param $object Instance of TiposEnderecos
     */
    public function set_tipo_endereco(TiposEnderecos $object)
    {
        $this->tipo_endereco = $object;
        $this->tipo_endereco_id = $object->id;
    }
    
    /**
     * Method get_tipo_endereco
     * Sample of usage: $var->tipo_endereco->attribute;
     * @returns TiposEnderecos instance
     */
    public function get_tipo_endereco()
    {
        
        // loads the associated object
        if (empty($this->tipo_endereco))
            $this->tipo_endereco = new TiposEnderecos($this->tipo_endereco_id);
        
        // returns the associated object
        return $this->tipo_endereco;
    }
    
}

