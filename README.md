🛡️ Sistema de Login com Área Restrita - PHP + MySQL
Este é um projeto simples e funcional de login, cadastro e área protegida, desenvolvido com PHP, MySQL e hospedado gratuitamente via InfinityFree.


## Funcionalidades

- Cadastro de usuário com validação e criptografia de senha.
- Login seguro com verificação de senha.
- Recuperação de senha via código enviado por e-mail usando PHPMailer.
- Redefinição de senha com confirmação.
- Layout responsivo e centralizado para telas de desktop e mobile.

## Tecnologias

- PHP
- MySQL
- PHPMailer
- HTML5 / CSS3 (CSS embutido nas páginas)
- InfinityFree (hospedagem gratuita)




🔐 Segurança Implementada
Senhas criptografadas com password_hash()

Sessão com session_start() em páginas protegidas

Headers no-cache para evitar acesso com botão voltar do navegador

Proteção contra reenvio de formulário e campos obrigatórios

🚀 Como usar
1. Configure seu banco no phpMyAdmin do InfinityFree:
   CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

2. Altere os dados de conexão no conexao.php
Ex.:
$host = "sqlXXX.infinityfree.com";
$user = "seu_usuario";
$pass = "sua_senha";
$db = "seu_banco";


3. Envie os arquivos para o gerenciador de arquivos da InfinityFree (via painel ou FTP).

4. Acesse a URL do seu domínio gratuito e teste o sistema 🎉

✍️ Desenvolvido por
Aparecida Marques Pereira
Estudante de Análise e Desenvolvimento de Sistemas
GitHub: dinhapreta

"Sonhava apenas em programar. Hoje, vivo um sonho."
"I once dreamed of coding — today I live that dream." 💫

