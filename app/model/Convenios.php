<?php

class Convenios extends TRecord
{
    const TABLENAME  = 'convenios';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    private $paciente;
    private $tipo_plano;
    private $plano;
    private $operadora;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('paciente_id');
        parent::addAttribute('operadora_id');
        parent::addAttribute('matricula');
        parent::addAttribute('plano_id');
        parent::addAttribute('tipo_plano_id');
        parent::addAttribute('validade');
        parent::addAttribute('via_cartao');
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
     * Method set_tipo_plano
     * Sample of usage: $var->tipo_plano = $object;
     * @param $object Instance of TipoPlano
     */
    public function set_tipo_plano(TipoPlano $object)
    {
        $this->tipo_plano = $object;
        $this->tipo_plano_id = $object->id;
    }
    
    /**
     * Method get_tipo_plano
     * Sample of usage: $var->tipo_plano->attribute;
     * @returns TipoPlano instance
     */
    public function get_tipo_plano()
    {
        
        // loads the associated object
        if (empty($this->tipo_plano))
            $this->tipo_plano = new TipoPlano($this->tipo_plano_id);
        
        // returns the associated object
        return $this->tipo_plano;
    }
    /**
     * Method set_plano
     * Sample of usage: $var->plano = $object;
     * @param $object Instance of Plano
     */
    public function set_plano(Plano $object)
    {
        $this->plano = $object;
        $this->plano_id = $object->id;
    }
    
    /**
     * Method get_plano
     * Sample of usage: $var->plano->attribute;
     * @returns Plano instance
     */
    public function get_plano()
    {
        
        // loads the associated object
        if (empty($this->plano))
            $this->plano = new Plano($this->plano_id);
        
        // returns the associated object
        return $this->plano;
    }
    /**
     * Method set_operadora
     * Sample of usage: $var->operadora = $object;
     * @param $object Instance of Operadora
     */
    public function set_operadora(Operadora $object)
    {
        $this->operadora = $object;
        $this->operadora_id = $object->id;
    }
    
    /**
     * Method get_operadora
     * Sample of usage: $var->operadora->attribute;
     * @returns Operadora instance
     */
    public function get_operadora()
    {
        
        // loads the associated object
        if (empty($this->operadora))
            $this->operadora = new Operadora($this->operadora_id);
        
        // returns the associated object
        return $this->operadora;
    }
    
}

