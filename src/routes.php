<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/cliente', function ($request, $response) {
	$db = $this->db;

	foreach($db->query('SELECT * FROM cliente') as $linha){
		$retorno[] = $linha;
	};

	return $response->withJson($retorno);
});

$app->post('/cliente', function ($request, $response) {
	$listaEspera = $request->getParsedBody();

	$listaEsperaInsert[] = $listaEspera['nome'];
	$listaEsperaInsert[] = $listaEspera['endereco'];
	$listaEsperaInsert[] = $listaEspera['numero'];
	$listaEsperaInsert[] = $listaEspera['loja'];
	$db = $this->db;

	$sth = $db->prepare("INSERT INTO cliente(nome, endereco,numero,loja) VALUES (?, ? , ? , ?)");

	try{
		$sth->execute($listaEsperaInsert);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	$lastInsertId = $db->lastInsertId();

	$sth = $db->prepare("SELECT * FROM cliente WHERE id = ?");
	
	try{
		$sth->execute(array($lastInsertId));
		$listaEsperaDB = $sth->fetch(PDO::FETCH_OBJ);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withJson($listaEsperaDB);
});

$app->delete('/cliente/{id}', function ($request, $response, $args) {
	$db = $this->db;

	$id[] = $args['id'];

	$sth = $db->prepare('DELETE FROM cliente WHERe id = ?');

	try{
		$sth->execute($id);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withStatus(200);
});

//TODO(2) Definir uma rota PUT
$app->put('/cliente/{id}', function ($request, $response, $args) {
	$db = $this->db;

	//TODO(3) Recuperar o corpo do request com getParsedBody
	$listaEspera = $request->getParsedBody();

	//TODO(4) Definir um SQL para atualizar a lista de espera
	$sth = $db->prepare('UPDATE cliente SET 
												    nome = ?
											      , endereco = ?
											      , numero = ?
											      , loja = ?
											 WHERE id = ?');

	$listaEsperaDB[] = $listaEspera['nome'];
	$listaEsperaDB[] = $listaEspera['endereco'];
	$listaEsperaDB[] = $listaEspera['numero'];
	$listaEsperaDB[] = $listaEspera['loja'];
	$listaEsperaDB[] = $args['id'];

	//TODO(5) Executar o SQL e retornar o código 404 em caso de erro e 200 em caso de sucesso
	try{
		$sth->execute($listaEsperaDB);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withStatus(200);
});


$app->get('/loja', function ($request, $response) {
	$db = $this->db;

	foreach($db->query('SELECT * FROM loja') as $linha){
		$retorno[] = $linha;
	};

	return $response->withJson($retorno);
});


$app->post('/loja', function ($request, $response) {
	$listaEspera = $request->getParsedBody();

	$listaEsperaInsert[] = $listaEspera['descricao'];
	$listaEsperaInsert[] = $listaEspera['endereco_loja'];
	$listaEsperaInsert[] = $listaEspera['numero'];
	$listaEsperaInsert[] = $listaEspera['telefone'];
	$db = $this->db;

	$sth = $db->prepare("INSERT INTO loja(descricao, endereco_loja,numero,telefone) VALUES (?, ? , ? , ?)");

	try{
		$sth->execute($listaEsperaInsert);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	$lastInsertId = $db->lastInsertId();

	$sth = $db->prepare("SELECT * FROM loja WHERE id = ?");
	
	try{
		$sth->execute(array($lastInsertId));
		$listaEsperaDB = $sth->fetch(PDO::FETCH_OBJ);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withJson($listaEsperaDB);
});


$app->delete('/loja/{id}', function ($request, $response, $args) {
	$db = $this->db;

	$id[] = $args['id'];

	$sth = $db->prepare('DELETE FROM loja WHERe id = ?');

	try{
		$sth->execute($id);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withStatus(200);
});

//TODO(2) Definir uma rota PUT
$app->put('/loja/{id}', function ($request, $response, $args) {
	$db = $this->db;

	//TODO(3) Recuperar o corpo do request com getParsedBody
	$listaEspera = $request->getParsedBody();

	//TODO(4) Definir um SQL para atualizar a lista de espera
	$sth = $db->prepare('UPDATE loja SET 
												    descricao = ?
											      , endereco_loja = ?
											      , numero = ?
											      , telefone = ?
											 WHERE id = ?');

	$listaEsperaDB[] = $listaEspera['descricao'];
	$listaEsperaDB[] = $listaEspera['endereco_loja'];
	$listaEsperaDB[] = $listaEspera['numero'];
	$listaEsperaDB[] = $listaEspera['telefone'];
	$listaEsperaDB[] = $args['id'];

	//TODO(5) Executar o SQL e retornar o código 404 em caso de erro e 200 em caso de sucesso
	try{
		$sth->execute($listaEsperaDB);
	}catch(PDOException $e){
		return $response->withStatus(404);
	}

	return $response->withStatus(200);
});