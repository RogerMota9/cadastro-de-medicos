<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de cadastro</title>
    <link rel="stylesheet" href="/application/views/medicos/formulario.css">
    <style>
        body {
    background-color: #E8ECEB;
    margin: 0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    color: #222;
}

.formulario-container {
    width: 90%;
    margin: 35px auto;
    background-color: #FFFFFF;
    padding: 30px;
    box-sizing: border-box;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.titulo {
    font-size: 30px;
    margin: 0 0 25px;
}

.formulario {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.formulario label {
    font-size: 14px;
}

.formulario input,
.formulario select {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    box-sizing: border-box;
    border: 1px solid #C8CECC;
    border-radius: 6px;
    background-color: #F4F6F5;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;
    outline: none;
}

.formulario input:focus,
.formulario select:focus {
    background-color: #FFFFFF;
    border-color: #8A9692;
}

.botao {
    width: 160px;
    padding: 10px;
    margin-top: 5px;
    background-color: #E8ECEB;
    border: 1px solid #C8CECC;
    border-radius: 6px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;
    cursor: pointer;
    transition: 0.2s;
}

.botao:hover {
    background-color: #D9DEDC;
}

.voltar-lista {
    display: block;
    width: 190px;
    padding: 10px;
    margin-bottom: 25px;
    background-color: #E8ECEB;
    border: 1px solid #C8CECC;
    border-radius: 7px;
    box-sizing: border-box;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;
    color: #222;
    text-align: center;
    text-decoration: none;
    color: #222;
    cursor: pointer;
    transition: 0.2s;
}

.voltar-lista:hover {
    background-color: #D9DEDC;
}

.erro {
    color: #A00000;
    margin-bottom: 15px;
    font-size: 14px;
}


    </style>
</head>
<body>
    
    <div class="formulario-container">

    <a class="voltar-lista" href="http://localhost/cadastro_de_medico/index.php/medicos">
        Voltar para lista
    </a>

    <h1 class="titulo">CADASTRO DE MÉDICO</h1>
  
    <?php if (validation_errors() != ''): ?>
        <div class="erro">
            <?= validation_errors() ?>
        </div>
    <?php endif; ?>

    
    <form class="formulario" action="http://localhost/cadastro_de_medico/index.php/medicos/salvar_medico" method="POST">

        <label>Nome:<input type="text" name="nome"></label>
        <label>CRM:<input type="text" name="crm"></label>
        <label>Especialidade:<input type="text" name="especialidade"></label>
        <label>Telefone:<input type="tel" name="telefone"></label>
        <label>Email:<input type="email" name="email"></label>

        <button class="botao" type="submit">Cadastrar</button>   

    </form>

</div>
</body>
</html>