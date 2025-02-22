### **Documentação Geral da API**

Essa API foi desenvolvida usando o **Laravel** e implementa um sistema para gerenciar usuários, startups e proposalss de investimentos. A seguir, apresentamos a estrutura geral e os endpoints que a API oferece, bem como as instruções para autenticação e exemplos de uso.

---

## **Estrutura do Projeto**

O projeto está dividido em três áreas principais:

1. **Autenticação (AuthController):** Gerencia a autenticação do usuário, login, logout e a obtenção de dados do usuário autenticado.
    
2. **Usuários (UsersController):** Gerencia as operações CRUD para usuários no sistema.
    
3. **Startups (StartupController):** Gerencia as operações CRUD para startups, incluindo a criação e manipulação de informações sobre as startups.
    
4. **Proposals (ProposalsController):** Gerencia as operações CRUD para proposalss, associando usuários e startups para investimento.
    

---

## **Autenticação**

A autenticação no sistema é feita através do **Laravel Sanctum**, onde os usuários podem se autenticar e obter um token que deve ser incluído nas requisições subsequentes.

- **Endpoint:** `/login`
    
- **Método:** `POST`
    
- **Requisição (Login)**
    ``` json
    { "email": "usuario@exemplo.com", "password": "senha_do_usuario"}
    ```
    ``` json
    { "token": "seu_token_aqui", "token_type": "bearer", "expires_in": null}
    ```

    **Resposta:**
    
- **Endpoint:** `/logout`

---

## **Usuários**

O sistema permite gerenciar os usuários através de um conjunto de rotas que permitem a criação, listagem, exibição, atualização e exclusão de usuários.

### **EndPoints de Usuários:**

#### 1\. **Listar Todos os Usuários**

- **Endpoint:** `/all-users`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
[
  {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@exemplo.com"
  },
  ...
]

 ```

#### 2\. **Criar um Novo Usuário**

- **Endpoint:** `/create-user`
    
- **Método:** `POST`
    
- **Autenticação:** Não é necessário um token de acesso.
    

**Requisição:**

``` json
{
  "name": "Novo Usuário",
  "email": "usuario@exemplo.com",
  "password": "senha_do_usuario"
}

 ```

**Resposta:**

``` json
{
  "message": "Usuário criado com sucesso!",
  "user": {
    "id": 1,
    "name": "Novo Usuário",
    "email": "usuario@exemplo.com"
  }
}

 ```

#### 3\. **Exibir Dados de um Usuário**

- **Endpoint:** `/users/{id}`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
{
  "id": 1,
  "name": "Nome do Usuário",
  "email": "usuario@exemplo.com"
}

 ```

#### 4\. **Atualizar um Usuário**

- **Endpoint:** `/users/{id}/edit`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso.
    

**Requisição:**

``` json
{
  "name": "Nome Atualizado",
  "email": "novo_email@exemplo.com"
}

 ```

**Resposta:**

``` json
{
  "message": "Usuário atualizado com sucesso!",
  "user": {
    "id": 1,
    "name": "Nome Atualizado",
    "email": "novo_email@exemplo.com"
  }
}

 ```

#### 5\. **Deletar um Usuário**

- **Endpoint:** `/users/{id}`
    
- **Método:** `DELETE`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
{
  "message": "Usuário deletado com sucesso",
  "user": {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@exemplo.com"
  }
}

 ```

---

## **Startups**

As rotas para **Startups** permitem a criação, listagem, exibição, atualização e exclusão de startups associadas aos usuários.

### **EndPoints de Startups:**

#### 1\. **Listar Todas as Startups**

- **Endpoint:** `/all-startup`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
[
  {
    "id": 1,
    "title": "Startup X",
    "description": "Descrição da Startup",
    "tempo_disponivel": "1 ano",
    "tecnologias": ["PHP", "React"],
    "contato_informacao": "contato@startupx.com",
    "licenca": "MIT",
    "tags": ["tecnologia", "inovação"],
    "user_id": 1
  },
  ...
]

 ```

#### 2\. **Criar uma Nova Startup**

- **Endpoint:** `/create-startup`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso.
    

**Requisição:**

``` json
{
  "title": "Startup X",
  "description": "Descrição da Startup",
  "tempo_disponivel": "1 ano",
  "tecnologias": ["PHP", "React"],
  "contato_informacao": "contato@startupx.com",
  "licenca": "MIT",
  "tags": ["tecnologia", "inovação"],
  "user_id": 1
}

 ```

**Resposta:**

``` json
{
  "message": "Startup criada com sucesso!",
  "startup": {
    "id": 1,
    "title": "Startup X",
    "description": "Descrição da Startup",
    "tempo_disponivel": "1 ano",
    "tecnologias": ["PHP", "React"],
    "contato_informacao": "contato@startupx.com",
    "licenca": "MIT",
    "tags": ["tecnologia", "inovação"],
    "user_id": 1
  }
}

 ```

#### 3\. **Exibir Dados de uma Startup**

- **Endpoint:** `/startup/{id}`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
{
  "id": 1,
  "title": "Startup X",
  "description": "Descrição da Startup",
  "tempo_disponivel": "1 ano",
  "tecnologias": ["PHP", "React"],
  "contato_informacao": "contato@startupx.com",
  "licenca": "MIT",
  "tags": ["tecnologia", "inovação"],
  "user_id": 1
}

 ```

---

## **Proposals**

As rotas de **Proposals** permitem a criação, listagem, exibição, atualização e exclusão de proposalss feitas por usuários para startups.

### **EndPoints de Proposals:**

#### 1\. **Listar Todas as Proposals**

- **Endpoint:** `/all-proposalss`
    
- **Método:** `GET`
    
- **Autenticação:** Requer o token de acesso.
    

**Resposta:**

``` json
[
  {
    "id": 1,
    "investimentos": 50000,
    "user_id": 1,
    "startup_id": 2
  },
  ...
]

 ```

#### 2\. **Criar uma Nova Proposta**

- **Endpoint:** `/create-proposalss`
    
- **Método:** `POST`
    
- **Autenticação:** Requer o token de acesso.
    

**Requisição:**

``` json
{
  "investimentos": 50000,
  "user_id": 1,
  "startup_id": 2
}

 ```

**Resposta:**

``` json
{
  "message": "Proposta criada com sucesso!",
  "proposals": {
    "id": 1,
    "investimentos": 50000,
    "user_id": 1,
    "startup_id": 2
  }
}

 ```
