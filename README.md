# Leegui - Portainer API Frontend

Interface web customizável para gerenciamento de containers Docker através da API do Portainer, com suporte a multi-tenancy e autenticação LDAP.

## Funcionalidades

- 🚀 **Gerenciamento de Stacks**: Deploy e controle de stacks Docker
- 🔐 **Autenticação LDAP**: Integração com Active Directory/LDAP
- 🌐 **Multi-servidor**: Suporte a múltiplos servidores Portainer
- 📋 **Templates**: Sistema de templates para deploy rápido
- 🏢 **SaaS Ready**: Funcionalidades multi-tenant integradas
- 🎯 **Gerenciamento de Domínios**: Controle de domínios por projeto

## Requisitos

- PHP >= 7.1.3
- Composer
- SQLite/MySQL/PostgreSQL
- Docker (opcional para deployment)
- Servidor Portainer configurado

## Instalação

### 1. Clone o repositório
```bash
git clone https://github.com/marcelofmatos/leegui.git
cd leegui
```

### 2. Instale as dependências
```bash
composer install
npm install && npm run dev
```

### 3. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure o banco de dados
```bash
touch database/database.sqlite
php artisan migrate
```

### 5. Configure o LDAP (opcional)
No arquivo `.env`, configure as variáveis LDAP:
```env
LDAP_USERNAME="cn=admin,dc=example,dc=com"
LDAP_PASSWORD="password"
LDAP_HOSTS=ldap.example.com
LDAP_PORT=389
LDAP_BASE_DN="dc=example,dc=com"
```

### 6. Inicie o servidor
```bash
php artisan serve
```

## Deployment com Docker

### Build da imagem
```bash
docker build -t leegui:latest .
```

### Docker Compose
```bash
docker-compose up -d
```

### Múltiplos servidores
Use o arquivo `docker-compose-multiple-servers.yml` para deploy em múltiplos servidores:
```bash
docker-compose -f docker-compose-multiple-servers.yml up -d
```

## Uso

### 1. Adicionar Servidor Portainer
- Acesse `/portainer_server`
- Configure URL e credenciais do servidor Portainer
- Teste a conexão

### 2. Criar Templates
- Acesse `/template`
- Defina templates de stacks reutilizáveis
- Configure variáveis de ambiente padrão

### 3. Deploy de Projetos SaaS
- Acesse `/saas/create`
- Selecione servidor e template
- Configure domínio e variáveis
- Acompanhe o status do deployment

## API Endpoints

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/portainer_server` | Lista servidores |
| POST | `/portainer_server` | Adiciona servidor |
| GET | `/portainer_server/{id}/stacks` | Lista stacks do servidor |
| DELETE | `/portainer_server/{id}/stack/{stack_id}` | Remove stack |
| GET | `/saas/status/{server}/{stack}` | Status do deployment |
| GET | `/saas/check/{domain}` | Valida disponibilidade do domínio |

## Estrutura do Projeto

```
leegui/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DomainController.php
│   │       ├── PortainerServerController.php
│   │       ├── ProjectController.php
│   │       ├── StackController.php
│   │       └── TemplateController.php
│   └── Models/
├── config/
├── database/
├── public/
├── resources/
├── routes/
└── docker-compose.yml
```

## Configuração Avançada

### Nginx
Para produção, use a configuração Nginx incluída:
```bash
cp nginx/default.conf /etc/nginx/sites-available/leegui.conf
```

### HTTPS
Configure SSL no `.env`:
```env
APP_ENV=prod
APP_URL=https://seu-dominio.com
```

### Autenticação
Desative registro público em `routes/web.php` se necessário.

## Contribuindo

1. Fork o projeto
2. Crie sua feature branch (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Crie um Pull Request

## Troubleshooting

### Erro de conexão com Portainer
- Verifique se a API do Portainer está acessível
- Confirme credenciais no banco de dados
- Teste conectividade: `curl http://portainer-server:9000/api/auth`

### Problemas com LDAP
- Verifique configurações no `.env`
- Teste conexão: `php artisan ldap:test`
- Confirme base DN e filtros de busca

### Permissões
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Licença

Este projeto está licenciado sob a MIT License - veja o arquivo [LICENSE](LICENSE) para detalhes.

## Autor

**Marcelo F. Matos**
- GitHub: [@marcelofmatos](https://github.com/marcelofmatos)

## Agradecimentos

- [Laravel](https://laravel.com)
- [Portainer](https://www.portainer.io)
- [Adldap2](https://github.com/Adldap2/Adldap2)
