Passos para rodar o sistema de busca no blog da Uplexis.
Instale o WAMPP(Apache, MySQL, MariaDB and PHP)
https://sourceforge.net/projects/wampserver/

Inicie o WampServer.

Instale o composer
https://getcomposer.org/Composer-Setup.exe

Agora faça 4 coisas importantes:

1- acesse no CMD o diretório onde baixou e descompactou o projeto do Github em "C:\wamp64\www\pesquisablog>"

2- No CMD "C:\wamp64\www\pesquisablog>", digite o commando “composer install”. Ele vai instalar todos os pacotes php necessários.

3- Digite o commando “php artisan key:generate”. Esse vai gerar uma chave para sua aplicação. Sem isso o Laravel não vai funcionar

4- Configure com os dados do seu banco no arquivo ".env" na raiz do projeto pesquisablog:


DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3308

DB_DATABASE=projeto

DB_USERNAME=root

DB_PASSWORD=


depois:
//Rode o server com o comando "php artisan serve" no CMD dentro do diretório: "C:\wamp64\www\pesquisablog>",

Vai acessar no navegador: 
http://localhost:8000/

//Rodar as migrations para criar o banco de dados dentro do diretório: "C:\wamp64\www\pesquisablog>",

"php artisan migrate"

"php artisan db:seed"

Se tudo deu certo, pronto, o banco de dados foi criado e populado com um registro de usuario.