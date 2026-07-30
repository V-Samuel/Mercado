import { useEffect, useState } from 'react';
import Layout from '../components/Layout';
import { PackagePlus, Search, Edit2, Trash2, Plus, ArrowRightLeft, X } from 'lucide-react';
import api from '../api/axios';

export default function Produtos() {
  const [produtos, setProdutos] = useState([]);
  const [categorias, setCategorias] = useState([]);
  const [loading, setLoading] = useState(true);

  // Modals state
  const [showProdutoModal, setShowProdutoModal] = useState(false);
  const [showMovimentacaoModal, setShowMovimentacaoModal] = useState(false);
  const [showCategoriaModal, setShowCategoriaModal] = useState(false);

  // Forms state
  const [produtoForm, setProdutoForm] = useState({ nome: '', sku: '', preco_custo: '', preco_venda: '', estoque_minimo: 5, categoria_id: '' });
  const [movimentacaoForm, setMovimentacaoForm] = useState({ produto_id: '', tipo: 'entrada', quantidade: 1, motivo: '' });
  const [categoriaForm, setCategoriaForm] = useState({ nome: '' });

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const [prodRes, catRes] = await Promise.all([
        api.get('/produtos'),
        api.get('/categorias')
      ]);
      setProdutos(prodRes.data);
      setCategorias(catRes.data);
    } catch (e) {
      console.error('Erro ao buscar dados:', e);
    } finally {
      setLoading(false);
    }
  };

  const handleCreateProduto = async (e) => {
    e.preventDefault();
    try {
      await api.post('/produtos', produtoForm);
      setShowProdutoModal(false);
      setProdutoForm({ nome: '', sku: '', preco_custo: '', preco_venda: '', estoque_minimo: 5, categoria_id: '' });
      fetchData();
    } catch (e) {
      alert('Erro ao criar produto');
    }
  };

  const handleCreateCategoria = async (e) => {
    e.preventDefault();
    try {
      await api.post('/categorias', categoriaForm);
      setShowCategoriaModal(false);
      setCategoriaForm({ nome: '' });
      fetchData();
    } catch (e) {
      alert('Erro ao criar categoria');
    }
  };

  const handleCreateMovimentacao = async (e) => {
    e.preventDefault();
    try {
      await api.post('/movimentacoes', movimentacaoForm);
      setShowMovimentacaoModal(false);
      setMovimentacaoForm({ produto_id: '', tipo: 'entrada', quantidade: 1, motivo: '' });
      fetchData();
      alert('Movimentação registrada com sucesso!');
    } catch (e) {
      alert(e.response?.data?.message || 'Erro ao registrar movimentação');
    }
  };

  const formatCurrency = (value) => {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
  };

  return (
    <Layout>
      <div className="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div className="relative w-full md:w-96">
          <Search className="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
          <input 
            type="text" 
            placeholder="Buscar produtos..." 
            className="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50"
          />
        </div>
        <div className="flex items-center gap-3 w-full md:w-auto">
          <button onClick={() => setShowCategoriaModal(true)} className="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl font-medium transition-colors flex items-center gap-2 shadow-sm">
            <Plus className="w-4 h-4" /> Categoria
          </button>
          <button onClick={() => setShowMovimentacaoModal(true)} className="bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2.5 rounded-xl font-medium transition-colors flex items-center gap-2 shadow-sm">
            <ArrowRightLeft className="w-4 h-4" /> Movimentar
          </button>
          <button onClick={() => setShowProdutoModal(true)} className="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl font-medium transition-colors flex items-center gap-2 shadow-sm">
            <PackagePlus className="w-5 h-5" /> Novo Produto
          </button>
        </div>
      </div>

      <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        {loading ? (
          <div className="p-8 text-center text-slate-500">Carregando produtos...</div>
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left border-collapse">
              <thead>
                <tr className="bg-slate-50 border-b border-slate-200 text-slate-600 font-medium text-sm">
                  <th className="py-4 px-6">ID</th>
                  <th className="py-4 px-6">Nome / SKU</th>
                  <th className="py-4 px-6">Categoria</th>
                  <th className="py-4 px-6">Estoque Atual</th>
                  <th className="py-4 px-6">Preço (Custo / Venda)</th>
                  <th className="py-4 px-6 text-right">Ações</th>
                </tr>
              </thead>
              <tbody>
                {produtos.length === 0 ? (
                  <tr><td colSpan="6" className="py-12 text-center text-slate-500">Nenhum produto cadastrado ainda.</td></tr>
                ) : produtos.map(p => (
                  <tr key={p.id} className="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td className="py-4 px-6 text-slate-500 text-sm">#{p.id}</td>
                    <td className="py-4 px-6">
                      <p className="font-medium text-slate-800">{p.nome}</p>
                      <p className="text-xs text-slate-500 font-mono mt-0.5">{p.sku || 'Sem código'}</p>
                    </td>
                    <td className="py-4 px-6 text-slate-600 text-sm">{p.categoria?.nome || '-'}</td>
                    <td className="py-4 px-6">
                      <span className={`px-3 py-1 rounded-full text-xs font-semibold ${p.estoque_atual <= p.estoque_minimo ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}`}>
                        {p.estoque_atual} un
                      </span>
                    </td>
                    <td className="py-4 px-6">
                      <p className="text-slate-500 text-xs">{formatCurrency(p.preco_custo)}</p>
                      <p className="font-medium text-slate-800 mt-0.5">{formatCurrency(p.preco_venda)}</p>
                    </td>
                    <td className="py-4 px-6 text-right">
                      <button className="p-2 text-slate-400 hover:text-blue-600 transition-colors"><Edit2 className="w-4 h-4" /></button>
                      <button className="p-2 text-slate-400 hover:text-red-600 transition-colors ml-1"><Trash2 className="w-4 h-4" /></button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>

      {/* MODAL PRODUTO */}
      {showProdutoModal && (
        <div className="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
            <div className="flex justify-between items-center p-6 border-b border-slate-100">
              <h3 className="text-xl font-bold text-slate-800">Novo Produto</h3>
              <button onClick={() => setShowProdutoModal(false)} className="text-slate-400 hover:text-slate-600"><X className="w-5 h-5"/></button>
            </div>
            <form onSubmit={handleCreateProduto} className="p-6 space-y-4">
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Nome do Produto</label>
                <input required type="text" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={produtoForm.nome} onChange={e => setProdutoForm({...produtoForm, nome: e.target.value})} />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">SKU (Cód. Barras)</label>
                  <input type="text" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={produtoForm.sku} onChange={e => setProdutoForm({...produtoForm, sku: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Categoria</label>
                  <select className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none bg-white" value={produtoForm.categoria_id} onChange={e => setProdutoForm({...produtoForm, categoria_id: e.target.value})}>
                    <option value="">Nenhuma</option>
                    {categorias.map(c => <option key={c.id} value={c.id}>{c.nome}</option>)}
                  </select>
                </div>
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Preço Custo (R$)</label>
                  <input required type="number" step="0.01" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={produtoForm.preco_custo} onChange={e => setProdutoForm({...produtoForm, preco_custo: e.target.value})} />
                </div>
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Preço Venda (R$)</label>
                  <input required type="number" step="0.01" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={produtoForm.preco_venda} onChange={e => setProdutoForm({...produtoForm, preco_venda: e.target.value})} />
                </div>
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Estoque Mínimo (Alerta)</label>
                <input required type="number" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={produtoForm.estoque_minimo} onChange={e => setProdutoForm({...produtoForm, estoque_minimo: e.target.value})} />
              </div>
              <div className="pt-4 flex justify-end gap-3">
                <button type="button" onClick={() => setShowProdutoModal(false)} className="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100">Cancelar</button>
                <button type="submit" className="px-5 py-2.5 rounded-xl font-medium text-white bg-blue-600 hover:bg-blue-500">Salvar Produto</button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* MODAL MOVIMENTAÇÃO */}
      {showMovimentacaoModal && (
        <div className="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div className="flex justify-between items-center p-6 border-b border-slate-100">
              <h3 className="text-xl font-bold text-slate-800">Nova Movimentação</h3>
              <button onClick={() => setShowMovimentacaoModal(false)} className="text-slate-400 hover:text-slate-600"><X className="w-5 h-5"/></button>
            </div>
            <form onSubmit={handleCreateMovimentacao} className="p-6 space-y-4">
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Produto</label>
                <select required className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none bg-white" value={movimentacaoForm.produto_id} onChange={e => setMovimentacaoForm({...movimentacaoForm, produto_id: e.target.value})}>
                  <option value="">Selecione o produto...</option>
                  {produtos.map(p => <option key={p.id} value={p.id}>{p.nome} (Atual: {p.estoque_atual})</option>)}
                </select>
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
                  <select required className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none bg-white" value={movimentacaoForm.tipo} onChange={e => setMovimentacaoForm({...movimentacaoForm, tipo: e.target.value})}>
                    <option value="entrada">Entrada (+)</option>
                    <option value="saida">Saída (-)</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Quantidade</label>
                  <input required type="number" min="1" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={movimentacaoForm.quantidade} onChange={e => setMovimentacaoForm({...movimentacaoForm, quantidade: e.target.value})} />
                </div>
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Motivo (Opcional)</label>
                <input type="text" placeholder="Ex: Reposição, Venda balcão..." className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={movimentacaoForm.motivo} onChange={e => setMovimentacaoForm({...movimentacaoForm, motivo: e.target.value})} />
              </div>
              <div className="pt-4 flex justify-end gap-3">
                <button type="button" onClick={() => setShowMovimentacaoModal(false)} className="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100">Cancelar</button>
                <button type="submit" className="px-5 py-2.5 rounded-xl font-medium text-white bg-purple-600 hover:bg-purple-500">Registrar</button>
              </div>
            </form>
          </div>
        </div>
      )}

      {/* MODAL CATEGORIA */}
      {showCategoriaModal && (
        <div className="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
            <div className="flex justify-between items-center p-6 border-b border-slate-100">
              <h3 className="text-xl font-bold text-slate-800">Nova Categoria</h3>
              <button onClick={() => setShowCategoriaModal(false)} className="text-slate-400 hover:text-slate-600"><X className="w-5 h-5"/></button>
            </div>
            <form onSubmit={handleCreateCategoria} className="p-6 space-y-4">
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Nome da Categoria</label>
                <input required type="text" className="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-500/50 outline-none" value={categoriaForm.nome} onChange={e => setCategoriaForm({nome: e.target.value})} />
              </div>
              <div className="pt-4 flex justify-end gap-3">
                <button type="button" onClick={() => setShowCategoriaModal(false)} className="px-5 py-2.5 rounded-xl font-medium text-slate-600 hover:bg-slate-100">Cancelar</button>
                <button type="submit" className="px-5 py-2.5 rounded-xl font-medium text-white bg-slate-800 hover:bg-slate-700">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      )}
    </Layout>
  );
}
