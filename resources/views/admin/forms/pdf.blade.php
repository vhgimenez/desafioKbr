<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dados em PDF</title>
</head>
<body>
    <h1>Dados Exportados em PDF</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Pet</th>
                <th>Data de Criação</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Número de Telefone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
                <tr>
                    <td>{{ $form->name }}</td>
                    <td>{{ $form->pet }}</td>
                    <td>{{ $form->created_at }}</td>
                    <td>{{ $form->email }}</td>
                    <td>{{ $form->cpf }}</td>
                    <td>{{ $form->telephone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>