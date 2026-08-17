<div id="modalExclusao" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-100 rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Tem certeza?</h2>
        <p class="text-gray-600 mb-6">
            Esta ação não pode ser desfeita. Deseja realmente excluir este registro?
        </p>
        
        <div class="flex justify-end space-x-3">
            <button type="button" onclick="fecharModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                Cancelar
            </button>
            <button type="button" id="btnConfirmarExclusao" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                Sim, Excluir
            </button>
        </div>
    </div>
</div>

<script>
    let formParaEnviar = null;
    const modal = document.getElementById('modalExclusao');
    const btnConfirmar = document.getElementById('btnConfirmarExclusao');

    // Função para abrir o modal e salvar qual form foi clicado
    function abrirModal(form) {
        formParaEnviar = form;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Função para fechar o modal e limpar a variável
    function fecharModal() {
        formParaEnviar = null;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Evento de clique no botão de confirmar exclusão
    btnConfirmar.addEventListener('click', function() {
        if (formParaEnviar) {
            formParaEnviar.submit(); // Envia o formulário capturado
        }
    });
</script>