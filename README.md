# Desafio avansys

## Arquitetura do projeto
### Backend
O backend usa uma arquitetura de API com o model e o controller de uma arquitetura MVC padrão.
As rotas usadas são em sua maioria restfull porém em casos específicos como deletar em massa a arquitetura restfull não é usada uma vez que a request precisaria ser executada múltiplas vezes no cliente.

### Frontend
O frontend é escrito em vue e compilado pelo webpack.

## Problemas no desenvolvimento
Minha eletricidade caiu múltiplas vezes nos últimos dias me fazendo perder boa parte do projeto algumas vezes. Minha versão atual do windows é a home e essa não suporta o hyper-v logo não consigo configurar o docker na minha máquina. E por último, devido ao tempo o código do frontend ficou bem menos organizado do que eu costumo fazer. Para um exemplo de como costumo trabalhar no frontend olhar pasta abaixo:


## Adicionais
Fiz um banco de dados simples em mysql utilizando migrations, e no frontend utilizei um plugin do bootstrap para o vue.

## Executar o projeto
Para executar o projeto basta baixar os repositórios, instalar respectivamente os pacotes do composer e do npm e configurar o banco de dados.
Lembrando que no banco de dados o tipo de operador deve ser populado, para isso eu já criei todas as rotas respectivas, basta acessar a documentação da API abaixo.

## Documentação
Para executar o projeto basta baixar os repositórios, instalar respectivamente os pacotes do composer e do npm e configurar o banco de dados.
Lembrando que no banco de dados o tipo de operador deve ser populado.