<?php

class Especialidades extends TRecord
{
    const TABLENAME  = 'especialidades';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
      
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('especialidade');
    }

    
    /**
     * Method getMedicoEspecialidadess
     */
    public function getMedicoEspecialidadess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('especialidade_id', '=', $this->id));
        return MedicoEspecialidades::getObjects( $criteria );
    }
}

