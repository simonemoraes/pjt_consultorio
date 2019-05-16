INSERT INTO enderecos (id,cep,logradouro,numero,complemento,bairro,cidade,estado,tipo_endereco_id,paciente_id,medico_id) VALUES (1,'','','','','','São João de Meriti','',null,null,null); 

INSERT INTO especialidades (id,especialidade) VALUES (1,'Cardiologia'); 

INSERT INTO especialidades (id,especialidade) VALUES (2,'Ginecologia'); 

INSERT INTO especialidades (id,especialidade) VALUES (3,'Clínica Médica'); 

INSERT INTO operadora (id,nome) VALUES (1,'Petrobrás'); 

INSERT INTO operadora (id,nome) VALUES (2,'Unimed'); 

INSERT INTO operadora (id,nome) VALUES (3,'Amil'); 

INSERT INTO plano (id,nome) VALUES (1,'Empresarial'); 

INSERT INTO plano (id,nome) VALUES (2,'Familiar'); 

INSERT INTO plano (id,nome) VALUES (3,'Individual'); 

INSERT INTO tipo_plano (id,descricao) VALUES (1,'Personal'); 

INSERT INTO tipo_plano (id,descricao) VALUES (2,'Omega'); 

INSERT INTO tipo_plano (id,descricao) VALUES (3,'Bradesco Top'); 

INSERT INTO tipos_contato (id,descricao) VALUES (1,'Residencial'); 

INSERT INTO tipos_contato (id,descricao) VALUES (2,'Comercial'); 

INSERT INTO tipos_contato (id,descricao) VALUES (3,'Celular'); 

INSERT INTO tipos_contato (id,descricao) VALUES (4,'Fixo'); 

INSERT INTO tipos_contato (id,descricao) VALUES (5,'Outro'); 

INSERT INTO tipos_contato (id,descricao) VALUES (6,'Recado'); 

INSERT INTO tipos_enderecos (id,descricao) VALUES (1,'Endereço Residencial'); 

INSERT INTO tipos_enderecos (id,descricao) VALUES (2,'Endereço Comercial'); 

INSERT INTO tipos_enderecos (id,descricao) VALUES (3,'Endereço Email'); 

INSERT INTO tipos_enderecos (id,descricao) VALUES (4,'Outros endereços'); 
