🛡️ Sistema de Login com Área Restrita - PHP + MySQL
Este é um projeto simples e funcional de login, cadastro e área protegida, desenvolvido com PHP, MySQL e hospedado gratuitamente via InfinityFree.

📌 Funcionalidades
Cadastro de usuários com:

Nome

Nome de usuário (único)

E-mail (único)

Senha com confirmação

Validação de dados (e-mail e usuário não podem se repetir)

Hash de senha com password_hash()

Login com verificação de sessão

Área protegida acessível apenas a usuários logados

Redirecionamento automático ao fazer logout

Bloqueio de navegação após logout (segurança contra cache)

Estilização básica com HTML e CSS (pode ser expandido)

🛠️ Tecnologias Utilizadas
PHP (sem frameworks)

MySQL (com phpMyAdmin)

HTML5 e CSS3

Sessões com $_SESSION

PHPMailer (opcional, para recuperação de senha)

InfinityFree (hospedagem gratuita)

📂 Estrutura do Projeto
/ (raiz)
├── index.php               // Tela de login
├── cadastro.php            // Tela de cadastro
├── area_restrita.php       // Área protegida (somente logado)
├── logout.php              // Destrói a sessão e retorna ao login
├── conexao.php             // Conexão com o banco de dados
├── style.css               // Estilos básicos
└── README.md               // Este arquivo


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

