# Meus Projetos

Projeto final para a disciplina de Tecnologias de Desenvolvimento Back-end (PHP) da Pós-Graduação em Desenvolvimento de Aplicações Web. 👨🏻‍💻👾

## Começando

Primeiramente, faça clonagem do projeto:

```
git clone https://github.com/MattZ6/php-pos
```

Após isso, terá uma pasta chamada `php-pos` no diretório atual. Adentre a mesma e utilize as seguintes instruções:

1 - `composer install`;
2 - `cp .env.example .env`;
3 - `php artisan key:generate`;
4 - Dentro do diretório `~/app/database/`, crie o arquivo `database.sqlite`;
5 - Novamente no diretório na pasta raiz do projeto, execute `php artisan migrate`.

Após isso, o projeto já estará em condições de ser executado: `php artisan serve`.
