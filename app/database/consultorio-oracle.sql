begin; 

CREATE TABLE agendamento( 
      id number(10)    NOT NULL , 
      horario_inicial timestamp(0)    NOT NULL , 
      horario_final timestamp(0)    NOT NULL , 
      titulo CLOB   , 
      cor CLOB   , 
      observacao CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE contato( 
      id number(10)    NOT NULL , 
      telefone number(10)   , 
      email varchar  (100)   , 
      nome_contato varchar  (255)   , 
      tipo_contato_id number(10)   , 
      paciente_id number(10)   , 
      medico_id number(10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE convenios( 
      id number(10)    NOT NULL , 
      paciente_id number(10)   , 
      operadora_id number(10)  (11)    NOT NULL , 
      matricula varchar  (45)   , 
      plano_id number(10)  (11)    NOT NULL , 
      tipo_plano_id number(10)  (11)    NOT NULL , 
      validade varchar  (45)   , 
      via_cartao number(10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE enderecos( 
      id number(10)    NOT NULL , 
      cep varchar  (45)   , 
      logradouro varchar  (255)   , 
      numero varchar  (45)   , 
      complemento varchar  (45)   , 
      bairro varchar  (255)   , 
      cidade varchar  (45)   , 
      estado varchar  (45)   , 
      tipo_endereco_id number(10)   , 
      paciente_id number(10)   , 
      medico_id number(10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE especialidades( 
      id number(10)    NOT NULL , 
      especialidade varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medico_especialidades( 
      id number(10)    NOT NULL , 
      especialidade_id number(10)   , 
      medico_id number(10)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE medicos( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      cpf varchar  (45)    NOT NULL , 
      crm varchar  (45)    NOT NULL , 
 PRIMARY KEY (id)); 

 CREATE TABLE operadora( 
      id number(10)    NOT NULL , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE pacientes( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      idade varchar  (45)   , 
      dt_nasc date   , 
      sexo varchar  (100)   , 
      cpf varchar  (45)   , 
      estado_civil varchar  (100)   , 
      rg varchar  (45)    NOT NULL , 
      orgao_emissor varchar  (45)   , 
      nome_mae varchar  (255)   , 
      nome_pai varchar  (255)   , 
      dt_cadastro date   , 
      dt_ult_atendimento date   , 
      profissao varchar  (45)   , 
      conjugue varchar  (255)   , 
      empresa varchar  (100)   , 
      responsavel varchar  (255)   , 
      observacao CLOB   , 
 PRIMARY KEY (id)); 

 CREATE TABLE plano( 
      id number(10)    NOT NULL , 
      nome varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipo_plano( 
      id number(10)    NOT NULL , 
      descricao varchar  (45)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_contato( 
      id number(10)    NOT NULL , 
      descricao varchar  (100)   , 
 PRIMARY KEY (id)); 

 CREATE TABLE tipos_enderecos( 
      id number(10)    NOT NULL , 
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
 CREATE SEQUENCE agendamento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER agendamento_id_seq_tr 

BEFORE INSERT ON agendamento FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT agendamento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE contato_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER contato_id_seq_tr 

BEFORE INSERT ON contato FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT contato_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE convenios_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER convenios_id_seq_tr 

BEFORE INSERT ON convenios FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT convenios_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE enderecos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER enderecos_id_seq_tr 

BEFORE INSERT ON enderecos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT enderecos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE especialidades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER especialidades_id_seq_tr 

BEFORE INSERT ON especialidades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT especialidades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE medico_especialidades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER medico_especialidades_id_seq_tr 

BEFORE INSERT ON medico_especialidades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT medico_especialidades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE medicos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER medicos_id_seq_tr 

BEFORE INSERT ON medicos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT medicos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE operadora_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER operadora_id_seq_tr 

BEFORE INSERT ON operadora FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT operadora_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pacientes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pacientes_id_seq_tr 

BEFORE INSERT ON pacientes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pacientes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE plano_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER plano_id_seq_tr 

BEFORE INSERT ON plano FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT plano_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_plano_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_plano_id_seq_tr 

BEFORE INSERT ON tipo_plano FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_plano_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipos_contato_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipos_contato_id_seq_tr 

BEFORE INSERT ON tipos_contato FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipos_contato_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipos_enderecos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipos_enderecos_id_seq_tr 

BEFORE INSERT ON tipos_enderecos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipos_enderecos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
  
 commit;