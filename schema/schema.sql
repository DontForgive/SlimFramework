create table loja(
id int AUTO_INCREMENT PRIMARY KEY,
descricao varchar(50),
endereco_loja varchar(200),
telefone varchar(20),
numero varchar(20)
);

create table cliente(
id int AUTO_INCREMENT PRIMARY KEY,
nome varchar(50),
endereco varchar(200),
numero varchar(20),
loja int,
FOREIGN KEY ( loja ) REFERENCES loja ( id)
);
