# 📌 LARAVEL CMS

Breve descrição do projeto, explicando sua finalidade e principais funcionalidades. (Ainda esta em desenvolvimento)
Aplicação mpv para estudo apenas, não aconselho o uso para prod.

## 🚀 Tecnologias Utilizadas

Este projeto foi desenvolvido utilizando as seguintes tecnologias:

* **PHP** (8.2) (Laravel 11)
* **MySQL** / **PostgreSQL** (banco de dados)
* **JavaScript**
* **Blade Templates** (AdminLTE para interface administrativa)
* **CSS** (Styled Components, Bootstrap)
* **Git** (para versionamento de código)

## 📊 Funcionalidades Principais

* 📈 **Dashboard** com gráficos dinâmicos
* 📊 **Monitoramento de acessos** por período (7 ou 30 dias)
* 🔍 **Filtro por período de tempo**
* 📌 **Gestão de usuários**
* 📌 **Gestão de paginas** **para o site publico**
* 🔐 **Autenticação e controle de acesso**

## 🔧 Instalação e Configuração

1. Clone o repositório:
   ```
   git clone https://github.com/VictorIshizuka/LaravelCMS.git
   cd LaravelCMS
   ```
2. Instale as dependências:
   ```
   composer install
   npm install  # Se houver assets frontend
   ```
3. Configure o arquivo `<span>.env</span>`:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure o banco de dados e execute as migrations:
   ```
   php artisan migrate --seed
   ```
5. Inicie o servidor:
   ```
   php artisan serve
   ```
6. Acesse no navegador: [http://localhost:8000]()

## 📝 Observações

* O sistema permite o filtro de acessos por **últimos 7 ou 30 dias**.
* Os dados das páginas mais visitadas são exibidos em **gráficos dinâmicos**. (atualmente mockado)
* Para deploy teste falta configurar o dump do banco e arrumar o caminho da pasta public no provider se necessário
* Possa ser que durante o deploy de problema no symfony relacioniado a translation dependendo da verão do php
* Para funcionamento correto, o banco de dados deve estar configurado corretamente no `<span>.env</span>`.
