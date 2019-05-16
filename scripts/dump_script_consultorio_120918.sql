CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horario_inicial` datetime NOT NULL,
  `horario_final` datetime NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci,
  `cor` text COLLATE utf8_unicode_ci,
  `observacao` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `cidade_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ibge` int(11) NOT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` char(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5571 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_contato` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_contato_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contato_1` (`tipo_contato_id`),
  KEY `fk_contato_2` (`paciente_id`),
  KEY `fk_contato_3` (`medico_id`),
  CONSTRAINT `fk_contato_1` FOREIGN KEY (`tipo_contato_id`) REFERENCES `tipos_contato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contato_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contato_3` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `convenios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `operadora_id` int(11) NOT NULL,
  `matricula` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plano_id` int(11) NOT NULL,
  `tipo_plano_id` int(11) NOT NULL,
  `validade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `via_cartao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_convenios_1` (`operadora_id`),
  KEY `fk_convenios_2` (`plano_id`),
  KEY `fk_convenios_3` (`tipo_plano_id`),
  KEY `fk_convenios_4` (`paciente_id`),
  CONSTRAINT `fk_convenios_1` FOREIGN KEY (`operadora_id`) REFERENCES `operadora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_2` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_3` FOREIGN KEY (`tipo_plano_id`) REFERENCES `tipo_plano` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_convenios_4` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_endereco_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_1` (`tipo_endereco_id`),
  KEY `fk_enderecos_2` (`paciente_id`),
  KEY `fk_enderecos_3` (`medico_id`),
  CONSTRAINT `fk_enderecos_1` FOREIGN KEY (`tipo_endereco_id`) REFERENCES `tipos_enderecos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_enderecos_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_enderecos_3` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `medico_especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidade_id` int(11) DEFAULT NULL,
  `medico_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medico_especialidades_1` (`especialidade_id`),
  KEY `fk_medico_especialidades_2` (`medico_id`),
  CONSTRAINT `fk_medico_especialidades_1` FOREIGN KEY (`especialidade_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_medico_especialidades_2` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `crm` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `operadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idade` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `sexo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `orgao_emissor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_mae` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_pai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_cadastro` date DEFAULT NULL,
  `dt_ult_atendimento` date DEFAULT NULL,
  `profissao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conjugue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsavel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` text COLLATE utf8_unicode_ci,
  `tipo_atendimento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pacientes_1_idx` (`tipo_atendimento_id`),
  CONSTRAINT `fk_pacientes_1` FOREIGN KEY (`tipo_atendimento_id`) REFERENCES `tipo_atendimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tipo_atendimento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tipo_plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tipos_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tipos_enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

