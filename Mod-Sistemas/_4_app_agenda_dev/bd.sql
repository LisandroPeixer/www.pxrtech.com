CREATE TABLE tb_status (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(25) NOT NULL
);

INSERT INTO tb_status (status) VALUES ('pendente');
INSERT INTO tb_status (status) VALUES ('realizado');

CREATE TABLE tb_tarefas1 (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  data date not null,
  abertura time not null,
  intervalo time not null,
  fechamento time not null,
  nome varchar(30) not null,
  email varchar(30) not null,
  id_status int(11) NOT NULL DEFAULT '1',
);


INSERT INTO tb_tarefas1(
	data, abertura, intervalo, fechamento, nome, email, id_status
	)values(
	'2020/02/01', '08:00:00', '01:00:00', '09:00:00', 'fred mercure', 'fred@mercure.com', '1');
INSERT INTO tb_tarefas1(
	data, abertura, intervalo, fechamento, nome, email, id_status
	)values(
	'2020/02/02', '09:00:00', '01:00:00', '10:00:00', 'david bowie', 'david@bowie.com', '2');	