# Docker + PHP 8.2 + MySQL + Nginx + Symfony 6.2

## Installation

1. Clone este repositório.

2. Se você estiver trabalhando com o Docker Desktop para Mac, verifique **you have enabled `VirtioFS` for your sharing implementation**. `VirtioFS` traz desempenho de E/S aprimorado para operações em montagens vinculadas. A ativação do VirtioFS ativará automaticamente a estrutura de virtualização.

3. Crie o arquivo  `./.docker/.env.nginx.local` usando `./.docker/.env.nginx` como modelo. O valor da variável `NGINX_BACKEND_DOMAIN` é o `server_name` usado no NGINX

4. Entre na pasta `./docker` e execute `docker compose up -d` para iniciar os contêineres.

5. Você deve trabalhar dentro do `php` container. Este projeto está configurado para funcionar com a extensão [Remote Container](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)  para Visual Studio Code, para que você possa executar `Reopen in container` o comando após abrir o projeto.

6. Dentro do `php` container, execute `composer install` para instalar as dependências da `/var/www/symfony` pasta.

7. Use o seguinte valor para a variável de ambiente DATABASE_URL:

```
DATABASE_URL=mysql://user:123@db:3306/jn2_controle_cliente?serverVersion=8.0.33
```

8. O sistema contém os seguintes endpoints

    <img src="/endpoints.JPG" width="500">

OBS: Você pode alterar o nome, usuário e senha do banco de dados no .env arquivo na raiz do projeto.

