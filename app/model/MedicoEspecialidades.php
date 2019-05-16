<?php

class MedicoEspecialidades extends TRecord
{
    const TABLENAME  = 'medico_especialidades';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    private $medico;
    private $especialidade;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('especialidade_id');
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
     * Method set_especialidades
     * Sample of usage: $var->especialidades = $object;
     * @param $object Instance of Especialidades
     */
    public function set_especialidade(Especialidades $object)
    {
        $this->especialidade = $object;
        $this->especialidade_id = $object->id;
    }
    
    /**
     * Method get_especialidade
     * Sample of usage: $var->especialidade->attribute;
     * @returns Especialidades instance
     */
    public function get_especialidade()
    {
        
        // loads the associated object
        if (empty($this->especialidade))
            $this->especialidade = new Especialidades($this->especialidade_id);
        
        // returns the associated object
        return $this->especialidade;
    }
    
}

