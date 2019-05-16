begin; 

CREATE TABLE agendamento( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      horario_inicial datetime   NOT NULL  , 
      horario_final datetime   NOT NULL  , 
      titulo text   , 
      cor text   , 
      observacao text   , 
 PRIMARY KEY (id)); 

 CREATE TABLE contato( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      telefone int   , 
      email varchar  (100)   , 
      nome_contato varchar  (255)   , 
      tipo_contato_id int   , 
      paciente_id int   , 
      medico_id int   , 
 PRIMARY KEY (id)); 

 CREATE TABLE convenios( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      paciente_id int   , 
      operadora_id int   NOT NULL  , 
      matricula varchar  (45)   , 
      plano_id int   NOT NULL  , 
      tipo_plano_id int   NOT NULL  , 
      validade varchar  (45)   , 
      via_cartao int   , 
 PRIMARY KEY (id)); 

 CREATE TABLE enderecos( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
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
 PRIMARY KEY (id)); 

 CREATE TABLE especialidades( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      especialidade varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medico_especialidades( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      especialidade_id int   , 
      medico_id int   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medicos( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      cpf varchar  (45)   NOT NULL  , 
      crm varchar  (45)   NOT NULL  , 
 PRIMARY KEY (id)); 

 CREATE TABLE operadora( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE pacientes( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
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
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_plano( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      descricao varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_contato( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_enderecos( 
      id  INT  AUTO_INCREMENT    NOT NULL  , 
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