import { useEffect, useState } from 'react';
import Layout from '../components/Layout';
import { Package, ArrowUpRight, ArrowDownRight, AlertTriangle } from 'lucide-react';
import api from '../api/axios';

export default function Dashboard() {
  const [data, setData] = useState({
    total_produtos: 0,
    entradas_hoje: 0,
    saidas_hoje: 0,
    estoque_baixo: []
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchDashboard();
  }, []);

  const fetchDashboard = async () => {
    try {
      const response = await api.get('/dashboard');
      setData(response.data);
    } catch (e) {
      console.error(e);
    } finally {
      setLoading(false);
    }
  };

  return (
    <Layout>
      {/* Cards de Métricas */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div className="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
          <div className="flex items-center gap-4 mb-4">
            <div className="p-3 bg-blue-50 text-blue-600 rounded-xl">
              <Package className="w-6 h-6" />
            </div>
            <h3 className="font-medium text-slate-600">Total de Produtos</h3>
          </div>
          <p className="text-3xl font-bold text-slate-800">{loading ? '...' : data.total_produtos}</p>
        </div>

        <div className="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
          <div className="flex items-center gap-4 mb-4">
            <div className="p-3 bg-green-50 text-green-600 rounded-xl">
              <ArrowUpRight className="w-6 h-6" />
            </div>
            <h3 className="font-medium text-slate-600">Entradas (Hoje)</h3>
          </div>
          <p className="text-3xl font-bold text-slate-800">{loading ? '...' : `+${data.entradas_hoje}`}</p>
        </div>

        <div className="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
          <div className="flex items-center gap-4 mb-4">
            <div className="p-3 bg-red-50 text-red-600 rounded-xl">
              <ArrowDownRight className="w-6 h-6" />
            </div>
            <h3 className="font-medium text-slate-600">Saídas (Hoje)</h3>
          </div>
          <p className="text-3xl font-bold text-slate-800">{loading ? '...' : `-${data.saidas_hoje}`}</p>
        </div>
      </div>

      {/* Alertas de Estoque */}
      <div className="bg-white rounded-2xl border border-red-100 shadow-sm overflow-hidden">
        <div className="bg-red-50 px-6 py-4 border-b border-red-100 flex items-center gap-3">
          <AlertTriangle className="w-5 h-5 text-red-600" />
          <h2 className="font-bold text-red-800">Atenção: Estoque Baixo ({data.estoque_baixo.length})</h2>
        </div>
        <div className="p-6">
          <p className="text-slate-600 mb-4 text-sm">Os produtos abaixo atingiram o nível de estoque mínimo e precisam de reposição urgente.</p>
          
          <div className="overflow-x-auto">
            <table className="w-full text-left border-collapse">
              <thead>
                <tr className="border-b border-slate-200">
                  <th className="py-3 font-medium text-slate-500 text-sm">Produto</th>
                  <th className="py-3 font-medium text-slate-500 text-sm">SKU / Código</th>
                  <th className="py-3 font-medium text-slate-500 text-sm">Estoque Atual</th>
                  <th className="py-3 font-medium text-slate-500 text-sm">Mínimo Ideal</th>
                </tr>
              </thead>
              <tbody>
                {loading ? (
                  <tr><td colSpan="4" className="py-4 text-slate-500 text-center">Carregando alertas...</td></tr>
                ) : data.estoque_baixo.length === 0 ? (
                  <tr><td colSpan="4" className="py-8 text-slate-500 text-center">Tudo certo! Nenhum produto com estoque crítico no momento.</td></tr>
                ) : (
                  data.estoque_baixo.map(item => (
                    <tr key={item.id} className="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                      <td className="py-3 font-medium text-slate-700">{item.nome}</td>
                      <td className="py-3 text-slate-500">{item.sku || '-'}</td>
                      <td className="py-3"><span className="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-sm font-semibold">{item.estoque_atual} un</span></td>
                      <td className="py-3 text-slate-500">{item.estoque_minimo} un</td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </Layout>
  );
}
