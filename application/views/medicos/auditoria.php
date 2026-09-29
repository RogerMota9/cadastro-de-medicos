<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Auditoria</h1>

        <a href="<?= site_url('medicos'); ?>" class="btn btn-secondary">
            Voltar
        </a>
    </div>

    <form method="get" action="<?= site_url('medicos/auditoria'); ?>" class="row mb-4">
        <div class="col-md-10">
            <input
                type="text"
                name="busca"
                class="form-control"
                placeholder="Buscar por nome ou CRM"
                value="<?= isset($busca) ? htmlspecialchars($busca) : ''; ?>"
            >
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                Buscar
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Ação</th>
                    <th>Médico</th>
                    <th>CRM</th>
                    <th>Usuário</th>
                    <th>Data</th>
                    <th>Dados antes</th>
                    <th>Dados depois</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($auditorias as $auditoria): ?>
                    <tr>
                        <td><?= htmlspecialchars($auditoria->acao); ?></td>

                        <td><?= htmlspecialchars($auditoria->nome); ?></td>

                        <td><?= htmlspecialchars($auditoria->crm); ?></td>

                        <td><?= htmlspecialchars($auditoria->usuario); ?></td>

                        <td><?= htmlspecialchars($auditoria->data_acao); ?></td>

                        <td>
                            <?php if ($auditoria->dados_antes): ?>
                                <pre class="mb-0"><?= htmlspecialchars(json_encode(json_decode($auditoria->dados_antes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                            <?php else: ?>
                                <span class="text-muted">Nenhum dado anterior</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($auditoria->dados_depois): ?>
                                <pre class="mb-0"><?= htmlspecialchars(json_encode(json_decode($auditoria->dados_depois), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                            <?php else: ?>
                                <span class="text-muted">Nenhum dado posterior</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>