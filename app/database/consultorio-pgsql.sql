begin; 

CREATE TABLE agendamento( 
      id  SERIAL    NOT NULL  , 
      horario_inicial timestamp   NOT NULL  , 
      horario_final timestamp   NOT NULL  , 
      titulo text   , 
      cor text   , 
      observacao text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE contato( 
      id  SERIAL    NOT NULL  , 
      telefone integer   , 
      email varchar  (100)   , 
      nome_contato varchar  (255)   , 
      tipo_contato_id integer   , 
      paciente_id integer   , 
      medico_id integer   , 
 PRIMARY KEY (id)); 

 CREATE TABLE convenios( 
      id  SERIAL    NOT NULL  , 
      paciente_id integer   , 
      operadora_id integer   NOT NULL  , 
      matricula varchar  (45)   , 
      plano_id integer   NOT NULL  , 
      tipo_plano_id integer   NOT NULL  , 
      validade varchar  (45)   , 
      via_cartao integer   , 
 PRIMARY KEY (id)); 

 CREATE TABLE enderecos( 
      id  SERIAL    NOT NULL  , 
      cep varchar  (45)   , 
      logradouro varchar  (255)   , 
      numero varchar  (45)   , 
      complemento varchar  (45)   , 
      bairro varchar  (255)   , 
      cidade varchar  (45)   , 
      estado varchar  (45)   , 
      tipo_endereco_id integer   , 
      paciente_id integer   , 
      medico_id integer   , 
 PRIMARY KEY (id)); 

 CREATE TABLE especialidades( 
      id  SERIAL    NOT NULL  , 
      especialidade varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medico_especialidades( 
      id  SERIAL    NOT NULL  , 
      especialidade_id integer   , 
      medico_id integer   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medicos( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      cpf varchar  (45)   NOT NULL  , 
      crm varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE operadora( 
      id  SERIAL    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE pacientes( 
      id  SERIAL    NOT NULL  , 
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
      id  SERIAL    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_plano( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_contato( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_enderecos( 
      id  SERIAL    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

  
 ALTER TABLE contato ADD CONSTRAINT fk_contato_3 FOREIGN KEY (medico_id) references medicos(id); 
ALTER TABLE contato ADD CONSTRAINT fk_contato_2 FOREIGN KEY (paciente_id) references pacientes(id); 
ALTER TABLE contato ADD CONSTRAINT fk_contato_1 FOREIGN KEY (tipo_contato_id) references tipos_contato(id); 
ALTER TABLE convenios ADD CONSTRAINT fk_convenios_4 FOREIGN KEY (paciente_id) references pacientes(id); 
ALTER TABLE convenios ADD CONSTRAINT fk_convenios_3 FOREIGN KEY (tipo_plano_id) references tipo_plano(id); 
ALTER TABLE convenios ADD CONSTRAINT fk_convenios_2 FOREIGN KEY (plano_id) references plano(id); 
ALTER TABLE convenios ADD CONSTRAINT fk_convenios_1 FOREIGN KEY (operadora_id) references operadora(id); 
ALTER TABLE enderecos ADD CONSTRAINT fk_enderecos_3 FOREIGN KEY (medico_id) references medicos(id); 
ALTER TABLE enderecos ADD CONSTRAINT fk_enderecos_2 FOREIGN KEY (paciente_id) references pacientes(id); 
ALTER TABLE enderecos ADD CONSTRAINT fk_enderecos_1 FOREIGN KEY (tipo_endereco_id) references tipos_enderecos(id); 
ALTER TABLE medico_especialidades ADD CONSTRAINT fk_medico_especialidades_2 FOREIGN KEY (medico_id) references medicos(id); 
ALTER TABLE medico_especialidades ADD CONSTRAINT fk_medico_especialidades_1 FOREIGN KEY (especialidade_id) references especialidades(id); 
 
 commit;