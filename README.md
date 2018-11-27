Projeto DevMaker - Posts

Passo a passo do deploy:
    - criada nova instancia ec2 na aws.
    - via ssh, instalados pacotes necessários para rodar o projeto.
        • php7.1 + mbscript 
        • httpd/apache
        • composer
    - git clone https://github.com/mauriciobernert/devmaker
    - criado .env na raiz com as configurações do banco na RDS.
    - restart apache 
    - done
    