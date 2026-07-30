import { useEffect, useState } from 'react';
import Layout from '../components/Layout';
import { ArrowUpRight, ArrowDownRight, Calendar } from 'lucide-react';
import api from '../api/axios';

export default function Relatorio() {
  const [movimentacoes, setMovimentacoes] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchMovimentacoes();
  }, []);

  const fetchMovimentacoes = async () => {
    try {
      const { data } = await api.get('/movimentacoes');
      setMovimentacoes(data);
    } catch (e) {
      console.error('Erro ao buscar movimentações:', e);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleString('pt-BR', {
      day: '2-digit', month: '2-digit', year: 'numeric',
      hour: '2-digit', minute: '2-digit'
    });
  };

  return (
    <Layout>
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-xl font-bold text-slate-800">Histórico de Movimentações</h2>
        <button className="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl font-medium transition-colors flex items-center gap-2 shadow-sm text-sm">
          <Calendar className="w-4 h-4" />
          Últimos 30 dias
        </button>
      </div>

      <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        {loading ? (
          <div className="p-8 text-center text-slate-500">Carregando relatórios...</div>
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left border-collapse">
              <thead>
                <tr className="bg-slate-50 border-b border-slate-200 text-slate-600 font-medium text-sm">
                  <th className="py-4 px-6">Data/Hora</th>
                  <th className="py-4 px-6">Tipo</th>
                  <th className="py-4 px-6">Produto</th>
                  <th className="py-4 px-6">Qtd</th>
                  <th className="py-4 px-6">Responsável</th>
                  <th className="py-4 px-6">Motivo</th>
                </tr>
              </thead>
              <tbody>
                {movimentacoes.length === 0 ? (
                  <tr><td colSpan="6" className="py-12 text-center text-slate-500">Nenhuma movimentação registrada no sistema.</td></tr>
                ) : movimentacoes.map(m => (
                  <tr key={m.id} className="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td className="py-4 px-6 text-slate-500 text-sm whitespace-nowrap">{formatDate(m.created_at)}</td>
                    <td className="py-4 px-6">
                      {m.tipo === 'entrada' ? (
                        <span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                          <ArrowUpRight className="w-3 h-3" /> Entrada
                        </span>
                      ) : (
                        <span className="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                          <ArrowDownRight className="w-3 h-3" /> Saída
                        </span>
                      )}
                    </td>
                    <td className="py-4 px-6 font-medium text-slate-800">{m.produto?.nome || 'Produto apagado'}</td>
                    <td className="py-4 px-6 font-semibold">{m.quantidade}</td>
                    <td className="py-4 px-6 text-slate-600 text-sm">{m.usuario?.name || 'Sistema'}</td>
                    <td className="py-4 px-6 text-slate-500 text-sm truncate max-w-[200px]" title={m.motivo}>{m.motivo || '-'}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>
    </Layout>
  );
}
