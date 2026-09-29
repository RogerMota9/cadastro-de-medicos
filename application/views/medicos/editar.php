<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Médico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Médico</h1>

        <a href="<?= site_url('medicos'); ?>" class="btn btn-secondary">
            Voltar
        </a>
    </div>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($erro); ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('medicos/atualizar/' . $medico->id); ?>" method="post">

  
        <div class="mb-3">

            <label for="nome" class="form-label">
                Nome
            </label>

            <input
                type="text"
                class="form-control <?= form_error('nome') ? 'is-invalid' : ''; ?>"
                id="nome"
                name="nome"
                value="<?= set_value('nome', $medico->nome); ?>"
            >

            <?php if (form_error('nome')): ?>
                <div class="invalid-feedback">
                    <?= form_error('nome'); ?>
                </div>
            <?php endif; ?>

        </div>


        <div class="mb-3">

            <label for="crm" class="form-label">
                CRM
            </label>

            <input
                type="text"
                class="form-control <?= form_error('crm') ? 'is-invalid' : ''; ?>"
                id="crm"
                name="crm"
                maxlength="6"
                value="<?= set_value('crm', $medico->crm); ?>"
            >

            <?php if (form_error('crm')): ?>
                <div class="invalid-feedback">
                    <?= form_error('crm'); ?>
                </div>
            <?php endif; ?>

        </div>


        <div class="mb-3">

            <label for="especialidade" class="form-label">
                Especialidade
            </label>

            <input
                type="text"
                class="form-control <?= form_error('especialidade') ? 'is-invalid' : ''; ?>"
                id="especialidade"
                name="especialidade"
                value="<?= set_value('especialidade', $medico->especialidade); ?>"
            >

            <?php if (form_error('especialidade')): ?>
                <div class="invalid-feedback">
                    <?= form_error('especialidade'); ?>
                </div>
            <?php endif; ?>

        </div>


        <div class="mb-3">

            <label for="telefone" class="form-label">
                Telefone
            </label>

            <input
                type="text"
                class="form-control <?= form_error('telefone') ? 'is-invalid' : ''; ?>"
                id="telefone"
                name="telefone"
                maxlength="11"
                value="<?= set_value('telefone', $medico->telefone); ?>"
            >

            <?php if (form_error('telefone')): ?>
                <div class="invalid-feedback">
                    <?= form_error('telefone'); ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="mb-3">

            <label for="email" class="form-label">
                E-mail
            </label>

            <input
                type="text"
                class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>"
                id="email"
                name="email"
                value="<?= set_value('email', $medico->email); ?>"
            >

            <?php if (form_error('email')): ?>
                <div class="invalid-feedback">
                    <?= form_error('email'); ?>
                </div>
            <?php endif; ?>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Situação
            </label>

            <div>
                <?php if ($medico->situacao): ?>

                    <span class="badge bg-success">
                        Ativo
                    </span>

                <?php else: ?>

                    <span class="badge bg-danger">
                        Inativo
                    </span>

                <?php endif; ?>
            </div>

        </div>


        <button type="submit" class="btn btn-primary">
            Salvar alterações
        </button>

    </form>

</div>

</body>
</html>