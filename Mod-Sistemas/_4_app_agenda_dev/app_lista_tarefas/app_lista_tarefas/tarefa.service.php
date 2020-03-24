<?php


//CRUD
class TarefaService {

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa) {
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir() { //create
		$query = 'insert into tb_tarefas1(data, abertura, intervalo, fechamento, nome, email, id_status)values(:data, :abertura, :intervalo, :fechamento, :nome, :email, 1)';//novo
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data', $this->tarefa->__get('data'));
		$stmt->bindValue(':abertura', $this->tarefa->__get('abertura'));//novo
		$stmt->bindValue(':intervalo', $this->tarefa->__get('intervalo'));//novo
		$stmt->bindValue(':fechamento', $this->tarefa->__get('fechamento'));//novo
		$stmt->bindValue(':nome', $this->tarefa->__get('nome'));//novo
		$stmt->bindValue(':email', $this->tarefa->__get('email'));//novo

		$stmt->execute();
	}

	public function recuperar() { //read impressão de todas as tarefas
		$query = '
			select 
				t.id, s.status, t.data, t.abertura, t.intervalo, t.fechamento, t.nome, t.email
			from 
				tb_tarefas1 as t
				left join tb_status as s on (t.id_status = s.id)
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update

		$query = "update tb_tarefas1 set data=?, abertura=?, intervalo=?, fechamento=?, nome=?, email=? where id = ?";//novo

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('data'));
		$stmt->bindValue(2, $this->tarefa->__get('abertura'));
		$stmt->bindValue(3, $this->tarefa->__get('intervalo'));
		$stmt->bindValue(4, $this->tarefa->__get('fechamento'));
		$stmt->bindValue(5, $this->tarefa->__get('nome'));
		$stmt->bindValue(6, $this->tarefa->__get('email'));//novo
		$stmt->bindValue(7, $this->tarefa->__get('id'));
		return $stmt->execute(); 
	}

	public function remover() { //delete

		$query = 'delete from tb_tarefas1 where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada() { //update

		$query = "update tb_tarefas1 set id_status = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		return $stmt->execute(); 
	}

	public function recuperarTarefasPendentes() { //read impressão de tarefas pendentes
		$query = '
			select 
				t.id, s.status, t.data, t.abertura, t.intervalo, t.fechamento, t.nome, t.email
			from 
				tb_tarefas1 as t
				left join tb_status as s on (t.id_status = s.id)
			where
				t.id_status = :id_status
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>