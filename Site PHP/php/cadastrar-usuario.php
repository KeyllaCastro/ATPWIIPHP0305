<?php
 
include("conexao.php");
 
try {
    //verificar se o nome do usuário já existe
    $varVerifica = $pdo->prepare("SELECT COUNT (*) FROM login WHERE usuario = :usuario");
    $varVerifica->bindParam(':usuario', $usuario);
    $varVerifica->execute();
 
    if($varVerifica->fetchColumn() > 0) {
        echo"Usuario já cadastrado";
        exit;
    }
    //criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    //iniciar uma transação
    $pdo->beginTransaction();
 
    //Cadastrar usuarios na tabela de login
    $varLogin = $pdo->prepare("INSERT INTO login (usuario,senha) VALUES (:usuario, :senha)");
    $varLogin->bindParam(':usuario',$usuario);
    $varLogin->bindParam(':senha',$senha);
    $varLogin->execute();
 
    //preciso pegar o Id do login para inserir na tabela usuario, pois existe um relacionamento entre elas.
    $varUsuario = $pdo->lastInsertId();
 
    //Cadastrar usuarios na tabela usuarios    
    $varUsuario = $pdo->prepare('INSERT INTO usuario (nome, email, idLogin) VALUES (:nome, :email, :id_login');
    $varUsuario->bindParam(':id_login',$id_login);
    $varUsuario->bindParam(':nome', $nome);
    $varUsuario->bindParam(':email', $email);
    $varUsuario->execute();
 
    $pdo->commit();
    echo"Cadastro realizado com sucesso!";
 
}catch(PDOException $e){
    $pdo->rollBack();
    echo"Erro ao cadastrar", $e->getMessage();
}
?>