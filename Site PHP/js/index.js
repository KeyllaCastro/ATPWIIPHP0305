document.getElementById('form-cadastro-produto').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Simulação de cadastro (substitua pelo seu código PHP)
    Swal.fire({
        title: 'Sucesso!',
        text: 'Produto cadastrado com sucesso',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        this.reset(); // Limpa o formulário
    });
});