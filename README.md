### **Documentação Geral da API**

Essa API foi desenvolvida usando o **Laravel** e implementa um sistema para gerenciar usuários, startups e proposalss de investimentos. A seguir, apresentamos a estrutura geral e os endpoints que a API oferece, bem como as instruções para autenticação e exemplos de uso. Lembre-se de usar o **Bearer Token nas requisições**

---

## **Estrutura do Projeto**

O projeto está dividido em três áreas principais:

1. **Autenticação (AuthController):** Gerencia a autenticação do usuário, login, logout e a obtenção de dados do usuário autenticado.
    
2. **Usuários (UsersController):** Gerencia as operações CRUD para usuários no sistema.
   
3. **Tipos de úsuarios:**  : Comum, 2: Investidor, 3: Startup, 4: Admin.
    
4. **Startups (StartupController):** Gerencia as operações CRUD para startups, incluindo a criação e manipulação de informações sobre as startups.
    
5. **Proposals (ProposalsController):** Gerencia as operações CRUD para proposalss, associando usuários e startups para investimento.
    

---

## **API - Gerenciamento de Usuários**

Esta API permite a criação, listagem, exibição, atualização e exclusão de usuários no sistema. Todas as rotas, exceto a criação de usuário, requerem autenticação via token gerado pelo Laravel Sanctum.

---

## **1\. Criar um Novo Usuário**

- **Endpoint:** `/create-user`
    
- **Método:** `POST`
    
- **Autenticação:** Não é necessária (público)
    

### **Requisição:**

``` json
{
  "name": "Novo Usuário",
  "email": "usuario@exemplo.com",
  "password": "senha_do_usuario"
}

 ```

### **Resposta:**

``` json
{
  "message": "Usuário criado com sucesso!",
  "user": {
    "id": 1,
    "name": "Novo Usuário",
    "email": "usuario@exemplo.com",
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
}

 ```

### **Descrição da Resposta:**

- **message:** Confirmação de criação bem-sucedida.
    
- **user:** Objeto contendo os dados do usuário criado.
    

---

## **2\. Listar Todos os Usuários**

- **Endpoint:** `/users`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso
    

### **Resposta:**

``` json
[
  {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@exemplo.com",
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
]

 ```

### **Descrição da Resposta:**

- **id:** ID do usuário.
    
- **name:** Nome do usuário.
    
- **email:** E-mail do usuário.
    
- **created_at:** Data de criação.
    
- **updated_at:** Data da última atualização.
    

---

## **3\. Exibir Dados de um Usuário**

- **Endpoint:** `/users/{id}`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso
    

### **Resposta:**

``` json
{
  "id": 1,
  "name": "Nome do Usuário",
  "email": "usuario@exemplo.com",
  "created_at": "2024-01-01T12:00:00",
  "updated_at": "2024-01-01T12:00:00"
}

 ```

### **Descrição da Resposta:**

- **id:** ID do usuário.
    
- **name:** Nome do usuário.
    
- **email:** E-mail do usuário.
    
- **created_at:** Data de criação.
    
- **updated_at:** Data da última atualização.
    

---

## **4\. Atualizar Dados de um Usuário**

- **Endpoint:** `/users/{id}/edit`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso
    

### **Requisição:**

``` json
{
  "name": "Nome Atualizado",
  "email": "novo_email@exemplo.com"
}

 ```

### **Resposta:**

``` json
{
  "message": "Usuário atualizado com sucesso!",
  "user": {
    "id": 1,
    "name": "Nome Atualizado",
    "email": "novo_email@exemplo.com",
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
}

 ```

### **Descrição da Resposta:**

- **message:** Confirmação da atualização.
    
- **user:** Objeto contendo os dados do usuário atualizado.
    

---

## **5\. Deletar um Usuário**

- **Endpoint:** `/users/{id}`
    
- **Método:** `DELETE`
    
- **Autenticação:** Requer o token de acesso
    

### **Resposta:**

``` json
{
  "message": "Usuário deletado com sucesso.",
  "user": {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@exemplo.com",
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
}

 ```

### **Descrição da Resposta:**

- **message:** Confirmação da exclusão.
    
- **user:** Dados do usuário excluído.
    

---

StartFragment

## **Autenticação**

A autenticação na API é feita através de **tokens** gerados pelo Laravel Sanctum. Após a autenticação, os usuários podem acessar rotas protegidas, como operações de CRUD de usuários e outros recursos.

### **1\. Login do Usuário**

- **Endpoint:** `/login`
    
- **Método:** `POST`
    
- **Autenticação:** Não é necessária (público)
    

Este endpoint permite que um usuário se autentique, fornecendo suas credenciais (email e senha). Se as credenciais forem válidas, um token de acesso será gerado e retornado, permitindo que o usuário acesse rotas protegidas.

