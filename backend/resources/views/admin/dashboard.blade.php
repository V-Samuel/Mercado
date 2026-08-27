@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.produtos.index') }}">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Produtos</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $produtosCount }}</p>
            </a>
        </div>
        <a href="{{ route('admin.produtos.index') }}">
        <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        </a>
    </div>
    
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.categorias.index') }}">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Categorias</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $categoriasCount }}</p>
            </a>
        </div>
        <a href="{{ route('admin.categorias.index') }}">
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
        </a>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.movimentacoes.index') }}">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Movimentações</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $movimentacoesCount }}</p>
            <details class="group text-gray-500 text-sm mt-2">
                <summary class="flex items-center font-semibold cursor-pointer list-none text-gray-800">
                    <div class="mt-2 flex items-center gap-2">
                        <span>Produto Mais Movimentado</span>
                            <svg class="transition-transform group-open:rotate-180" fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                    </div>
                </summary>
                <div class="grid grid-rows-[0fr] opacity-0 transition-all duration-500 ease-in-out group-open:grid-rows-[1fr] group-open:opacity-100 group-open:mt-2">
                    <div class="overflow-hidden">
                        <p class="mt-2">{{ $produtoMaisMovimentado }}</p>
                    </div>
                </div>
            </details>
            </a>
        </div>
        <a href="{{ route('admin.movimentacoes.index') }}">
            <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
        </a>
    </div>

           

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.produtos.index') }}">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Total de Produtos Perto de Vencer</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $produtosPertoDeVencerCount }}</p>

                <details class="group text-gray-500 text-sm mt-2">
                    <summary class="flex items-center font-semibold cursor-pointer list-none text-gray-800">
                        @if ($produtosPertoDeVencerCount > 0)
                        <div class="mt-2 flex items-center gap-2">
                            <span>Mais Detalhes dos Produtos Perto de Vencer</span>
                                <svg class="transition-transform group-open:rotate-180" fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                        </div>
                        @endif
                    </summary>
                    <div class="grid grid-rows-[0fr] opacity-0 transition-all duration-500 ease-in-out group-open:grid-rows-[1fr] group-open:opacity-100 group-open:mt-2">
                        <div class="overflow-hidden">
                            <p class="mt-2">{{ $produtosPertoDeVencer }}</p>
                        </div>
                    </div>
                </details>

            </a>
        </div>
            <a href="{{ route('admin.produtos.index') }}">
            <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
            </div>
            </a>
        </div>

    <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.produtos.index') }}">
                <h2 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Produtos Abaixo do Estoque Mínimo</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $produtosAbaixoEstoqueMinimoCount }}</p>
            
            
                <details class="group text-gray-500 text-sm mt-2">
                    <summary class="flex items-center font-semibold cursor-pointer list-none text-gray-800">
                    @if ($produtosAbaixoEstoqueMinimoCount > 0)
                    <div class="mt-2 flex items-center gap-2">
                        <span>Mais Detalhes dos Produtos Abaixo do Estoque Mínimo</span>
                            <svg class="transition-transform group-open:rotate-180" fill="none" height="24" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="6 9 12 15 18 9"></polyline>
                             </svg>
                    </div>
                    @endif
                    </summary>
                    <div class="grid grid-rows-[0fr] opacity-0 transition-all duration-500 ease-in-out group-open:grid-rows-[1fr] group-open:opacity-100 group-open:mt-2">
                        <div class="overflow-hidden">
                            <p class="mt-2">{{ $produtosAbaixoEstoqueMinimo }}</p>
                        </div>
                    </div>
                </details>
            
            </a>    
        </div>
        <a href="{{ route('admin.produtos.index') }}">
        <div class="p-3 rounded-full {{ $produtosAbaixoEstoqueMinimoCount > 0 ? 'bg-red-200 text-red-600' : 'bg-yellow-100 text-yellow-600' }}">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        </a>
    </div>

</div>


<div class="w-full bg-white rounded-xl shadow-sm border border-gray-100 mt-6 p-4 md:p-6">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-800">Top 7 Produtos Mais Vendidos</h3>
    </div>
    <div id="bar-chart"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const options = {
        series: [{
            name: "Quantidade Vendida",
            data: @json($chartData)
        }],
        chart: {
            type: "bar",
            height: 350,
            width: "100%",
            toolbar: {
                show: false
            },
            fontFamily: "Inter, sans-serif"
        },
        colors: ["#4F46E5"],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                borderRadius: 4
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: @json($chartLabels),
            labels: {
                style: {
                    colors: "#6B7280",
                    fontSize: "13px"
                }
            }
        },
        yaxis: {
            title: {
                text: "Quantidade",
                style: {
                    fontSize: "15px",
                }
                
            },  
            labels: {
                style: {
                    colors: "#6B7280",
                    fontSize: "15px"

                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: "light",
            y: {
                formatter: function (val) {
                    return val + " unidades"
                }
            }
        },
        responsive: [{
            breakpoint: 768, // Aplica em telas menores que 768px (Tablets e Celulares)
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // MUITO ÚTIL: Deita as barras no mobile para caber os nomes longos
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            fontSize: "10px" // Reduz a fonte
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: "", // Remove a palavra "Quantidade" na lateral para ganhar espaço
                        style: {
                            fontSize: "0px"
                        }
                    },
                    labels: {
                        style: {
                            fontSize: "11px" // Reduz a fonte dos nomes
                        }
                    }
                }
            }
        }]
    };

    const chart = new ApexCharts(document.querySelector("#bar-chart"), options);
    chart.render();
});
</script>

@endsection
