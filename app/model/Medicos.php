<?php

class Medicos extends TRecord
{
    const TABLENAME  = 'medicos';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('cpf');
        parent::addAttribute('crm');
    }

    
    /**
     * Method getContatos
     */
    public function getContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('medico_id', '=', $this->id));
        return Contato::getObjects( $criteria );
    }
    /**
     * Method getEnderecoss
     */
    public function getEnderecoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('medico_id', '=', $this->id));
        return Enderecos::getObjects( $criteria );
    }
    /**
     * Method getMedicoEspecialidadess
     */
    public function getMedicoEspecialidadess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('medico_id', '=', $this->id));
        return MedicoEspecialidades::getObjects( $criteria );
    }
}

