<h1>Parcelas por mês (atual + 2)</h1>
<a href="{{ url('/compras/nova') }}" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #38bdf8; color: white; text-decoration: none; border-radius: 5px;">
    + Nova Compra
</a>
@foreach ($parcelas as $mes => $lista)
    <h2>{{ \Carbon\Carbon::createFromFormat('Y-m', $mes)->translatedFormat('F Y') }}</h2>
    <ul>
        @foreach ($lista as $parcela)
            <li>
                {{ $parcela->compra->descricao }} - Parcela {{ $parcela->numero }} -
                R$ {{ number_format($parcela->valor, 2, ',', '.') }} -
                {{ \Carbon\Carbon::parse($parcela->data)->format('d/m/Y') }} -
                {{ $parcela->paga ? '✅ Paga' : '❌ Não paga' }}
            </li>
        @endforeach
    </ul>
    <strong>Total mês:</strong> R$
    {{ number_format($lista->sum('valor'), 2, ',', '.') }}<br>
    <strong>Pagas:</strong> R$
    {{ number_format($lista->where('paga', true)->sum('valor'), 2, ',', '.') }}<br>
    <strong>Não pagas:</strong> R$
    {{ number_format($lista->where('paga', false)->sum('valor'), 2, ',', '.') }}<br><br>
@endforeach
