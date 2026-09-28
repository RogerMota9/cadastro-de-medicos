<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de medicos</title>
    <style>
        body {
    background-color: #F2F4F3;
    margin: 0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    color: #222;
}


.titulo {
    font-size: 30px;
    margin: 35px 5% 20px;
}



.novo-medico {
    display: inline-block;
    width: 190px;
    padding: 11px;
    margin-left: 5%;
    margin-bottom: 25px;

    background-color: #ffffff;
    border: 1px solid #d5d5d5;
    border-radius: 7px;

    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    color: #222;

    box-sizing: border-box;
    cursor: pointer;
    transition: 0.2s;
}

.novo-medico:hover {
    background-color: #eeeeee;
}



.lista_tabela {
    width: 90%;
    margin: 0 auto 40px;

    background-color: #ffffff;

    border-radius: 8px;
    overflow: hidden;
}



.tabela {
    width: 100%;

    border-collapse: collapse;
    table-layout: fixed;

    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 14px;

    background-color: #ffffff;
}



th {
    height: 50px;
    padding: 10px;

    background-color: #f5f5f5;

    font-size: 14px;
    text-align: center;

    border-bottom: 1px solid #dddddd;
}



td {
    padding: 12px 10px;

    text-align: center;
    vertical-align: middle;

    border-bottom: 1px solid #eeeeee;

    word-wrap: break-word;
}


tr {
    background-color: #ffffff;
}



.editar,
.excluir {
    width: 80px;
    padding: 8px;

    border: 1px solid #d5d5d5;
    border-radius: 5px;

    background-color: #ffffff;

    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 13px;

    cursor: pointer;
    transition: 0.2s;
}

.editar:hover,
.excluir:hover {
    background-color: #eeeeee;
}

       

    </style>
</head>
<body>

    <h1 class="titulo">LISTA DE MÉDICOS</h1>

    <a href="http://localhost/cadastro_de_medico/index.php/medicos/auditoria">
    <a class="novo-medico" href="http://localhost/cadastro_de_medico/index.php/medicos/auditoria">
    Auditoria
    </a>

    <a class="novo-medico" href="http://localhost/cadastro_de_medico/index.php/medicos/novo_medico">
    Novo médico
    </a>


    
    <div class="lista_tabela">

        <table class="tabela">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CRM</th>
                <th>ESPECIALIDADE</th>
                <th>TELEFONE</th>
                <th>EMAIL</th>
                <th>SITUAÇÃO</th>
                <th>DATA DE CADASTRO</th>
                <th>EDITAR</th>
                <th>EXCLUIR</th>
                
            </tr>

            <?php foreach ($medicos as $medico): ?>

                <tr>
                    <td><?= $medico->id ?></td>
                    <td><?= $medico->nome ?></td>
                    <td><?= $medico->crm ?></td>
                    <td><?= $medico->especialidade ?></td>
                    <td><?= $medico->telefone ?></td>
                    <td><?= $medico->email ?></td>
                    <td>
                        <?= $medico->situacao === 't' ? 'Ativo' : 'Inativo' ?>
                    </td>
                    <td><?= $medico->data_cadastro ?></td>
                    <td>
                        <a href="http://localhost/cadastro_de_medico/index.php/medicos/editar/<?= $medico->id ?>">
                            <button class="editar">Editar</button>
                        </a>
                    </td>

                    <td>
                        <a href="http://localhost/cadastro_de_medico/index.php/medicos/excluir/<?= $medico->id ?>"
                        onclick="return confirm('tem certeza que deseja excluir esse campo?')" >
                            <button class="excluir">Excluir</button>
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>
        </table>

                
    </div>
    
</body>
</html>
