Sistema Político
================

Introdução
----------
A concorrência entre candidatos políticos sempre foi intensa. Planejamento estratégico não é apenas para médias e grandes empresas, faz parte de qualquer projeto para o qual se pretende obter êxito. As eleições brasileiras são muito disputadas, e cada detalhe pode fazer diferença entre candidatos eleitos e os que não conseguiram se eleger.
Assim, a Tenil Tecnologia propõe o desenvolvimento de um _software_ para ajudar os candidatos nessa árdua jornada até os votos nas urnas. Esse projeto tem o objetivo de ser uma ferramenta revolucionária de gestão para políticos de diferentes perfis. Permitirá que candidatos, eleitos ou não, possam administrar sua campanha política para melhores resultados nas urnas. Também permitirá que o candidato eleito mantenha um relacionamento com seus eleitores durante todo o mandato, possibilitando um melhor desempenho um futuras eleições.

### Motivação
A principal motivação para o desenvolvimento deste projeto foi a possibilidade de utilizar a Tecnologia da Informação na solução de problemas do mundo-real, especificamente os de gestão de campanha e de gabinete político, por meio do desenvolvimento de um Sistema de Informação. Assim, o desafio de se considerar a possibilidade de oferecer uma ferramenta de gestão política motivou o desenvolvimento de uma solução computacional.
O ambiente político dos candidatos a Deputado Distrital de Brasília foi considerado como a maior necessidade. Considerou-se a necessidade de fornecer aos candidatos, um ambiente para registar, recuperar e organizar o cadastro de possíveis eleitores.
Apesar da grande oferta de ferramentas de gestão política existentes no mercado, os requisitos levantados junto a pessoas experientes na área política, apontam a necessidade de desenvolvimento de um sistema mais dinâmico, flexível, fácil de utilizar, e de baixo custo para candidatos com poucos recursos financeiros disponíveis.
Algumas ferramentas serão essenciais para a aceitação do _software_ no mercado: ferramenta de envio de SMS, ferramenta de envio de e-mail _marketing_, ferramenta de envio de mensagens fonadas, ferramenta de envio de cartas de aniversário, entre outras.

### Breve histórico do sistema existente
A Tenil Tecnologia desenvolveu um _software_, Sistema Integrado de Gabinete - SIGA, que utiliza uma arquitetura cliente-servidor. Essa arquitetura, apesar de ser extremamente segura e robusta, não está preparada para alguns requisitos do novo sistema, por exemplo, a utilização pela internet.
O _software_ atual (SIGA), pode ser utilizado em uma infraestrutura de rede local. Existem muitas regras de negócio que serão utilizadas na produção do novo sistema.

### Problemas diagnosticados no sistema atual
* Inexistência de área administrativa para manutenção de usuários;
* Não há possibilidade de cadastrar pessoas jurídicas (feiras, condomínios, associações, igrejas, etc) e vincular pessoas físicas a essas entidades;
* 

### Usuários do sistema
O sistema será utilizado por candidatos e assessores de candidatos de todo o território nacional. Poderá ser utilizado por candidatos eleitos, partidos políticos e coligações partidárias.

Objetivos
---------
### Objetivo geral

### Objetivo específicos

Proposta do sistema
------------------------
### Descrição do sistema proposto

### Resultados esperados

### Restrições do sistema proposto

### Arquitetura computacional 
#### Descrição do _hardware_ ideal
#### Descrição do _hardware_ mínimo
#### Descrição do _software_ utilizado
#### Configuração da rede
#### Configuração do banco de dados
#### Sistema de versionamento
#### Sistema de backup
#### Pessoal exigido

### Vantagens do sistema

### Comercialização do sistema

Arquitetura do sistema
----------------------
### Infraestrutura

### Banco de dados

### Sistema Operacional

### Linguagem de programação

### Servidor Web

### Sistema de versionamento

### Sistema de backup

Zend Framework
--------------
### Módulos
O sistema será composto de diversos módulos. Cada qual será projetado de tal forma que poderá ser facilmente reutilizado em outros projeto da empresa.

#### Application
Esse é o módulo do básico. Os layouts principais, partials e configurações iniciais de rotas ficam nele. As configurações de tradução também ficam nele.

##### Rotas
* home
> /
> Application\Controller\Index\index

* application
> /application
> Application\Controller\Index
> > application/default
> > /[:controller[/:action]]

#### User
Esse módulo controla o cadastro de usuários no sistema.

##### Rotas
* tenil-user-register
> /register
> TenilUser\Controller\Index\register

* tenil-user-activate
> /register/activate[/:key]
> TenilUser\Controller\Index\activate

* tenil-user-auth
> /login
> TenilUser\Controller\Auth\index

* tenil-user-logout
> /logout
> TenilUser\Controller\Auth\logout

* tenil-user-admin
> /admin
> TenilUser\Controller\Users\index
> > admin/default
> > /[:controller[/:action[/:id]]]
> >
> > admin/paginator
> > /[:controller[/page/:page]]

#### Admin
##### Rotas

#### Auth
##### Rotas