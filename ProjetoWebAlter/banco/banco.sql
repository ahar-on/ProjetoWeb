CREATE TABLE IF NOT EXISTS `tipos` (
  `id` INT NOT NULL auto_increment,
  `descricao` VARCHAR(45) NOT NULL,
  `numero_inicial` INT NOT NULL,
  `passo` INT NOT NULL,
  `quantidade_bilhetes` INT NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL auto_increment,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `foto` TEXT NULL,
  `admin` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`));


CREATE TABLE IF NOT EXISTS `rifas` (
  `id` INT NOT NULL auto_increment,
  `usuario_id` INT NOT NULL,
  `tipo_id` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` TEXT NULL,
  `data_provavel_sorteio` DATETIME NOT NULL,
  `data_inicio_venda` DATETIME NOT NULL,
  `data_fim_venda` DATETIME NOT NULL,
  `data_sorteio` DATETIME NULL,
  `valor_bilhete` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`tipo_id`)
    REFERENCES `tipos` (`id`),
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`));


CREATE TABLE IF NOT EXISTS `bilhetes` (
  `id` INT NOT NULL auto_increment,
  `rifa_id` INT NOT NULL,
  `usuario_id` INT NULL,
  `numero` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bilhetes_rifas1_idx` (`rifa_id` ASC),
  INDEX `fk_bilhetes_usuarios1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_bilhetes_rifas1`
    FOREIGN KEY (`rifa_id`)
    REFERENCES `rifas` (`id`),
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`));


CREATE TABLE IF NOT EXISTS `premios` (
  `id` INT NOT NULL auto_increment,
  `rifa_id` INT NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `colocacao` INT NOT NULL,
  `bilhete_sorteado_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_premios_bilhetes1_idx` (`bilhete_sorteado_id` ASC),
  INDEX `fk_premios_rifas1_idx` (`rifa_id` ASC),
  CONSTRAINT `fk_premios_bilhetes1`
    FOREIGN KEY (`bilhete_sorteado_id`)
    REFERENCES `bilhetes` (`id`),
    FOREIGN KEY (`rifa_id`)
    REFERENCES `rifas` (`id`));

