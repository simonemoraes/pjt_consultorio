<?php

class Plano extends TRecord
{
    const TABLENAME  = 'plano';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
 
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
    }

    
    /**
     * Method getConvenioss
     */
    public function getConvenioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('plano_id', '=', $this->id));
        return Convenios::getObjects( $criteria );
    }
}

