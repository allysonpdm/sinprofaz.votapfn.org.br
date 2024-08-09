## sinprofaz.votapfn.com.br
 Sistema de votação do SINPROFAZ


add no final do arquivo de hosts:
```
127.0.0.1   sinprofaz.votapfn.com.br
```

no arquivo .ENV (linha 17) da pasta laradock no windows:
```
DATA_PATH_HOST='C:\tmp\data\votacao'
```

dentro da pasta do projeto:

## LEVANTAR O SERVIDOR:
´´´
cd laradock
docker-compose up -d nginx mysql phpmyadmin workspace php-fpm
´´´
## POPULAR O BANCO DE DADOS:
´´´
docker-compose exec --user=laradock workspace php artisan migrate:refresh --seed --database=mysql --path=database/migrations/Votacoes --seeder=VotacaoSinprofazOrgBrFactorySeeder --database=mysql
```