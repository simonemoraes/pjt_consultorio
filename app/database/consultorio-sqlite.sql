begin; 

PRAGMA foreign_keys=OFF; 

CREATE TABLE agendamento( 
      id  INTEGER    NOT NULL  , 
      horario_inicial datetime   NOT NULL  , 
      horario_final datetime   NOT NULL  , 
      titulo text   , 
      cor text   , 
      observacao text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE contato( 
      id  INTEGER    NOT NULL  , 
      telefone int   , 
      email varchar  (100)   , 
      nome_contato varchar  (255)   , 
      tipo_contato_id int   , 
      paciente_id int   , 
      medico_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(medico_id) REFERENCES medicos(id),
FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
FOREIGN KEY(tipo_contato_id) REFERENCES tipos_contato(id)); 

 CREATE TABLE convenios( 
      id  INTEGER    NOT NULL  , 
      paciente_id int   , 
      operadora_id int  (11)   NOT NULL  , 
      matricula varchar  (45)   , 
      plano_id int  (11)   NOT NULL  , 
      tipo_plano_id int  (11)   NOT NULL  , 
      validade varchar  (45)   , 
      via_cartao int   , 
 PRIMARY KEY (id),
FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
FOREIGN KEY(tipo_plano_id) REFERENCES tipo_plano(id),
FOREIGN KEY(plano_id) REFERENCES plano(id),
FOREIGN KEY(operadora_id) REFERENCES operadora(id)); 

 CREATE TABLE enderecos( 
      id  INTEGER    NOT NULL  , 
      cep varchar  (45)   , 
      logradouro varchar  (255)   , 
      numero varchar  (45)   , 
      complemento varchar  (45)   , 
      bairro varchar  (255)   , 
      cidade varchar  (45)   , 
      estado varchar  (45)   , 
      tipo_endereco_id int   , 
      paciente_id int   , 
      medico_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(medico_id) REFERENCES medicos(id),
FOREIGN KEY(paciente_id) REFERENCES pacientes(id),
FOREIGN KEY(tipo_endereco_id) REFERENCES tipos_enderecos(id)); 

 CREATE TABLE especialidades( 
      id  INTEGER    NOT NULL  , 
      especialidade varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medico_especialidades( 
      id  INTEGER    NOT NULL  , 
      especialidade_id int   , 
      medico_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(medico_id) REFERENCES medicos(id),
FOREIGN KEY(especialidade_id) REFERENCES especialidades(id)); 

 CREATE TABLE medicos( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      cpf varchar  (45)   NOT NULL  , 
      crm varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE operadora( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE pacientes( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      idade varchar  (45)   , 
      dt_nasc date   , 
      sexo varchar  (100)   , 
      cpf varchar  (45)   , 
      estado_civil varchar  (100)   , 
      rg varchar  (45)   NOT NULL  , 
      orgao_emissor varchar  (45)   , 
      nome_mae varchar  (255)   , 
      nome_pai varchar  (255)   , 
      dt_cadastro date   , 
      dt_ult_atendimento date   , 
      profissao varchar  (45)   , 
      conjugue varchar  (255)   , 
      empresa varchar  (100)   , 
      responsavel varchar  (255)   , 
      observacao text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE plano( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_plano( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_contato( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_enderecos( 
      id  INTEGER    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

  
 commit;