
# EasyJobsz

A EasyJobsz é uma plataforma web que foi desenhada para os utilizadores terem a possibilidade de requisitar a outros utilizadores uma enorme variedade de serviços domésticos, tais como cortar a relva, aspirar o carro, entre outros.

## Autores

- Afonso Pais Pereira (202107557)
- David Oliveira Rodrigues (202107637)
- Duarte Azevedo Moura Dias (202004559)

## Instruções para correr o website

- Extrair o ficheiro comprimido do projeto **easyjobz.zip**
- No **Visual Studio Code**, abrir a pasta do projeto e executar o comando do **Docker**: docker run -d -p 9000:8080 -it --name=php -v C:\Users\duart\Desktop\easyjobsz:/var/www/html gfcg/vesica-php73:dev (**Nota:** substituir pelo caminho correspondente à pasta do projeto e ter em atenção ao número da porta "9000" e nome da imagem "php" do contentor).
- Abrir o navegador (Google, por exemplo) e copiar o link: http://localhost:9000/list_index.php

- Para consulta manual da base de dados (executar na linha de comandos):
  - .\sql\sqlite3.exe
  - .open sql/database.db
  - .tables (e outros comandos de consultas)

- Administradores:
  - username: admin1/admin2
  - password: admin1/admin2

## Estrutura do projeto

```plaintext
/
├── actions/
│   └── processamento das ações do utilizador em cada página (backend)
├── css/
│   └── 3 ficheiros .css que definem a estrutura visual do site (frontend)
├── includes/
│   └── funções para interação com a base de dados (backend)
├── sql/
│   └── script e base de dados
├── templates/
│   └── modelos das páginas do website (frontend)
├── uploads/
│   └── fotos carregadas no site e nas mensagens do site
├── ficheiros com as páginas do website
└── ficheiro README.md como documentação do projeto
```

## Funcionalidades Principais

### Para utilizadores:
- **Registar/Login**: criação de conta, login seguro com palavras-passe encriptadas.
- **Página inicial**: interface visual principal com botões para os pontos fulcrais do site.
- **Criar anúncios**: publicar anúncios de trabalhos com título, descrição, localização, preço, data limite e categoria.
- **Pesquisar anúncios**:
  - **Visualizar os seus anúncios**: com opções para editar ou remover os que criou e pagar serviços já realizados. 
  - **Visualizar anúncios disponíveis**: podendo aceitar, denunciar e ainda visualizar o perfil do criador.
  - **Visualizar serviços aceites**: com opções de abertura do chat do serviço, cancelamento e conclusão do mesmo.
  - **Visualizar serviços completados**: aqui apenas é possível ver anúncios que se encontram com pagamento pendente e abrir o chat com o criador.
- **Interações**: 
  - **Likes**: marcar anúncios disponíveis como favoritos.
  - **Chat**: comunicação em tempo real entre o criador e o prestador durante e após o serviço.
  - **Filtros**: filtragem dos anúncios para consultas mais fáceis.
  - **Paginação**: para melhor organização do site em geral.
  - **Denúncias**: a anúncios e/ou utilizadores.
  - **Avaliação**: após realização de cada serviço, os utilizadores podem avaliar a sua prestação no mesmo.
- **Histórico**: dos serviços recebidos/prestados e das respetivas transações monetárias.
- **Perfil do utilizador**: gestão das suas informações a qualquer momento.

### Para Administradores:
- **Gerir anúncios**: aprovar ou banir anúncios denunciados ou em análise.
- **Gerir utilizadores**: banir usuários ou restaurar o seu acesso ao site e visualizar o seu perfil.
- **Notificações**: página com todas as denúncias feitas pelos utilizadores (a outros utilizadores e a anúncios).