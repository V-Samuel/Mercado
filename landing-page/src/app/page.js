'use client';

import { motion } from 'framer-motion';
import { Package, TrendingUp, ShieldCheck, ArrowRight, CheckCircle2 } from 'lucide-react';

export default function LandingPage() {
  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: { staggerChildren: 0.2 }
    }
  };

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: { opacity: 1, y: 0, transition: { duration: 0.7, ease: [0.22, 1, 0.36, 1] } }
  };

  return (
    <div className="min-h-screen bg-slate-950 text-white selection:bg-blue-500/30 overflow-hidden font-sans">

      {/* Navbar */}
      <nav className="fixed w-full z-50 top-0 bg-slate-950/80 backdrop-blur-xl border-b border-white/5">
        <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
          <div className="flex items-center gap-2">
            <div className="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
              <Package className="w-6 h-6 text-white" />
            </div>
            <span className="text-xl font-bold tracking-tight">AEMEK</span>
          </div>
          <div className="hidden md:flex gap-8 text-sm font-medium text-slate-300">
            <a href="#features" className="hover:text-white transition-colors">Recursos</a>
            <a href="#benefits" className="hover:text-white transition-colors">Benefícios</a>
            <a href="#pricing" className="hover:text-white transition-colors">Planos</a>
          </div>
          <div className="flex items-center gap-4">
            <a href="http://127.0.0.1:8000/admin/login" className="hidden md:block text-sm font-medium text-slate-300 hover:text-white transition-colors">Entrar</a>
            <button className="bg-blue-600 hover:bg-blue-500 px-6 py-2.5 rounded-full text-sm font-semibold transition-all shadow-[0_0_20px_rgba(37,99,235,0.3)] hover:shadow-[0_0_30px_rgba(37,99,235,0.5)] active:scale-95">
              Começar Agora
            </button>
          </div>
        </div>
      </nav>

      {/* Hero Section */}
      <section className="relative pt-32 pb-20 md:pt-48 md:pb-32 px-6">
        <div className="absolute inset-0 overflow-hidden pointer-events-none">
          <div className="absolute top-[-20%] left-[50%] translate-x-[-50%] w-[800px] h-[400px] rounded-[100%] bg-blue-600/20 blur-[120px]" />
        </div>

        <motion.div
          className="max-w-4xl mx-auto text-center relative z-10"
          initial="hidden"
          animate="visible"
          variants={containerVariants}
        >
          <motion.div variants={itemVariants} className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-sm font-medium mb-8 backdrop-blur-sm">
            <span className="relative flex h-2 w-2">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
              <span className="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
            </span>
            Novo sistema de IA para Estoque V2.0
          </motion.div>

          <motion.h1 variants={itemVariants} className="text-5xl md:text-7xl font-bold tracking-tighter mb-8 leading-[1.1] text-white">
            Gestão de estoque <br />
            <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400">
              inteligente e invisível.
            </span>
          </motion.h1>

          <motion.p variants={itemVariants} className="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
            Elimine erros humanos, automatize reposições e tenha total controle do seu armazém em tempo real com o AEMEK.
          </motion.p>

          <motion.div variants={itemVariants} className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button className="w-full sm:w-auto px-8 py-4 bg-white text-slate-950 hover:bg-slate-200 rounded-full font-bold text-lg transition-transform hover:scale-105 flex items-center justify-center gap-2 shadow-[0_0_40px_rgba(255,255,255,0.15)]">
              Ver Demonstração <ArrowRight className="w-5 h-5" />
            </button>
            <button className="w-full sm:w-auto px-8 py-4 bg-slate-800/50 hover:bg-slate-800 border border-slate-700/50 rounded-full font-bold text-lg transition-colors flex items-center justify-center gap-2 backdrop-blur-md">
              Falar com Especialista
            </button>
          </motion.div>
        </motion.div>
      </section>

      {/* Features Grid */}
      <section id="features" className="py-24 bg-slate-900/40 border-y border-white/5 relative z-10">
        <div className="max-w-7xl mx-auto px-6">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-5xl font-bold mb-6 tracking-tight">Tudo o que você precisa</h2>
            <p className="text-slate-400 max-w-2xl mx-auto text-lg">Nossa plataforma foi desenhada para operações de alta complexidade que exigem extrema simplicidade na ponta.</p>
          </div>

          <motion.div
            className="grid md:grid-cols-3 gap-8"
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true, margin: "-100px" }}
            variants={containerVariants}
          >
            {[
              {
                icon: <TrendingUp className="w-7 h-7 text-blue-400" />,
                title: "Previsão de Demanda",
                desc: "Algoritmos avançados que preveem quando você ficará sem estoque com base no histórico de vendas.",
                bg: "bg-blue-500/10",
                border: "border-blue-500/20"
              },
              {
                icon: <ShieldCheck className="w-7 h-7 text-emerald-400" />,
                title: "Segurança Transacional",
                desc: "Registro imutável de todas as movimentações. Saiba exatamente quem, quando e onde cada item foi movido.",
                bg: "bg-emerald-500/10",
                border: "border-emerald-500/20"
              },
              {
                icon: <Package className="w-7 h-7 text-purple-400" />,
                title: "Rastreio em Tempo Real",
                desc: "Aplicativo móvel integrado para escanear códigos de barras e atualizar estoques instantaneamente.",
                bg: "bg-purple-500/10",
                border: "border-purple-500/20"
              }
            ].map((feature, i) => (
              <motion.div
                key={i}
                variants={itemVariants}
                className="bg-slate-900/80 border border-slate-800 p-8 rounded-[2rem] hover:bg-slate-800/80 transition-colors group"
              >
                <div className={`w-14 h-14 rounded-2xl ${feature.bg} ${feature.border} border flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300`}>
                  {feature.icon}
                </div>
                <h3 className="text-xl font-bold mb-3">{feature.title}</h3>
                <p className="text-slate-400 leading-relaxed">{feature.desc}</p>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* Social Proof & CTA */}
      <section className="py-24 px-6 relative z-10">
        <div className="max-w-5xl mx-auto">
          <div className="bg-gradient-to-br from-blue-900/40 via-slate-900 to-purple-900/40 border border-white/10 rounded-[3rem] p-8 md:p-16 text-center relative overflow-hidden">
            <div className="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>

            <h2 className="text-3xl md:text-5xl font-bold mb-8 relative z-10 tracking-tight">Pronto para transformar sua operação?</h2>

            <div className="flex flex-col sm:flex-row items-center justify-center gap-6 mb-10 relative z-10">
              <div className="flex items-center gap-2 text-slate-300 font-medium">
                <CheckCircle2 className="w-5 h-5 text-blue-400" /> Sem taxa de setup
              </div>
              <div className="flex items-center gap-2 text-slate-300 font-medium">
                <CheckCircle2 className="w-5 h-5 text-blue-400" /> Cancelamento grátis
              </div>
              <div className="flex items-center gap-2 text-slate-300 font-medium">
                <CheckCircle2 className="w-5 h-5 text-blue-400" /> Suporte 24/7
              </div>
            </div>

            <button className="relative z-10 px-10 py-4 bg-blue-600 hover:bg-blue-500 rounded-full font-bold text-lg transition-all hover:scale-105 shadow-[0_0_30px_rgba(37,99,235,0.4)] active:scale-95">
              Criar Conta Gratuita
            </button>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="border-t border-white/5 py-12 px-6 bg-slate-950">
        <div className="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
          <div className="flex items-center gap-2 text-slate-400">
            <Package className="w-5 h-5" />
            <span className="font-bold text-white tracking-tight">AEMEK</span>
          </div>
          <p className="text-slate-500 text-sm">© {new Date().getFullYear()} AEMEK Inc. Todos os direitos reservados.</p>
        </div>
      </footer>
    </div>
  );
}
