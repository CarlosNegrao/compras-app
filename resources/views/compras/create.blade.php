<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nova Compra</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>
    <h1>Nova Compra</h1>

    @if ($errors->any())
    <div style="color: red; margin-bottom: 1em;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="/compras">
        @csrf

        <label>Descrição:
            <input name="descricao" type="text" value="{{ old('descricao') }}" required>
        </label>
        <br><br>

        <label>Número de parcelas:
            <input name="numero_parcelas" type="number" min="1" value="{{ old('numero_parcelas') }}" required>
        </label>
        <br><br>

        <label>Valor da parcela:
            <input name="valor_parcela" type="number" step="0.01" min="0.01" value="{{ old('valor_parcela') }}" required>
        </label>
        <br><br>

        <label>Data da 1ª parcela (DD-MM-YYYY):
            <input name="data_primeira_parcela" type="text" value="{{ old('data_primeira_parcela') }}" required placeholder="ex: 28/06/2025">
        </label>
        <br><br>

        <button type="submit">Salvar Compra</button>
    </form>

    <p><a href="{{ url('/') }}">⬅️ Voltar ao Dashboard</a></p>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const campoData = document.querySelector('input[name="data_primeira_parcela"]');
        campoData.addEventListener('input', function (e) {
            let v = campoData.value.replace(/\D/g, '');
            if (v.length >= 2) v = v.slice(0,2) + '/' + v.slice(2);
            if (v.length >= 5) v = v.slice(0,5) + '/' + v.slice(5,9);
            campoData.value = v.slice(0, 10);
        });
    });
</script>
</body>
</html>
