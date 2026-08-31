# Projeto Mercado

Bem-vindo ao repositório do projeto **Mercado**. Este projeto está dividido em duas partes principais:
1. **Backend** (Laravel / PHP) - Responsável pela API e painel administrativo.
2. **Landing Page** (Next.js / Node.js) - Interface pública do projeto.

Abaixo você encontra o passo a passo completo para clonar e rodar a aplicação localmente.

---

## 🚀 1. Clonando o Repositório

Primeiramente, clone o repositório para a sua máquina local:

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd MERCADO
```

*(Substitua `<URL_DO_SEU_REPOSITORIO>` pela URL real do repositório no GitHub/GitLab)*

---

## ⚙️ 2. Configurando o Backend (Laravel)

O backend do projeto utiliza o framework **Laravel** (PHP).

### Pré-requisitos
- PHP (v8.2 ou superior recomendado)
- Composer
- Banco de dados (MySQL, PostgreSQL ou SQLite)

### Passo a passo

1. **Acesse a pasta do backend:**
   ```bash
   cd backend
   ```

2. **Instale as dependências do PHP:**
   ```bash
   composer install
   ```

3. **Configure as variáveis de ambiente:**
   Crie uma cópia do arquivo `.env.example` e renomeie para `.env`:
   ```bash
   cp .env.example .env
   ```
   *(Abra o arquivo `.env` e configure as credenciais do seu banco de dados, como `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)*

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Rode as migrações do banco de dados e os seeders:**
   Primeiro, execute as migrações para criar as tabelas no banco:
   ```bash
   php artisan migrate
   ```
   Em seguida, rode os seeders nesta ordem (o seeder de demonstração precisa do usuário Admin criado pelo DatabaseSeeder):
   ```bash
   php artisan db:seed --class=DatabaseSeeder
   php artisan db:seed --class=DemoSeeder
   ```

6. **Instale as dependências do Node:**
   ```bash
   npm install

7. **Inicie o servidor de desenvolvimento:**
   ```bash
   php artisan serve
   npm run dev
   ```
   O backend estará disponível, por padrão, em `http://localhost:8000`.

---

## 🌐 3. Configurando a Landing Page (Next.js)

A landing page utiliza o framework **Next.js** com React.

### Pré-requisitos
- Node.js (v18 ou superior recomendado)
- NPM ou Yarn

### Passo a passo

1. **Acesse a pasta da landing page (a partir da raiz do projeto):**
   ```bash
   cd landing-page
   ```

2. **Instale as dependências do Node:**
   ```bash
   npm install
   ```
   *(Ou `yarn install` se preferir)*

3. **Configure as variáveis de ambiente (se necessário):**
   Crie um arquivo `.env.local` na raiz da pasta `landing-page`:
   ```bash
   touch .env.local
   ```
   *(Configure a URL base do backend dentro dele, por exemplo: `NEXT_PUBLIC_API_URL=http://localhost:8000/api`)*

4. **Inicie o servidor de desenvolvimento:**
   ```bash
   npm run dev
   ```
   *(Ou `yarn dev`)*

A landing page estará disponível, por padrão, em `http://localhost:3000`.

---

## 📝 Resumo de Comandos Rápidos

Para inicializar os dois projetos simultaneamente no dia a dia, basta abrir dois terminais e rodar:

**Terminal 1 (Backend):**
```bash
cd backend
php artisan serve
npm run dev
```

**Terminal 2 (Landing Page):**
```bash
cd landing-page
npm run dev
```
