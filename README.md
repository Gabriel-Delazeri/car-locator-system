
# Locadora de Veículos

CRUD de Veículos, CRUD de Clientes, CRUD de Locações.




## Instalação

1 - Instalar as dependências do sail (docker)
na raiz do projeto:

```bash
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
    
2 - Criar os arquivos .env e .env.testing e rodar:

```bash
   sail art key:gen
```

3 - Rodar as migrations

```bash
   sail art migrate
```

4 - Criar uma database sqlite para testes.

```bash
   cd database
   touch database.sqlite
```

3 - Instalar as dependências do front-end

```bash
   sail composer update
   sail npm install & npm run dev
```
## Testes

Para rodar os testes:

```bash
  sail test

  // com cobertura:

  sail test --coverage-html reports/
```


# Hi, I'm Gabriel! 👋


## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/gabriel--delazeri/)

