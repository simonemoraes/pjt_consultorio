<?php

class Pacientes extends TRecord
{
    const TABLENAME  = 'pacientes';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('idade');
        parent::addAttribute('dt_nasc');
        parent::addAttribute('sexo');
        parent::addAttribute('cpf');
        parent::addAttribute('estado_civil');
        parent::addAttribute('rg');
        parent::addAttribute('orgao_emissor');
        parent::addAttribute('nome_mae');
        parent::addAttribute('nome_pai');
        parent::addAttribute('dt_cadastro');
        parent::addAttribute('dt_ult_atendimento');
        parent::addAttribute('profissao');
        parent::addAttribute('conjugue');
        parent::addAttribute('empresa');
        parent::addAttribute('responsavel');
        parent::addAttribute('observacao');
        parent::addAttribute('tipo_atendimento_id');
    }
    
    /**
     * Method set_tipo_atendimento
     * Sample of usage: $var->tipo_atendimento = $object;
     * @param $object Instance of TipoAtendimento
     */
    public function set_tipo_atendimento(TipoAtendimento $object)
    {
        $this->tipo_atendimento = $object;
        $this->tipo_atendimento_id = $object->id;
    }
    
    /**
     * Method get_tipo_atendimento
     * Sample of usage: $var->tipo_atendimento->attribute;
     * @returns TipoAtendimento instance
     */
    public function get_tipo_atendimento()
    {
        
        // loads the associated object
        if (empty($this->tipo_atendimento))
            $this->tipo_atendimento = new TipoAtendimento($this->tipo_atendimento_id);
        
        // returns the associated object
        return $this->tipo_atendimento;
    }

    
    /**
     * Method getConvenioss
     */
    public function getConvenioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('paciente_id', '=', $this->id));
        return Convenios::getObjects( $criteria );
    }
    /**
     * Method getContatos
     */
    public function getContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('paciente_id', '=', $this->id));
        return Contato::getObjects( $criteria );
    }
    /**
     * Method getEnderecoss
     */
    public function getEnderecoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('paciente_id', '=', $this->id));
        return Enderecos::getObjects( $criteria );
    }
}

