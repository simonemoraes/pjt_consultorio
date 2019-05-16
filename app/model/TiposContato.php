<?php

class TiposContato extends TRecord
{
    const TABLENAME  = 'tipos_contato';
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
     * Method getContatos
     */
    public function getContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_contato_id', '=', $this->id));
        return Contato::getObjects( $criteria );
    }
}

