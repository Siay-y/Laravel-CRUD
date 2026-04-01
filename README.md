# 🚀 Laravel 13 CRUD - Gestão de Usuários & API Padronizada

Este é um projeto **CRUD de Usuários** desenvolvido em **Laravel 13** e **PHP 8.3**. O foco principal desta aplicação foi construir uma interface de usuário moderna, limpa e responsiva, aliada a uma API robusta, padronizada e inteiramente documentada.

---

## 🎯 Foco do Projeto

O objetivo deste projeto é fornecer um ambiente sólido e padronizado para gestão de usuários, combinando as melhores práticas do Laravel para o backend com uma experiência de frontend rica (com suporte a temas nativos) e uma API limpa que consome os dados de maneira estruturada e previsível.

### ✨ Principais Funcionalidades Desenvolvidas

*   **Gestão Completa de Usuários (CRUD)**: Criação, listagem, visualização (detalhes), edição e remoção de registros.
*   **Modo Claro / Escuro (Dark & Light Mode)**: Implementação global de alternância de temas, utilizando variáveis CSS conscientes (theme-aware) para garantir uma adaptação perfeita de todas as cores da aplicação, mantendo o estado funcional e consistente com design flexível.
*   **Listagem de Dados Otimizada**: Conversão de antigas listas não-ordenadas (`<ul>`) para uma tabela estruturada avançada, com divisões visuais nítidas (Table Row Dividers) e paginação inteligente processada diretamente pelo banco de dados (*Server-side Pagination*).
*   **Design Responsivo e Modernizando Cabecalho/Rodapé**: Refatoração do CSS aproveitando o poder do Flexbox, além da criação de um *Header* e *Footer* universais e fixos para a aplicação.
*   **Padronização das Respostas da API**: Total estruturação dos retornos de todas as rotas da aplicação (GET, POST, PUT, DELETE) em respostas HTTP imutáveis usando objetos JSON no padrão sólido (ex: `{"success": true, "data": ...}`). Foram eliminados completamente retornos cruéis de "HTML Views" onde se esperava JSON, garantindo consistência irretocável em cenários headless.
*   **Documentação OpenAPI (Swagger)**: Acessível na rota `/docs`, cobrindo detalhadamente todas as chamadas padronizadas da API da aplicação.

---

## 💻 Tecnologias Utilizadas

As principais ferramentas e versões utilizadas para a construção do projeto incluem:

*   **[PHP 8.3](https://www.php.net/)** - Base da aplicação.
*   **[Laravel 13](https://laravel.com/)** - Framework principal (Routing, Controllers, Eloquent ORM).
*   **[Tailwind CSS 4](https://tailwindcss.com/)** - Utilizado em conjunto com variáveis nativas do CSS (Custom Properties) para ajustes finos de Dark Mode e layouts baseados em Flexbox.
*   **Swagger / OpenAPI** - Para documentação interativa e testes das rotas da API em tempo real.
*   **Vite** - Otimizador e empacotador veloz para os assets de front-end.
*   **SQLite / MySQL** - Bancos de dados configuráveis usando a forte camada do *Eloquent ORM*.

---

## 🚀 Como Executar o Projeto

Siga os passos abaixo para rodar a aplicação em sua máquina local:

**1. Clone o repositório:**
```bash
git clone https://github.com/SEU-USUARIO/crud-laravel.git
cd crud-laravel
```

**2. Instale as dependências do PHP:**
```bash
composer install
```

**3. Instale as dependências do Node/Frontend:**
```bash
npm install
```

**4. Configure o arquivo de ambiente:**
Copie o arquivo base e gere a chave única de segurança da aplicação Laravel:
```bash
cp .env.example .env
php artisan key:generate
```

**5. Crie a base de dados:**
Execute as migrações (e os seeders, se existirem) para popular o banco de dados:
```bash
php artisan migrate
```

**6. Inicialize os servidores locais:**
Em terminais separados (ou executando juntos através do *npm/concurrently* pré-configurado):
```bash
npm run dev
php artisan serve
```

A aplicação agora estará rodando em `http://localhost:8000`.
A documentação interativa da API via Swagger pode ser acessada através da rota raiz: `http://localhost:8000/docs`.

---
*Projeto desenvolvido focado em boas práticas de UI/UX e desenvolvimento Backend com Laravel. Sinta-se a vontade para explorar o repositório, testar a API com o Swagger e alternar entre os temas na interface! 🚀*
