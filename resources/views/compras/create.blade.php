<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Compra</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>
    <h1>Nova Compra</h1>

    <form method="POST" action="/compras">
        @csrf

        <label>Descrição:
            <input name="descricao" type="text" required>
        </label>
        <br><br>

        <label>Número de parcelas:
            <input name="numero_parcelas" type="number" min="1" required>
        </label>
        <br><br>

        <label>Valor da parcela:
            <input name="valor_parcela" type="number" step="0.01" min="0.01" required>
        </label>
        <br><br>

        <label>Data da 1ª parcela (DD-MM-YYYY):
            <input name="data_primeira_parcela" type="text" required placeholder="ex: 28-06-2025">
        </label>
        <br><br>

        <button type="submit">Salvar Compra</button>
    </form>

    <p><a href="{{ url('/') }}">⬅️ Voltar ao Dashboard</a></p>
</body>
</html>
