# framework-php
Extrutura em php para controle de aplicação no padrão PSR-4

Esse é um framework simples para utilização na criação de sites e sistemas, para utilizar recomenda usar esse codigo no  servidor PHP 7 mais funciona no PHP 5.3.2

Como utilizando o código:

- Baixe os arquivos para na pasta web do servidor ex: "htdocs, www, public_html, etc..".

- edite o arquivo index.php na linha: define('WEBFILES', '/basico_melhor/');
ex: caso os arquivos esteja em subpasta public_html/teste/ a alteração é:
define('WEBFILES', '/teste/');
ex: caso os arquivos esteja na pasta principal a alteração é:
define('WEBFILES', '/');

- Abra o arquivo model.php que está dentro da pasta system e edite a linha
'mysql:host=localhost;dbname='.$banco_dados.';', 'usuario', 'senha'
localhost: coloque o host do seu servidor
$banco_dados: variavel para que irá par o nome do banco de dados
usuario: altere para o nome do usuario que tem acesso ao banco de dados
senha: alterei para a senha do usuario que tem acesso ao banco de dados

Pronto depois disso irá abrir um modelo simples de uma página com login.

Nos proximos dias irei atualizar essas informações incluindo como utilizar o framework.
