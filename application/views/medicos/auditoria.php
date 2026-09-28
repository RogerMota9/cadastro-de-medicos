<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de auditoria</title>

    <style>
    body {
    background-color: #E8ECEB;
    margin: 0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    color: #222;
    }

    .titulo {
        font-size: 30px;
        margin: 35px 5% 20px;
    }

    .voltar-lista {
        display: block;
        width: 190px;
        padding: 10px;
        margin: 35px 0 0 5%;
        background-color: #E8ECEB;
        border: 1px solid #C8CECC;
        border-radius: 7px;
        box-sizing: border-box;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        color: #222;
        cursor: pointer;
        transition: 0.2s;
    }

    .voltar-lista:hover {
        background-color: #D9DEDC;
    }

    .auditoria_tabela {
        width: 90%;
        margin: 0 auto 40px;
        border-collapse: collapse;
        table-layout: fixed;
        background-color: #FFFFFF;
        border-radius: 8px;
        overflow: hidden;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 13px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .auditoria_tabela th {
        height: 45px;
        padding: 10px;
        background-color: #DDE3E1;
        border-bottom: 1px solid #C8CECC;
        font-size: 13px;
        text-align: center;
    }

    .auditoria_tabela td {
        padding: 12px 10px;
        background-color: #FFFFFF;
        border-bottom: 1px solid #E2E5E4;
        vertical-align: top;
        text-align: center;
        word-wrap: break-word;
    }

    .auditoria_tabela pre {
        margin: 0;
        white-space: pre-wrap;
        word-break: break-word;
        text-align: left;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 12px;
        line-height: 1.5;
    }    
</style>
</head>
<body>

    <a class="voltar-lista" href="http://localhost/cadastro_de_medico/index.php/medicos">
    Voltar para lista
    </a>

    <h1 class="titulo">Auditoria</h1>

<table class="auditoria_tabela">

    <tr>
        <th>Id</th>
        <th>Ação</th>
        <th>Data</th>
        <th>Id Médico</th>
        <th>Dados antes</th>
        <th>Dados depois</th>
    </tr>

    <?php foreach ($auditorias as $auditoria): ?>

        <tr>
            <td><?= $auditoria->id ?></td>

            <td><?= $auditoria->acao ?></td>

            <td><?= $auditoria->data_acao ?></td>

            <td><?= $auditoria->id_medico ?></td>

            <td>
                <pre><?= $auditoria->dados_antes ?></pre>
            </td>

            <td>
                <pre><?= $auditoria->dados_depois ?></pre>
            </td>
        </tr>

    <?php endforeach; ?>

</table>
</body>
</html>