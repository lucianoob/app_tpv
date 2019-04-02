# AppTPV

Projeto de exemplo de uma API para a importação de produtos a partir de uma planilha do Excel.

## Requisitos

- Este projeto foi feito utilizando um servidor Apache e MySQL, sendo assim estes necessariamente devem estar instalados e configurados.


## Componentes

Os componentes utilizados neste projeto são:
- Laravel 5.8.9
- PHP 7.3.3
- MySQL 5.7.25
- Laravel-Excel (maatwebsite/excel)
- GraphQL (rebing/graphql-laravel)
- GraphiQL (noh4ck/graphiql)
- [Altair GraphQL Client](https://altair.sirmuel.design/)
- PHPUnit
- phpDocumentor

## Instalação

Para instalar basta rodar o script install.sh, lembrando que é necessário ter os pré-requisitos instalados.

Na instalação são executadas as seguintes ações:
- Inicia os servidores (Apache/MySQL)
- Cria um novo banco de dados (remove se este existir)
- Gera uma nova chave do Laravel
- Limpa o cache da configuração do Laravel
- Limpa o cache do Laravel
- Executa os migrations do Laravel (App/API)
- Executa os seeds do Laravel (App/API)
- Executa os testes com o PHPUnit (App/API)

## Controles do Projeto

Foi criado um script (start.sh) para controlar os servidores.

## Acesso ao Projeto

Todos os acessos/links da API do projeto estão na home do Laravel ([http://localhost:8000](http://localhost:8000))

## Observações Importantes
- Foi realizado duas formas de importação de uma planilha, uma local (public/) e outra por upload (teste usando o Altair GraphQL Client).
- A importação do arquivo utiliza uma Queue para alocar a importação (nos dois casos acima).
- Quando os testes são executados (PHPUnit) um registro (id:1001) é excluído, sendo este o teste de exclusão.
- Todo o código foi formatado usando o padrão PSR-4.
