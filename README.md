# Sistema de Gestão de Grupo Econômico

Este é um sistema de gestão para um grupo econômico que permite a administração de grupos econômicos, bandeiras, unidades e colaboradores, além da geração de relatórios e auditoria de ações.

## Funcionalidades

- **Gestão de Grupo Econômico**: CRUD completo para grupos econômicos.
- **Gestão de Bandeiras**: CRUD para bandeiras associadas a grupos econômicos.
- **Gestão de Unidades**: CRUD para unidades associadas a uma bandeira.
- **Gestão de Colaboradores**: CRUD para colaboradores associados a uma unidade.
- **Relatórios**: Geração de relatórios de colaboradores em formato Excel e PDF.
- **Auditoria**: Registro de alterações feitas nas entidades, acessível via `http://localhost:8000/audits`.
- **Autenticação**: Controle de acesso por login e senha.
- **Exportação**: Exportação de relatórios e dados.

## Tecnologias Utilizadas

- **Backend**: Laravel 10
- **Banco de Dados**: MySQL
- **Autenticação**: Laravel Breeze
- **Relatórios**: Laravel Excel (para exportação de dados)
- **Filas**: Laravel Queue (para exportação de relatórios demorados)
- **Docker**: MySQL pode ser rodado em container Docker (opcional)

## Requisitos

- PHP 8.1 ou superior
- Composer
- MySQL (local ou via Docker)
- Laravel 10 ou superior

## Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/TayronAmaral/sistemadegestao.git
```

### 2. Configurar o Ambiente

Entre na pasta do projeto:

```bash
cd sistemadegestao
```

Copie o arquivo `.env.example` para um novo arquivo `.env`:

```bash
cp .env.example .env
```

### 3. Configurar o Banco de Dados

Se estiver rodando o MySQL localmente, edite o arquivo `.env` com suas credenciais:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 # ou nome do container MySQL no Docker
DB_PORT=3306
DB_DATABASE=mysql-testeful
DB_USERNAME=root
DB_PASSWORD=3d4f5g@M0pt1*
```

Se quiser rodar o MySQL no Docker, use o seguinte comando para subir o container:

```bash
docker-compose up -d
```

### 4. Instalar Dependências

```bash
composer install
```

### 5. Gerar Chave de Aplicação

```bash
php artisan key:generate
```

### 6. Migrar Banco de Dados

```bash
php artisan migrate --seed
```

### 7. Rodar o Servidor

```bash
php artisan serve
```

O sistema estará disponível em `http://localhost:8000`

## Uso

### 1. Autenticação

Acesse a tela de login e crie um usuário para acessar o sistema.

### 2. Auditoria

Todas as alterações feitas nas entidades são registradas e podem ser acessadas em:

```
http://localhost:8000/audits
```

### 3. Relatórios

- Relatórios de colaboradores podem ser gerados e exportados em **Excel** e **PDF**.
- Exportação de dados pode ser feita diretamente pela interface.

## Testes

Para rodar os testes, use:

```bash
php artisan test
```

## Contribuição

1. Fork o repositório
2. Crie uma branch (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova feature'`)
4. Push para o repositório (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## Licença

Este projeto está sob a licença MIT. Consulte o arquivo LICENSE para mais detalhes.

