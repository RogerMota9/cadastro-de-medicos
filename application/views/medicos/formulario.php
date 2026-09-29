<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Cadastrar Médico</h1>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($erro); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('medicos/salvar_medico'); ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control"
                value="<?= set_value('nome'); ?>"
            >
        </div>

        <div class="mb-3">
            <label for="crm" class="form-label">CRM</label>
            <input
                type="text"
                name="crm"
                id="crm"
                class="form-control"
                maxlength="6"
                value="<?= set_value('crm'); ?>"
            >
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade</label>
            <input
                type="text"
                name="especialidade"
                id="especialidade"
                class="form-control"
                value="<?= set_value('especialidade'); ?>"
            >
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input
                type="text"
                name="telefone"
                id="telefone"
                class="form-control"
                maxlength="11"
                value="<?= set_value('telefone'); ?>"
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input
                type="text"
                name="email"
                id="email"
                class="form-control"
                value="<?= set_value('email'); ?>"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Cadastrar
        </button>

        <a href="<?= site_url('medicos'); ?>" class="btn btn-secondary">
            Voltar
        </a>
    </form>
</div>
</body>
</html>