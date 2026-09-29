<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro de Médicos</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body>

<div class="container mt-5">



    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Cadastro de Médicos</h1>


        <div>

            <a
                href="<?= site_url('medicos/novo_medico'); ?>"
                class="btn btn-primary"
            >
                Cadastrar
            </a>


            <a
                href="<?= site_url('medicos/auditoria'); ?>"
                class="btn btn-secondary"
            >
                Auditoria
            </a>


            <a
                href="<?= site_url('login/sair'); ?>"
                class="btn btn-danger"
            >
                Sair
            </a>

        </div>

    </div>



    <form
        method="get"
        action="<?= site_url('medicos'); ?>"
        class="row mb-4"
    >

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

            <button
                type="submit"
                class="btn btn-primary w-100"
            >
                Buscar
            </button>

        </div>

    </form>



    <div class="table-responsive">

        <table class="table table-bordered table-striped align-middle">

            <thead>

                <tr>

                    <th>Nome</th>

                    <th>CRM</th>

                    <th>Especialidade</th>

                    <th>Telefone</th>

                    <th>E-mail</th>

                    <th>Situação</th>

                    <th>Data de cadastro</th>

                    <th>Ações</th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($medicos as $medico): ?>

                    <tr>



                        <td>
                            <?= htmlspecialchars($medico->nome); ?>
                        </td>



                        <td>
                            <?= htmlspecialchars($medico->crm); ?>
                        </td>



                        <td>
                            <?= htmlspecialchars($medico->especialidade); ?>
                        </td>



                        <td>
                            <?= htmlspecialchars($medico->telefone); ?>
                        </td>



                        <td>
                            <?= htmlspecialchars($medico->email); ?>
                        </td>



                        <td>

                            <?php if (
                                $medico->situacao === true ||
                                $medico->situacao === 't' ||
                                $medico->situacao === '1'
                            ): ?>

                                <span class="badge bg-success">
                                    Ativo
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Inativo
                                </span>

                            <?php endif; ?>

                        </td>



                        <td>
                            <?= htmlspecialchars($medico->data_cadastro); ?>
                        </td>



                        <td>

                            <a
                                href="<?= site_url('medicos/editar/' . $medico->id); ?>"
                                class="btn btn-warning btn-sm"
                            >
                                Editar
                            </a>


                            <?php if (
                                $medico->situacao === true ||
                                $medico->situacao === 't' ||
                                $medico->situacao === '1'
                            ): ?>



                                <a
                                    href="<?= site_url('medicos/excluir/' . $medico->id); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Deseja realmente inativar este médico?');"
                                >
                                    Inativar
                                </a>


                            <?php else: ?>



                                <a
                                    href="<?= site_url('medicos/ativar/' . $medico->id); ?>"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Deseja realmente ativar este médico?');"
                                >
                                    
                                </a>


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