#### **Requisição:**

``` json
{
  "email": "usuario@exemplo.com",
  "password": "senha_do_usuario"
}

 ```

#### **Resposta de Sucesso (200):**

``` json
{
  "token": "seu_token_aqui",
  "token_type": "bearer",
  "expires_in": null
}

 ```

#### **Descrição da Resposta:**

- **token:** O token de acesso gerado, que deve ser usado para autenticação nas rotas protegidas.
    
- **token_type:** Tipo de token (sempre será "bearer").
    
- **expires_in:** O tempo de expiração do token (no caso do Sanctum, ele não expira por padrão).
    

#### **Resposta de Erro (401 - Credenciais Inválidas):**

``` json
{
  "error": "Credenciais inválidas. Verifique seu email e senha."
}

 ```

---

### **2\. Logout do Usuário**

- **Endpoint:** `/logout`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

Este endpoint revoga o token de acesso do usuário, realizando o logout.

#### **Requisição:**

Nenhuma requisição adicional necessária além do token no cabeçalho.

#### **Resposta de Sucesso (200):**

``` json
{
  "message": "Usuário deslogado com sucesso"
}

 ```

#### **Resposta de Erro (401 - Não autenticado):**

``` json
{
  "error": "Token inválido ou usuário não autenticado."
}

 ```

---

### **3\. Obter Dados do Usuário Autenticado**

- **Endpoint:** `/user`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

Esse endpoint retorna as informações do usuário autenticado, permitindo que ele visualize seus próprios dados.

#### **Resposta de Sucesso (200):**

``` json
{
  "id": 1,
  "name": "Nome do Usuário",
  "email": "usuario@exemplo.com",
  "created_at": "2024-01-01T12:00:00",
  "updated_at": "2024-01-01T12:00:00"
}

 ```

#### **Resposta de Erro (401 - Não autenticado):**

``` json
{
  "error": "Usuário não autenticado."
}

 ```

---

# **Documentação do CRUD de Startups**

Esta seção descreve os endpoints da API responsáveis pela criação, leitura, atualização e exclusão de startups no sistema. As rotas de startups são protegidas e requerem autenticação, utilizando Laravel Sanctum para garantir a segurança e o controle de acesso.

---

## **CRUD de Startups**

Esses endpoints permitem o gerenciamento de startups no sistema, incluindo listagem, criação, visualização, atualização e exclusão.

### **1\. Listar Todas as Startups**

- **Endpoint:** `/all-startup`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso (autenticado) com permissão de startup
    

Este endpoint retorna todas as startups cadastradas no sistema.

#### **Resposta de Sucesso (200):**

``` json
[
  {
    "id": 1,
    "title": "Startup Exemplo",
    "description": "Descrição da startup.",
    "tempo_disponivel": "6 meses",
    "tecnologias": ["PHP", "Laravel", "MySQL"],
    "contato_informacao": "contato@startup.com",
    "licenca": "MIT",
    "tags": ["tecnologia", "inovação"],
    "user_id": 1,
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
]

 ```

---

### **2\. Criar uma Nova Startup**

- **Endpoint:** `/create-startup`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso (autenticado) com permissão de startup
    

#### **Requisição:**

``` json
{
  "title": "Nova Startup",
  "description": "Descrição da nova startup.",
  "tempo_disponivel": "12 meses",
  "tecnologias": ["React", "Node.js"],
  "contato_informacao": "contato@novastartup.com",
  "licenca": "Apache-2.0",
  "tags": ["inovação", "tecnologia"],
  "user_id": 1
}

 ```

#### **Resposta de Sucesso (201):**

``` json
{
  "message": "Startup criada com sucesso!",
  "startup": {
    "id": 1,
    "title": "Nova Startup",
    "description": "Descrição da nova startup.",
    "tempo_disponivel": "12 meses",
    "tecnologias": ["React", "Node.js"],
    "contato_informacao": "contato@novastartup.com",
    "licenca": "Apache-2.0",
    "tags": ["inovação", "tecnologia"],
    "user_id": 1,
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-01T12:00:00"
  }
}

 ```

---

### **3\. Exibir uma Startup Específica**

- **Endpoint:** `/startup/{id}`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

#### **Resposta de Sucesso (200):**

``` json
{
  "id": 1,
  "title": "Startup Exemplo",
  "description": "Descrição da startup.",
  "tempo_disponivel": "6 meses",
  "tecnologias": ["PHP", "Laravel", "MySQL"],
  "contato_informacao": "contato@startup.com",
  "licenca": "MIT",
  "tags": ["tecnologia", "inovação"],
  "user_id": 1,
  "created_at": "2024-01-01T12:00:00",
  "updated_at": "2024-01-01T12:00:00"
}

 ```

---

