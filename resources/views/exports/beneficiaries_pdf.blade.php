<!DOCTYPE html>
<html>

<head>
    <title>Listado de Beneficiarios</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #0b2e59;
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Oficina de la Discapacidad</h1>
        <h2>Listado de Usuarios Registrados</h2>
        <p>Fecha de generación: {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>RUT</th>
                <th>Comuna</th>
                <th>Perfil</th>
                <th>Discapacidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->full_name }}</td>
                    <td>{{ $beneficiary->rut }}</td>
                    <td>{{ $beneficiary->commune }}</td>
                    <td>{{ $beneficiary->profile_type }}</td>
                    <td>{{ $beneficiary->disability_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>