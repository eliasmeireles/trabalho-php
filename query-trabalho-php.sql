DROP SCHEMA IF EXISTS trabalho_php;
CREATE SCHEMA trabalho_php;
USE trabalho_php;

CREATE TABLE funcionario(
	id CHAR(40) UNIQUE NOT NULL,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    cpf CHAR(14) NOT NULL UNIQUE,
    data_nascimento DATE NOT NULL,
    telefone CHAR(14) NOT NULL,
    filho BOOLEAN DEFAULT FALSE,
    quantidade_filhos INT(1) DEFAULT 0
);
ALTER TABLE funcionario ADD CONSTRAINT pk_funcionario PRIMARY KEY (id);


CREATE TABLE usuario_sistema(
	id BIGINT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
	funcionario_id CHAR(40) NOT NULL UNIQUE,
	senha CHAR(40) NOT NULL
);

ALTER TABLE usuario_sistema ADD CONSTRAINT fk_funcionario_id FOREIGN KEY (funcionario_id) REFERENCES funcionario(id);


CREATE TABLE estados(
	id INT NOT NULL AUTO_INCREMENT UNIQUE,
    nome VARCHAR(50) NOT NULL UNIQUE
);

ALTER TABLE estados ADD CONSTRAINT pk_estados PRIMARY KEY (id);

INSERT INTO estados (nome) VALUES ('Acre'), ('Alagoas'), ('Amapá'),
('Amazonas'), ('Bahia'), ('Ceará'), ('Distrito Federal'), ('Espírito Santo'), ('Goiás'),
('Maranhão'), ('Mato Grosso'), ('Minas Gerais'), ('Pará'), ('Paraíba'),
('Paraná'), ('Pernambuco'), ('Piauí'), ('Rio de Janeiro'), ('Rio Grande do Norte'), ('Rio Grande do Sul'),
('Rondônia'), ('Roraima'), ('Santa Catarina'), ('São Paulo'), ('Sergipe'), ('Tocantins');

CREATE TABLE endereco(
	id CHAR(40) UNIQUE NOT NULL,
    cep CHAR(9) NOT NULL,
    logradouro VARCHAR(150) NOT NULL,
    numero CHAR(50) NOT NULL,
	complemento CHAR(50) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado_id INT NOT NULL,
    funcionario_id CHAR(40) NOT NULL
);
ALTER TABLE endereco ADD CONSTRAINT pk_endereco PRIMARY KEY (id);
ALTER TABLE endereco ADD CONSTRAINT fk_endereco_funcionario_id FOREIGN KEY (funcionario_id) REFERENCES funcionario(id);
ALTER TABLE endereco ADD CONSTRAINT fk_estado_id FOREIGN KEY (estado_id) REFERENCES estados(id);

CREATE TABLE cargo (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    bonificacao DOUBLE(9,2)
);
INSERT INTO cargo (nome, salario) VALUES ('ADMINISTRADOR BANCO DADOS', 5477.83),
('ADMINISTRADOR', 2569.45), ('ADVOGADO', 4328.06), ('ADMINISTRADOR REDE', 4678.30), ('AGENTE ATENDIMENTO', 1560.23),
('CONSULTOR', 7928.56), ('ANALISTA PRODUTO', 4574.37), ('ANALISTA TI', 5313.06), ('CAIXA', 1526.15), ('CHEFE COMPRAS', 11490.90),
('CONTADOR', 6594.94), ('COORDENADOR', 4853.51), ('GERENTE BANCOS', 17187.08), ('GERENTE COBRANÇA', 6812.61), ('GERENTE CRÉDITO', 18453.50);

CREATE TABLE cargo_funcionario(
	cargo_id INT NOT NULL,
    	funcionario_id CHAR(40) NOT NULL
);
ALTER TABLE cargo_funcionario ADD CONSTRAINT fk_funcionario_cargo FOREIGN KEY (funcionario_id) REFERENCES funcionario(id);
ALTER TABLE cargo_funcionario ADD CONSTRAINT fk_cargo FOREIGN KEY (cargo_id) REFERENCES cargo(id);


