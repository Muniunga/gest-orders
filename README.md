# Gest-orders

Este é um sistema básico de gestão de pedidos de materiais, desenvolvido com Laravel/Livewire. Ele permite a criação, aprovação e rejeição de pedidos de materiais, com dois perfis de usuários: **Solicitante** e **Aprovador**.

---

## Funcionalidades

1. **Cadastro de Pedidos**: Solicitantes podem criar pedidos e incluir materiais no pedido.
2. **Fluxo de Aprovação**: Aprovadores podem aprovar, rejeitar ou solicitar alterações nos pedidos.
3. **Gestão de Saldo**: Pedidos são aprovados apenas se o saldo permitido do grupo for maior ou igual ao total do pedido.
4. **Estados do Pedido**: 
   - Novo
   - Em Revisão
   - Alterações Solicitadas
   - Aprovado
   - Rejeitado

---
## Uso
1. **Solicitante**: 
   - Após o login, o solicitante pode criar um novo pedido e adicionar materiais a ele.
   - O pedido será enviado automaticamente para o aprovador do grupo.
2. **Aprovador**: 
   - O aprovador pode visualizar os pedidos pendentes em seu grupo.
   - Ele pode aprovar o pedido, rejeitá-lo ou solicitar alterações
   - O saldo do grupo é verificado antes da aprovação.
---
## Credenciais
1. **Solicitante**: 
   -email:solicitante@example.com
   - password: 12345678
2. **Aprovador**: 
  -email:admin@example.com
   - password: 12345678
---

## Requisitos

### Tecnologias Utilizadas

- **Back-end**: PHP, Laravel
- **Front-end**:Livewire, Blade, HTML, CSS, Tailwind
- **Banco de Dados**: MySQL 
- **Versionamento**: Git

## Instalação

- **Instale as dependências do Composer**:
  composer install
- **Migre o banco de dados**:
    php artisan migrate      
- **Popule o banco de dados com usuários e grupos de exemplo**:
 php artisan db:seed
- **Iniciar o servidor local**:
php artisan serve



