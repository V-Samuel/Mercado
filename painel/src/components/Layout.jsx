import { useNavigate, useLocation } from 'react-router-dom';
import { Package, ArrowUpRight, ArrowDownRight, LogOut, LayoutDashboard } from 'lucide-react';
import api from '../api/axios';
import { useEffect } from 'react';

export default function Layout({ children }) {
  const navigate = useNavigate();
  const location = useLocation();
  const user = JSON.parse(localStorage.getItem('user'));

  useEffect(() => {
    if (!localStorage.getItem('token')) {
      navigate('/login');
    }
  }, [navigate]);

  const handleLogout = async () => {
    try {
      await api.post('/logout');
    } catch (e) {
      console.error(e);
    } finally {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      navigate('/login');
    }
  };

  const navItem = (path, icon, label) => {
    const active = location.pathname === path;
    return (
      <button 
        onClick={() => navigate(path)}
        className={`flex items-center gap-3 w-full text-left px-4 py-3 rounded-xl transition-colors ${active ? 'bg-blue-600/10 text-blue-500 font-medium' : 'hover:bg-slate-800 text-slate-300'}`}
      >
        {icon}
        {label}
      </button>
    );
  };

  if (!user) return null;

  return (
    <div className="min-h-screen bg-slate-50 flex">
      {/* Sidebar */}
      <aside className="w-64 bg-slate-900 text-slate-300 hidden md:flex flex-col border-r border-slate-800">
        <div className="p-6 border-b border-slate-800">
          <h2 className="text-2xl font-bold text-white tracking-tight flex items-center gap-2">
            <Package className="w-6 h-6 text-blue-500" /> AEMEK
          </h2>
          <p className="text-sm text-slate-500 mt-1">Gestão de Estoque</p>
        </div>
        <nav className="flex-1 p-4 space-y-2">
          {navItem('/', <LayoutDashboard className="w-5 h-5" />, 'Dashboard')}
          {navItem('/produtos', <Package className="w-5 h-5" />, 'Produtos')}
          {navItem('/relatorio', <ArrowDownRight className="w-5 h-5" />, 'Relatórios')}
        </nav>
        <div className="p-4 border-t border-slate-800">
          <button 
            onClick={handleLogout}
            className="flex items-center gap-3 px-4 py-3 w-full text-left text-red-400 hover:bg-red-500/10 rounded-xl transition-colors"
          >
            <LogOut className="w-5 h-5" />
            Sair do sistema
          </button>
        </div>
      </aside>

      {/* Conteúdo Principal */}
      <main className="flex-1 flex flex-col h-screen overflow-hidden">
        {/* Header */}
        <header className="bg-white border-b border-slate-200 px-8 py-5 flex items-center justify-between shadow-sm z-10">
          <div>
            <h1 className="text-2xl font-bold text-slate-800 capitalize">
              {location.pathname === '/' ? 'Visão Geral' : location.pathname.substring(1)}
            </h1>
          </div>
          <div className="flex items-center gap-4">
            <div className="text-right hidden sm:block">
              <p className="text-sm font-medium text-slate-800">{user?.name}</p>
              <p className="text-xs text-slate-500 capitalize">{user?.nivel_acesso}</p>
            </div>
            <div className="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">
              {user?.name?.charAt(0)}
            </div>
          </div>
        </header>

        {/* Scrollable Content */}
        <div className="flex-1 overflow-auto p-8">
          {children}
        </div>
      </main>
    </div>
  );
}
