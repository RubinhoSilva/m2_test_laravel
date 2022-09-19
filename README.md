# Teste para a M2

## 🚀 Tecnologias
- [Laravel](https://laravel.com)
- [Docker](https://www.docker.com)
- [Insomnia](https://insomnia.rest)

## ❓ Como utilizar

### Como instalar
```bash
docker-compose build app
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```


## ✅ Como testar a aplicação
```bash
docker-compose exec app php artisan test
```

## ✨ Possíveis melhorias
- Verificar se os retornos estão como esperados;
- Talvez fosse necessário armazenar o historico de preços do produto, então, teria que criar uma tabela de preços para ele;
- Retornar os produtos com desconto nas rotas de cidades, ou, nas rotas de grupos de cidades;
- Retornar os valores com desconto dos produtos;
- Entender melhor os retornos de produtos nas campanhas;
- Melhorar a documentação;
- Documentar todas as rotas e adicionar exemplos de request com sucesso e com falha;
- Adicionar mais testes;
- Melhorar a forma com que a cidade pode trocar de grupo;
