<?php

class TipoPlano extends TRecord
{
    const TABLENAME  = 'tipo_plano';
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
     * Method getConvenioss
     */
    public function getConvenioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_plano_id', '=', $this->id));
        return Convenios::getObjects( $criteria );
    }
}

