<?php

class TipoAtendimento extends TRecord
{
    const TABLENAME  = 'tipo_atendimento';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
 
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('descricao');
    }

    
    /**
     * Method getPacientess
     */
    public function getPacientess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_atendimento_id', '=', $this->id));
        return Pacientes::getObjects( $criteria );
    }
}

