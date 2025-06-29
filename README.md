# 🛡️ Sistema de Login com Área Restrita - PHP + MySQL

Este é um projeto simples e funcional de login, cadastro e área protegida, desenvolvido com PHP, MySQL e hospedado gratuitamente via InfinityFree.

## ✅ Funcionalidades

- Cadastro de usuário com validação e criptografia de senha.
- Login seguro com verificação de senha.
- Recuperação de senha via código enviado por e-mail usando PHPMailer.
- Redefinição de senha com confirmação.
- Regras de senha (mínimo 1 letra maiúscula, 1 minúscula, 1 número, 1 caractere especial e até 12 caracteres).
- Visualização de senha com botão de "olhinho".
- Layout responsivo e centralizado para telas de desktop e mobile.

## 🛠️ Tecnologias Utilizadas

- PHP
- MySQL
- PHPMailer
- HTML5 / CSS3 (CSS embutido nas páginas)
- InfinityFree (hospedagem gratuita)

## 🔐 Segurança Implementada

- Senhas criptografadas com `password_hash()`.
- Sessão com `session_start()` em páginas protegidas.
- Headers no-cache para evitar acesso com botão voltar do navegador.
- Proteção contra reenvio de formulário e campos obrigatórios.

## 🚀 Como Usar

1. **Banco de Dados:**
   No phpMyAdmin do InfinityFree, crie a tabela:

   ```sql
   CREATE TABLE usuarios (
     id INT AUTO_INCREMENT PRIMARY KEY,
     nome VARCHAR(100) NOT NULL,
     usuario VARCHAR(50) NOT NULL UNIQUE,
     email VARCHAR(100) NOT NULL UNIQUE,
     senha VARCHAR(255) NOT NULL
   );
   ```

2. **Configuração de Conexão:**
   No arquivo `conexao.php`, edite os dados de acesso ao banco:

   ```php
   $host = "sqlXXX.infinityfree.com";
   $usuario = "seu_usuario";
   $pass = "sua_senha";
   $db = "seu_banco";
   ```

3. **Upload dos Arquivos:**
   Envie os arquivos para o gerenciador de arquivos do InfinityFree (via painel ou FTP).

4. **Acesse no Navegador:**
   Use a URL do seu domínio gratuito para acessar o sistema 🎉

---

## ✍️ Desenvolvido por

**Aparecida Marques Pereira**  
Estudante de Análise e Desenvolvimento de Sistemas  
GitHub: [dinhapreta](https://github.com/dinhapreta)  

> “Uma vez sonhei em programar — hoje vivo esse sonho.” 💫
