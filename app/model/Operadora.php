<?php

class Operadora extends TRecord
{
    const TABLENAME  = 'operadora';
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
        $criteria->add(new TFilter('operadora_id', '=', $this->id));
        return Convenios::getObjects( $criteria );
    }
}