### **4\. Atualizar Dados de uma Startup**

- **Endpoint:** `/startup/{id}/edit`
    
- **Método:** `PUT`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

#### **Requisição:**

``` json
{
  "title": "Startup Atualizada",
  "description": "Descrição da startup atualizada.",
  "tempo_disponivel": "24 meses",
  "tecnologias": ["PHP", "Laravel", "Vue.js"],
  "contato_informacao": "contato@startupatualizada.com",
  "licenca": "MIT",
  "tags": ["tecnologia", "inovação", "frontend"]
}

 ```

#### **Resposta de Sucesso (200):**

``` json
{
  "message": "Startup atualizada com sucesso!",
  "startup": {
    "id": 1,
    "title": "Startup Atualizada",
    "description": "Descrição da startup atualizada.",
    "tempo_disponivel": "24 meses",
    "tecnologias": ["PHP", "Laravel", "Vue.js"],
    "contato_informacao": "contato@startupatualizada.com",
    "licenca": "MIT",
    "tags": ["tecnologia", "inovação", "frontend"],
    "user_id": 1,
    "created_at": "2024-01-01T12:00:00",
    "updated_at": "2024-01-02T12:00:00"
  }
}

 ```

---

### **5\. Excluir uma Startup**

- **Endpoint:** `/startup/{id}`
    
- **Método:** `DELETE`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

#### **Resposta de Sucesso (200):**

``` json
{
  "message": "Startup deletada com sucesso."
}

 ```

---

### **6\. Excluir uma Startup em Grupo**

- **Endpoint:** `/startup/{id}/group`
    
- **Método:** `DELETE`
    
- **Autenticação:** Requer o token de acesso (autenticado)
    

#### **Resposta de Sucesso (200):**

``` json
{
  "message": "Startups deletadas com sucesso."
}

 ```

---

# Documentação da API - Propostas

## Introdução

Esta API permite a criação, visualização, atualização e exclusão de propostas. As operações são realizadas no modelo `Proposals`, que contém informações sobre investimentos, usuários e startups. A seguir, descrevemos cada um dos endpoints disponíveis na API.

## Endpoints

### 1. **Listar Propostas**

- **Método**: `GET`
- **Rota**: `/proposals`
- **Descrição**: Retorna uma lista de todas as propostas existentes na base de dados.
- **Exemplo de Resposta (Sucesso)**:

  ```json
  [
    { "id": 1, "investimentos": "10000", "user_id": 2, "startup_id": 3 },
    { "id": 2, "investimentos": "50000", "user_id": 1, "startup_id": 4 }
  ]

### 2. **Criar Proposta**

- **Método**: `POST`
- **Rota**: `/proposals`
- **Descrição**: Cria uma nova proposta na base de dados.
- **Parâmetros (Body da Requisição)**:
  - `investimentos` (requerido): Valor do investimento na proposta.
  - `user_id` (requerido): ID do usuário associado à proposta.
  - `startup_id` (requerido): ID da startup associada à proposta.
- **Exemplo de Resposta (Sucesso)**:

  ```json
  {
    "message": "Proposta criada com sucesso!",
    "proposal": { "id": 1, "investimentos": "10000", "user_id": 2, "startup_id": 3 }
  }

### 3. **Mostrar Proposta**

- **Método**: `GET`
- **Rota**: `/proposals/{id}`
- **Descrição**: Retorna os detalhes de uma proposta específica, identificada pelo seu ID.
- **Parâmetros**:
  - `id` (requerido): ID da proposta a ser recuperada.
- **Exemplo de Resposta (Sucesso)**:

  ```json
  { "id": 1, "investimentos": "10000", "user_id": 2, "startup_id": 3 }
    ```
### 4. **Atualizar Proposta**

- **Método**: `PUT`
- **Rota**: `/proposals/{id}`
- **Descrição**: Atualiza uma proposta existente, identificada pelo seu ID.
- **Parâmetros (Body da Requisição)**:
  - `investimentos` (requerido): Novo valor de investimento para a proposta.
- **Exemplo de Resposta (Sucesso)**:

  ```json
  {
    "message": "Proposta atualizada com sucesso!",
    "proposal": { "id": 1, "investimentos": "15000", "user_id": 2, "startup_id": 3 }
  }
### 5. **Deletar Proposta**

- **Método**: `DELETE`
- **Rota**: `/proposals/{id}`
- **Descrição**: Deleta uma proposta existente, identificada pelo seu ID.
- **Parâmetros**:
  - `id` (requerido): ID da proposta a ser deletada.
- **Exemplo de Resposta (Sucesso)**:

  ```json
  {
    "message": "Proposta deletada com sucesso.",
    "proposal": { "id": 1, "investimentos": "10000", "user_id": 2, "startup_id": 3 }
  }
