<p align="center">
<a href="https://portal.jmlgrupo.com.br/" target="_blank">
<img src="https://portal.jmlgrupo.com.br/wp-content/uploads/2024/09/logo_grupo_jml.svg" width="200" alt="jmlgrupo">
</a>
</p>

# Grupo JML - Backend

[![PHP](https://img.shields.io/badge/PHP-8.3-blue)](https://www.php.net/)  
[![Laravel](https://img.shields.io/badge/Laravel-11-red)](https://laravel.com/)  
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)](https://www.mysql.com/)  
[![Docker](https://img.shields.io/badge/Docker-20%2B-lightblue)](https://www.docker.com/)  

**Desafio Fornecedor** - Backend para gerenciamento de Fornecedor.

---

## Ambiente

| Componente | Versão |
| ---------- | ------ |
| PHP        | 8.2+   |
| Laravel    | 12+    |
| MySQL      | 8.0    |
| Docker     | 28+    |

---

## Setup do Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/rjcfj/grupo-jml-api.git -b main
cd techpines
```

### 1. Clonar o repositório

```bash
git clone https://github.com/rjcfj/grupo-jml-api.git -b main
cd techpines
```

### 2. Iniciar Docker

```bash
docker compose up -d --build
```

> Sobe serviços PHP, MySQL em background.

Configurar para que as migrations e seeders sejam executados automaticamente no Docker

### 3. Acessar servidores

- **Backend:** `http://localhost:8001`  

> As portas podem variar conforme configuração do Docker Compose.

---

## Endpoints da API

### 1. Listar Fornecedor

| Método | Endpoint            | Descrição                             |
| ------ | ------------------- | ------------------------------------- |
| GET    | `/api/fornecedores` | Lista todas as fornecedor disponíveis |

**Response Exemplo:**

```json
[
  {
    "id": 1,
    "nome": "Ricardo",
    "cnpj": "12345678000195",
    "email": null,
    "deleted_at": null,
    "created_at": "2025-09-17T18:17:56.000000Z",
    "updated_at": "2025-09-17T18:17:56.000000Z"
  }
]
```

---

### 2. Listar Fornecedor por nome

| Método | Endpoint                         | Descrição                 |
| ------ | -------------------------------- | ------------------------- |
| GET    | `/api/fornecedores?nome=ricardo` | Lista fornecedor por nome |

**Parâmetros:**

- `?nome=ricardo` → Nome da Fornecedor


**Response Exemplo:**

```json
{
    "success": true,
    "message": "Fornecedor encontrado.",
    "data": {
        "id": 5,
        "nome": "Ricardo",
        "cnpj": "12345678000195",
        "email": null,
        "deleted_at": null,
        "created_at": "2025-09-17T19:38:18.000000Z",
        "updated_at": "2025-09-17T19:38:18.000000Z"
    }
}
```

### 3. Salvar Fornecedor

| Método | Endpoint             | Descrição                                     |
| ------ | -------------------- | --------------------------------------------- |
| POST   | `/api/fornecedores/` | Salva os dados de uma fornecedor |

**Request Body:** *(objeto JSON)*

```json
{
  "nome": "Ricardo",
  "cnpj": "12345678000195",
  "email": ""
}
```

**Response Exemplo:**

```json
{
  "success": true,
    "message": "Fornecedor criada com sucesso.",
    "data": {
        "nome": "Ricardo",
        "cnpj": "12345678000195",
        "email": null,
        "updated_at": "2025-09-17T18:17:56.000000Z",
        "created_at": "2025-09-17T18:17:56.000000Z",
        "id": 1
    }
}
```

---

### 6. Atualizar Fornecedor

| Método | Endpoint                    | Descrição                           |
| ------ | --------------------------- | ----------------------------------- |
| PUT    | `/api/fornecedores/:codigo` | Atualiza os dados de uma fornecedor |

**Parâmetros:**

- `:codigo` → Código da Fornecedor

**Request Body:** *(objeto JSON)*

```json
{
  "nome": "Ricardo Junior",
  "cnpj": "12345678000195",
  "email": "ricardojcfj@email.com"
}
```

**Response Exemplo:**

```json
{
  "success": true,
    "message": "Fornecedor atualizada com sucesso.",
    "data": {
        "id": 5,
        "nome": "Ricardo Junior",
        "cnpj": "12345678000195",
        "email": "ricardojcfj@email.com",
        "deleted_at": null,
        "created_at": "2025-09-17T19:38:18.000000Z",
        "updated_at": "2025-09-17T19:55:50.000000Z"
    }
}
```

---

### 7. Excluir Fornecedor

| Método | Endpoint                    | Descrição                      |
| ------ | --------------------------- | ------------------------------ |
| DELETE | `/api/fornecedores/:codigo` | Exclui uma fornecedor          |

**Parâmetros:**

- `:codigo` → Código da Fornecedor


**Response Exemplo:**

```json
{
    "success": true,
    "message": "Success",
    "data": "Fornecedor excluída com sucesso."
}
```

---

## 📦 Testes (Unit)

```php
  docker exec -it jml-backend php artisan test

```

---

## 📝 Boas Práticas

- Utilize **Postman** ou **Insomnia** para testar a API rapidamente.  
- Padronize os formatos JSON (objetos) em requests de POST/PUT para consistência.

---

## 📂 Links Úteis

- [Postman](https://www.postman.com/)  
- [Insomnia](https://insomnia.rest/)

---

