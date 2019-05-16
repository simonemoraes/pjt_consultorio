<?php

class TiposEnderecos extends TRecord
{
    const TABLENAME  = 'tipos_enderecos';
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
     * Method getEnderecoss
     */
    public function getEnderecoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_endereco_id', '=', $this->id));
        return Enderecos::getObjects( $criteria );
    }
}

