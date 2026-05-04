CREATE DATABASE tecfauna;
USE tecfauna;

CREATE TABLE usuarios (
id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR (120),
email VARCHAR (120),
senha VARCHAR (120),
data_nascimento DATE,
tipo ENUM('admin','usuario') NOT NULL DEFAULT 'usuario'
);

CREATE TABLE autoridades (
id_autoridade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome_autoridade VARCHAR (120),
tel_autoridade VARCHAR (80) NULL
);

CREATE TABLE local_fisico (
id_local_fisico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
bairro VARCHAR(120) NULL,
rua VARCHAR(120) NULL,
numero INT
);

CREATE TABLE local_online (
id_local_online INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
plataforma VARCHAR(120) NULL
);


CREATE TABLE denuncias (
id_denuncia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_usuario INT,
nome VARCHAR (120) NULL,
cpf VARCHAR (14) NULL,
email VARCHAR (120) NULL,
telefone VARCHAR (20) NULL,
tipo VARCHAR (120) NULL,
descricao TEXT NOT NULL,
estado CHAR(2) NULL,
cidade VARCHAR (120) NULL,
id_local_fisico INT,
id_local_online INT,
data_ocorrencia DATE NOT NULL,
id_autoridade INT,
nome_autoridade VARCHAR (120),
data_denuncia DATE,
status ENUM('pendente','aprovada','rejeitada') NOT NULL DEFAULT 'pendente',
FOREIGN KEY (id_autoridade) REFERENCES autoridades (id_autoridade),
FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
FOREIGN KEY (id_local_fisico) REFERENCES local_fisico (id_local_fisico),
FOREIGN KEY (id_local_online) REFERENCES local_online (id_local_online)
);

CREATE TABLE imagens (
id_imagem INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
imagem VARCHAR (120),
id_denuncia INT,
FOREIGN KEY (id_denuncia) REFERENCES denuncias (id_denuncia)
);

CREATE TABLE ongs (
id_ong INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome_ong VARCHAR (120),
telefone_ong VARCHAR (20),
email_ong VARCHAR (120),
insta_ong VARCHAR (120),
rua_ong VARCHAR (120) NULL,
bairro_ong VARCHAR (120),
cidade_ong VARCHAR (120),
estado_ong CHAR(2),
cep_ong VARCHAR (18) NULL,
link_site VARCHAR (120),
cnpj_ong VARCHAR (20),
descricao_ong TEXT
);

INSERT INTO autoridades (nome_autoridade,tel_autoridade) VALUES ('IBAMA','0800 61 8080'), 
('Polícia Federal','194'), 
('Polícia Civil (Delegacia de Meio Ambiente)','181'), 
('Polícia Militar Ambiental','190 ou 0800 0555 190'), 
('Secretaria Municipal de Meio Ambiente','153 (em cidades com GCM Ambiental) ou 156 (serviços municipais)');


INSERT INTO ongs (nome_ong,telefone_ong,email_ong,insta_ong,rua_ong,bairro_ong,cidade_ong,estado_ong,cep_ong,link_site,cnpj_ong,descricao_ong) VALUES
('SOS FAUNA-ORGÃO DE DEFESA DA FAUNA E FLORA BRASILEIRA', '+55 11 98323-7449', 'sosfauna@sosfauna.org.br', '@sosfauna', 'Pq. do Engenho','','São Paulo','SP','05892-360','https://share.google/lkqiNzf5PjjUmorYL','03.884.927/0001-20','Desde 2000, esta Organização Não Governamental (ONG) e sem fins lucrativos atua
com o objetivo de defender e conservar a fauna silvestre brasileira.
Suas ações incluem: Combater o tráfico de animais silvestres em todas as formas
como ele se manifesta, educar como ferramenta principal de ação e mitigar os danos
causados pelos criminosos, atuando ao lado das autoridades legalmente constituídas '),
('ONG PANTHERA BRASIL', '+55 (65) 99624-3355', 'contato@pantherabr.com.br', '@panthera_br', 'Fazenda Jofre Velho','','Poconé','MT','','https://share.google/MVVd6VDQ2wKhjhiC3','20.949.546/0001-09','A Organização Não Governamental (ONG) Panthera Brasil fundada em 2014, se dedica
exclusivamente a conservação das nove espécies nacionais de felinos selvagens e
seus ecossistemas.
Utilizando a experiência dos principais biólogos felinos do mundo, o Panthera Brasil
desenvolve e implementa estratégias globais para as sete espécies de grandes felinos.
O Panthera também estuda e protege as espécies de pequenos felinos mais
ameaçadas do mundo por meio de programas.'),
('WAITA- PESQUISA E CONSERVAÇÃO DA FAUNA SILVESTRE', '+55 (31)99649-4867', 'faleconosco@waita.org', '@waita.ong', '','','Belo Horizonte','MG','','https://share.google/eDuy9vvrKxV50YAJZ','13.704.197/0001','Fundado em 13 de outubro de 2010, o Waita – Instituto de Pesquisa e Conservação é a
materialização de um sonho de estudantes e profissionais de produzir ações que
melhorem o estado de conservação de espécies brasileiras. Atuam no resgate,
manejo, reabilitação e soltura de animais silvestres de diversas espécies,
principalmente as vítimas do tráfico.
'),
('MATA CILIAR- PRESERVAR VIDAS É DA NOSSA NATUREZA', '+55 (11) 4815-5777', ' adm@mataciliar.org.br', '@mataciliar', 'Rua XV de Novembro','','Centro Pedreira','SP','13920-000','https://share.google/tbe4GPGGDjIk15qI8','61.056.933/0001-95','A Associação Mata Ciliar (AMC) é uma entidade sem fins lucrativos declarada de
Utilidade Pública Federal e que desde 1987 desenvolve diversas ações para a
conservação da biodiversidade.
Durante esse período foram diversos desafios enfrentados e conquistas alcançadas
sempre em parceria com instituições privadas, poder público e com a sociedade.
'),
('ONG ASAS E AMIGOS', '+55 (31) 99303-1325', 'asaseamigos@hotmail.com', '@asaseamigos','','','Juatuba','MG','','https://share.google/Qd9HRGtEj9qHvmz8J', '','Desde 2001, a Asas e Amigos realiza o trabalho de resgate, tratamento e alojamento de
animais silvestres e domésticos oriundos do tráfico e maus tratos.
');

UPDATE usuarios SET tipo = 'admin' WHERE id_usuario = 1;

select*from usuarios;
select*from denuncias;
select*from autoridades;
select*from imagens;
select*from ongs;