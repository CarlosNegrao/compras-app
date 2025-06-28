<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Compra;
use App\Models\Parcela;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function create()
    {
        return view('compras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'numero_parcelas' => 'required|integer|min:1',
            'valor_parcela' => 'required|numeric|min:0.01',
            'data_primeira_parcela' => 'required|date_format:d/m/Y',
        ]);

        $dataInicial = Carbon::createFromFormat('d/m/Y', $request->data_primeira_parcela)->startOfDay();

        $compra = Compra::create([
            'descricao' => $request->descricao,
            'numero_parcelas' => $request->numero_parcelas,
            'valor_parcela' => $request->valor_parcela,
            'data_primeira_parcela' => $dataInicial,
        ]);

        for ($i = 0; $i < $request->numero_parcelas; $i++) {
            Parcela::create([
                'compra_id' => $compra->id,
                'numero' => $i + 1,
                'valor' => $request->valor_parcela,
                'data' => $dataInicial->copy()->addMonths($i),
                'paga' => false,
            ]);
        }

        return redirect('/');
    }

    public function dashboard()
    {
        // Atualiza parcelas vencidas como pagas
        Parcela::where('data', '<', now())->where('paga', false)->update(['paga' => true]);

        $hoje = now()->startOfMonth();

        $parcelas = Parcela::whereBetween('data', [$hoje, $hoje->copy()->addMonths(2)->endOfMonth()])
            ->get()
            ->groupBy(function ($parcela) {
                return Carbon::parse($parcela->data)->format('Y-m');
            });

        return view('dashboard', compact('parcelas'));
    }


}
