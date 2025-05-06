<?php
include("conexao.php");

// Receber dados do formulário
$nome = $_POST['nome']  ?? null;
$marca = $_POST['marca']  ?? null;
$preco = $_POST['preco']  ?? null;
$descricao = $_POST['descricao']  ?? null;
$quantidade = $_POST['quantidade']  ?? null;
$categoria = $_POST['categoria']  ?? null;
$data_cadastro = date('Y-m-d')  ?? null;
$ativo      = $_POST['ativo'] ?? 0;


if (!$nome || !$marca || !$preco || !$descricao || !$quantidade || !$categoria || !$data_cadastro || !$ativo ) {
    echo "Preencha todos os campos, por favor.";
    exit;
}


try {
    // Preparar e executar a query
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, marca, preco, descricao, quantidade, categoria, caminho_do_produto, data_cadastro, ativo) 
                          VALUES (:nome, :marca, :preco, :descricao, :quantidade, :categoria, :caminho_imagem, :data_cadastro, :ativo)");
    
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':caminho_imagem', $caminho_imagem);
    $stmt->bindParam(':data_cadastro', $data_cadastro);
    $stmt->bindParam(':ativo', $ativo);
    
    // Finalizar transação
    $pdo->commit();

    echo "Cadastro realizado com sucesso!";

    //caso o cadastro de erro, irá entrar no catch e exibir o erro.
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erro ao cadastrar: " . $e->getMessage();
}

?>