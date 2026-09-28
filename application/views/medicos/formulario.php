<?php
$editando = isset($medico);

if ($editando) {
    $action = site_url('medicos/atualizar/'.$medico->id);
    $nome = $medico->nome;
    $crm = $medico->crm;
    $especialidade = $medico->especialidade;
    $telefone = $medico->telefone;
    $email = $medico->email;
    $situacao = $medico->situacao ? 'true' : 'false';
} else {
    $action = site_url('medicos/salvar_medico');
    $nome = set_value('nome');
    $crm = set_value('crm');
    $especialidade = set_value('especialidade');
    $telefone = set_value('telefone');
    $email = set_value('email');
    $situacao = set_value('situacao', 'true');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editando ? 'Editar médico' : 'Cadastrar médico'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h1 class="text-center mb-4">
                        <?= $editando ? 'Editar médico' : 'Cadastrar médico'; ?>
                    </h1>

                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($erro_crm)): ?>
                        <div class="alert alert-danger">
                            <?= html_escape($erro_crm); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= $action; ?>" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nome"
                                name="nome"
                                value="<?= html_escape($nome); ?>"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="crm" class="form-label">CRM</label>
                            <input
                                type="text"
                                class="form-control"
                                id="crm"
                                name="crm"
                                value="<?= html_escape($crm); ?>"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="especialidade" class="form-label">
                                Especialidade
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="especialidade"
                                name="especialidade"
                                value="<?= html_escape($especialidade); ?>"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">
                                Telefone
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="telefone"
                                name="telefone"
                                placeholder="Somente números"
                                value="<?= html_escape($telefone); ?>"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                E-mail
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                value="<?= html_escape($email); ?>"
                            >
                        </div>

                        <div class="mb-4">
                            <label for="situacao" class="form-label">
                                Situação
                            </label>

                            <select class="form-select" id="situacao" name="situacao">
                                <option value="true" <?= $situacao == 'true' ? 'selected' : ''; ?>>
                                    Ativo
                                </option>
                                <option value="false" <?= $situacao == 'false' ? 'selected' : ''; ?>>
                                    Inativo
                                </option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Salvar
                            </button>

                            <a href="<?= site_url('medicos'); ?>" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>