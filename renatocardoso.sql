-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 179.188.16.199
-- Generation Time: 17-Dez-2018 às 13:51
-- Versão do servidor: 5.6.37-82.2-log
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renatocardoso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_alunos`
--

CREATE TABLE `cadastro_alunos` (
  `Codigo` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Senha` varchar(25) NOT NULL,
  `RA` varchar(25) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `Curso` varchar(30) NOT NULL,
  `Turma` varchar(30) NOT NULL,
  `EMail` varchar(255) NOT NULL,
  `Semestre` varchar(30) NOT NULL,
  `Ano` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro_alunos`
--

INSERT INTO `cadastro_alunos` (`Codigo`, `Nome`, `Senha`, `RA`, `CPF`, `Curso`, `Turma`, `EMail`, `Semestre`, `Ano`) VALUES
(5, 'Carina Cardoso', 'teste', '1', '1', 'Logística', ' ', 'carinacardoso@hotmail.com', '6o. Semestre', '2018'),
(8, 'Teste de Prova', 'teste01@', '', '23123123', 'ADS', ' ', 'teste@teste.com', '1o. Semestre', '2010'),
(9, 'Amanda Tainá Ponciano de Godoy', 'costelas', '0030741612003', '45556388830', 'Logística', ' ', 'atpg98@gmail.com', '6o. Semestre', '2018'),
(10, 'Bruno de Lima Lara', 'zeus3500', '0030741612045', '45124621800', 'Logística', ' ', 'bruxlima@hotmail.com', '6o. Semestre', '2018'),
(11, 'Fabrício Alves de Andrade', 'falogsansao31', '0030741612019', '29464134895', 'Logística', ' ', 'bricioaandrade@gmail.com', '6o. Semestre', '2018'),
(12, 'Cleiton Gimenes Souza', 'proview7', '0030741612046', '47170376857', 'Logística', ' ', 'cleiton.gimenes@hotmail.com', '6o. Semestre', '2018'),
(13, 'Estter Nayara Pereira', '05demaio', '0030741612017', '45840208841', 'Logística', ' ', 'estterpereira0@gmail.com', '6o. Semestre', '2018'),
(14, 'Sarah Nunes Cerqueira', 'caioevitor', '0030741612037', '45801301895', 'Logística', ' ', 'sarah.cerqueira22@gmail.com', '6o. Semestre', '2018'),
(15, 'Evelyn Alcardi de Moraes', 'Evelyn@97', '0030741612018', '45623500838', 'Logística', ' ', 'evelyn.am97@hotmail.com', '6o. Semestre', '2018'),
(17, 'André de Lucca júnior ', 'a230919', '0030741612005', '45404719885', 'Logística', ' ', 'andre.lucca.jr@gmail.com', '6o. Semestre', '2018'),
(19, 'Renan Wilson de Almeida Silva', 'familia24', '0030741612034', '48470302817', 'Logística', ' ', 'rewil424@gmail.com', '6o. Semestre', '2018'),
(20, 'Leandro Raphael de Oliveira', '573399', '0030741522021', '43754607847', 'Logística', ' ', 'leandro-oliveeira@hotmail.com', '6o. Semestre', '2018'),
(23, 'Joilson Martins Santana', 'joilson2607', '0030741612023', '42186922894', 'Logística', ' ', 'joilsonsantana@hotmail.com.br', '6o. Semestre', '2018'),
(26, 'Caroline Ribeiro Pereira de Camargo', 'cassia,kemily3', '0030741612011', '46432726867', 'Logística', ' ', 'caroliner.p.camargo@hotmail.com', '6o. Semestre', '2018'),
(27, 'Alice de Moura Fé', 'Augustoamor', '0030741612001', '447.344.578-08', 'Logística', ' ', 'alicefe21@gmail.com', '6o. Semestre', '2018'),
(28, 'Mariane da Silva Ribeiro', 'leonardo13', '0030741612043', '47438729877', 'Logística', ' ', 'marianessaviolli@hotmail.com', '6o. Semestre', '2018'),
(29, 'Yan Coutinho Ferreira Proença', '592510', '0030741612039', '09483996945', 'Logística', ' ', 'yan.cfp98@hotmail.com', '6o. Semestre', '2018'),
(31, 'mariana da silva isidoro', '32391465', '0030741612031', '39321895825', 'Logística', ' ', 'mariana.isidoro@yahoo.com.br', '6o. Semestre', '2018'),
(32, 'Ramon Serafim de Camargo', '15975300', '0030741612033', '45100825847', 'Logística', ' ', 'ramonserafim@outlook.com', '6o. Semestre', '2018'),
(47, 'Renato Luiz Cardoso', '12345', '', '', 'Logística', ' ', 'renato_luiz_cardoso@me.com', '1o. Semestre', '2010'),
(48, 'Rafael Farinha', 'Ra91367596', 'AD091191', '40054188806', 'Logística', ' ', 'rafarinha123@gmail.com', '1o. Semestre', '2010'),
(49, 'Márcia Arraes', 'marcia85', '', '', 'Logística', ' ', '', '1o. Semestre', '2010'),
(50, 'Mariana Sabino Ferreira Sampaio', '07021996', '0030481411032', '43593347881', 'Logística', ' ', 'masabfer@hotmail.com', '6o. Semestre', '2018'),
(51, 'Márcia Arraes', 'marcia2918', '', '', 'Logística', ' ', 'marcia.arraes@fatec.sp.gov.br', '1o. Semestre', '2010');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_professor`
--

CREATE TABLE `cadastro_professor` (
  `Codigo` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Senha` varchar(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telefone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro_professor`
--

INSERT INTO `cadastro_professor` (`Codigo`, `Nome`, `Senha`, `Email`, `Telefone`) VALUES
(1, 'renato', 'teste01@', 'renato.cardoso01@fatec.sp.gov.br', '15981236290'),
(2, 'Itamar', 'teste', 'itamar@teste.com', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_provas`
--

CREATE TABLE `cadastro_provas` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Codigo_prova` varchar(30) NOT NULL,
  `Disciplina` varchar(255) NOT NULL,
  `Professor` varchar(255) NOT NULL,
  `Duracao_horas` int(11) NOT NULL,
  `Duracao_minutos` int(11) NOT NULL,
  `Codigo_Acesso` varchar(30) NOT NULL,
  `Numero_Questoes` int(11) NOT NULL,
  `Descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro_provas`
--

INSERT INTO `cadastro_provas` (`Codigo`, `Titulo`, `Codigo_prova`, `Disciplina`, `Professor`, `Duracao_horas`, `Duracao_minutos`, `Codigo_Acesso`, `Numero_Questoes`, `Descricao`) VALUES
(14, 'Simulado para o ENADE turma de Logística', 'ENADE2018', 'Logística e Formação Geral', 'Itamar', 2, 0, '', 35, '  Simulado do ENADE, prova base - ENADE 2012 (Tecnólogo em Logística)\r\n                       '),
(15, 'Prova para uso como Tutorial do Sistema', 'TUTORIAL', 'Várias', 'Renato', 0, 5, 'Não possui', 3, '                        Prova para utilização como tutorial para demonstração do programa.'),
(17, 'Simulado ENADE Logística II', 'ENADESIM', 'Logística', 'Itamar', 1, 30, 'ENADESIM', 30, '                  Simulado para o ENADE.         ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_questoes`
--

CREATE TABLE `cadastro_questoes` (
  `Codigo` int(11) NOT NULL,
  `Disciplina` varchar(50) NOT NULL,
  `Questao` text NOT NULL,
  `RespostaA` text NOT NULL,
  `RespostaB` text NOT NULL,
  `RespostaC` text NOT NULL,
  `RespostaD` text NOT NULL,
  `RespostaE` text NOT NULL,
  `Correta` varchar(3) NOT NULL,
  `Feedback_Positivo` varchar(1000) NOT NULL,
  `Feedback_Negativo` varchar(1000) NOT NULL,
  `Professor_Responsavel` varchar(255) NOT NULL,
  `Figura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro_questoes`
--

INSERT INTO `cadastro_questoes` (`Codigo`, `Disciplina`, `Questao`, `RespostaA`, `RespostaB`, `RespostaC`, `RespostaD`, `RespostaE`, `Correta`, `Feedback_Positivo`, `Feedback_Negativo`, `Professor_Responsavel`, `Figura`) VALUES
(41, 'Formação Geral', 'Segundo a pesquisa Retratos da Leitura no Brasil, realizada pelo Instituto Pró-Livro, a média anual brasileira de livros lidos por habitante era, em 2011, de 4,0. Em 2007, esse mesmo parâmetro correspondia a 4,7 livros por habitante/ano.<br>De acordo com as informações apresentadas, verifica-se que:<br>', 'Metade da população brasileira é constituída de leitores que tendem a ler mais livros a cada ano.', 'O Nordeste é a região do Brasil em que há a maior proporção de leitores em relação à sua população.', 'O número de leitores, em cada região brasileira, corresponde a mais da metade da população da região.', 'O Sudeste apresenta o maior número de leitores do país, mesmo tendo diminuído esse número em 2011.', 'A leitura está disseminada em um universo cada vez menor de brasileiros, independentemente da região do país.', 'D', '', '', 'renato', 'figuras/logsim2012fig1.JPG'),
(42, 'Formação Geral', 'O Cerrado, que ocupa mais de 20% do território nacional, é o segundo maior bioma brasileiro, menor apenas que a Amazônia. Representa um dos hotspots para a conservação da biodiversidade mundial e é considerado uma das mais\r\nimportantes fronteiras agrícolas do planeta.<br> Considerando a conservação da biodiversidade e a expansão da fronteira agrícola no Cerrado, avalie as afirmações\r\na seguir. <br><br>\r\nI. O Cerrado apresenta taxas mais baixas de desmatamento e percentuais mais altos de áreas protegidas que os demais biomas brasileiros.<br><br>\r\nII. O uso do fogo é, ainda hoje, uma das práticas de conservação do solo recomendáveis para controle de pragas e estímulo à rebrota de capim em áreas de pastagens naturais ou artificiais do Cerrado.<br><br>\r\nIII. Exploração excessiva, redução progressiva do habitat e presença de espécies invasoras estão entre os fatores que mais provocam o aumento da probabilidade de extinção das populações naturais do Cerrado.<br><br>\r\nIV. Elevação da renda, diversificação das economias e o consequente aumento da oferta de produtos agrícolas e\r\nda melhoria social das comunidades envolvidas estão entre os benefícios associados à expansão da agricultura\r\nno Cerrado.<br><br>\r\nÉ correto apenas o que se afirma em:', 'Apenas I', 'Apenas II', 'I e III', 'II e IV', 'III e IV', 'E', '', '', 'renato', 'figuras/'),
(43, 'Formação Geral', 'A floresta virgem é o produto de muitos milhões de anos que passaram desde a origem do nosso planeta. Se for abatida, pode crescer uma nova floresta, mas a continuidade é interrompida. A ruptura nos ciclos de vida natural de plantas e animais significa que a floresta nunca será aquilo que seria se as árvores não tivessem sido cortadas. \r\n<br><br>A partir do momento em que a floresta é abatida ou inundada, a ligação com o passado perde-se para sempre. <br><br>Trata-se de um custo que será suportado por\r\ntodas as gerações que nos sucederem no planeta. <br><br>É por isso que os ambientalistas têm razão quando se referem ao meio natural como um “legado mundial”.<br><br>\r\nMas, e as futuras gerações? Estarão elas preocupadas com essas questões amanhã? As crianças e os jovens, como indivíduos principais das futuras gerações, têm sido, cada\r\nvez mais, estimulados a apreciar ambientes fechados, onde podem relacionar-se com jogos de computadores, celulares e outros equipamentos interativos virtuais,\r\ndesviando sua atenção de questões ambientais e do impacto disso em vidas no futuro, apesar dos esforços em contrário realizados por alguns setores. <br><br>Observe-se que, se perguntarmos a uma criança ou a um jovem se eles desejam ficar dentro dos seus quartos, com computadores e jogos eletrônicos, ou passear em uma\r\npraça, não é improvável que escolham a primeira opção.<br><br>\r\nEssas posições de jovens e crianças preocupam tanto\r\nquanto o descaso com o desmatamento de florestas hoje\r\ne seus efeitos amanhã.<br><br>\r\nSINGER, P. Ética Prática. 2 ed. Lisboa: Gradiva, 2002, p. 292 (adaptado).<br><br>\r\nÉ um título adequado ao texto apresentado acima:', 'Computador: o legado mundial para as gerações futuras', 'Uso de tecnologias pelos jovens: indiferença quanto à\r\npreservação das florestas', 'Preferências atuais de lazer de jovens e crianças:\r\npreocupação dos ambientalistas', 'Engajamento de crianças e jovens na preservação do\r\nlegado natural: uma necessidade imediata', 'Redução de investimentos no setor de comércio\r\neletrônico: proteção das gerações futuras', 'D', '', '', 'renato', 'figuras/'),
(44, 'Formação Geral', 'É ou não ético roubar um remédio cujo preço é inacessível, a fim de salvar alguém, que, sem ele, morreria?<br>\r\nSeria um erro pensar que, desde sempre, os homens têm as mesmas respostas para questões desse tipo. Com o passar do tempo, as sociedades mudam e também\r\nmudam os homens que as compõem. <br><br>Na Grécia Antiga,\r\npor exemplo, a existência de escravos era perfeitamente\r\nlegítima: as pessoas não eram consideradas iguais entre\r\nsi, e o fato de umas não terem liberdade era considerado\r\nnormal. Hoje em dia, ainda que nem sempre respeitados,\r\nos Direitos Humanos impedem que alguém ouse defender,\r\nexplicitamente, a escravidão como algo legítimo.<br><br>\r\nMINISTÉRIO DA EDUCAÇÃO. Secretaria de Educação Fundamental. Ética. Brasília,\r\n2012. Disponível em: <portal.mec.gov.br>. Acesso em: 16 jul. 2012 (adaptado).<br><br>\r\nCom relação a ética e cidadania, avalie as afirmações seguintes.<br><br>\r\nI. Toda pessoa tem direito ao respeito de seus\r\nsemelhantes, a uma vida digna, a oportunidades\r\nde realizar seus projetos, mesmo que esteja\r\ncumprindo pena de privação de liberdade, por ter\r\ncometido delito criminal, com trâmite transitado\r\ne julgado.<br><br>\r\nII. Sem o estabelecimento de regras de conduta, não\r\nse constrói uma sociedade democrática, pluralista\r\npor definição, e não se conta com referenciais\r\npara se instaurar a cidadania como valor.<br><br>\r\nIII. Segundo o princípio da dignidade humana, que é\r\ncontrário ao preconceito, toda e qualquer pessoa é\r\ndigna e merecedora de respeito, não importando,\r\nportanto, sexo, idade, cultura, raça, religião, classe\r\nsocial, grau de instrução e orientação sexual.<br><br>', 'Apenas I está correta', 'Apenas III está correta.', 'Estão corretas I e II', 'Estão corretas II e III', 'I, II e III estão corretas', 'E', '', '', 'renato', 'figuras/'),
(45, 'Formação Geral', 'A globalização é o estágio supremo da internacionalização.\r\nO processo de intercâmbio entre países, que marcou\r\no desenvolvimento do capitalismo desde o período\r\nmercantil dos séculos 17 e 18, expande-se com a\r\nindustrialização, ganha novas bases com a grande\r\nindústria nos fins do século 19 e, agora, adquire mais\r\nintensidade, mais amplitude e novas feições. O mundo\r\ninteiro torna-se envolvido em todo tipo de troca: técnica,\r\ncomercial, financeira e cultural. A produção e a informação\r\nglobalizadas permitem a emergência de lucro em escala\r\nmundial, buscado pelas firmas globais, que constituem o\r\nverdadeiro motor da atividade econômica.<br><br>\r\nSANTOS, M. O país distorcido. São Paulo: Publifolha, 2002 (adaptado).<br><br>\r\nNo estágio atual do processo de globalização, pautado na\r\nintegração dos mercados e na competitividade em escala\r\nmundial, as crises econômicas deixaram de ser problemas\r\nlocais e passaram a afligir praticamente todo o mundo.<br><br>\r\nA crise recente, iniciada em 2008, é um dos exemplos mais\r\nsignificativos da conexão e interligação entre os países,\r\nsuas economias, políticas e cidadãos.<br><br>\r\nConsiderando esse contexto, avalie as seguintes asserções\r\ne a relação proposta entre elas.<br><br>\r\nI. O processo de desregulação dos mercados financeiros\r\nnorte-americano e europeu levou à formação de uma\r\nbolha de empréstimos especulativos e imobiliários,\r\na qual, ao estourar em 2008, acarretou um efeito\r\ndominó de quebras nos mercados.<br><br>\r\nPORQUE<br><br>\r\nII. As políticas neoliberais marcam o enfraquecimento\r\ne a dissolução do poder dos Estados nacionais,\r\nbem como asseguram poder aos aglomerados\r\nfinanceiros que não atuam nos limites geográficos\r\ndos países de origem.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II\r\né uma justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a II\r\nnão é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'C', '', '', 'renato', 'figuras/'),
(46, 'Formação Geral', 'O anúncio feito pelo Centro Europeu para a Pesquisa\r\nNuclear (CERN) de que havia encontrado sinais de uma\r\npartícula que pode ser o bóson de Higgs provocou\r\nfuror no mundo científico. A busca pela partícula tem\r\ngerado descobertas importantes, mesmo antes da sua\r\nconfirmação. Algumas tecnologias utilizadas na pesquisa\r\npoderão fazer parte de nosso cotidiano em pouco\r\ntempo, a exemplo dos cristais usados nos detectores do\r\nacelerador de partículas large hadron colider (LHC), que\r\nserão utilizados em materiais de diagnóstico médico ou\r\nadaptados para a terapia contra o câncer. “Há um círculo\r\nvicioso na ciência quando se faz pesquisa”, explicou o\r\ndiretor do CERN. “Estamos em busca da ciência pura, sem\r\nsaber a que servirá. Mas temos certeza de que tudo o que\r\ndesenvolvemos para lidar com problemas inéditos será\r\nútil para algum setor.”<br><br>\r\nCHADE, J. Pressão e disputa na busca do bóson. O Estado de S. Paulo,\r\np. A22, 08/07/2012 (adaptado).<br><br>\r\nConsiderando o caso relatado no texto, avalie as seguintes\r\nasserções e a relação proposta entre elas.<br><br>\r\nI. É necessário que a sociedade incentive e financie\r\nestudos nas áreas de ciências básicas, mesmo que não\r\nhaja perspectiva de aplicação imediata.<br><br>\r\nPORQUE<br><br>\r\nII. O desenvolvimento da ciência pura para a busca de\r\nsoluções de seus próprios problemas pode gerar\r\nresultados de grande aplicabilidade em diversas áreas\r\ndo conhecimento.<br><br>', 'As asserções I e II são proposições verdadeiras, e a\r\nII é uma justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/'),
(47, 'Formação Geral', 'Legisladores do mundo se comprometem\r\na alcançar os objetivos da Rio+20<br><br>\r\nReunidos na cidade do Rio de Janeiro, 300 parlamentares\r\nde 85 países se comprometeram a ajudar seus governantes\r\na alcançar os objetivos estabelecidos nas conferências\r\nRio+20 e Rio 92, assim como a utilizar a legislação para\r\npromover um crescimento mais verde e socialmente\r\ninclusivo para todos.\r\nApós três dias de encontros na Cúpula Mundial de\r\nLegisladores, promovida pela GLOBE International —\r\numa rede internacional de parlamentares que discute\r\nações legislativas em relação ao meio ambiente —, os\r\nparticipantes assinaram um protocolo que tem como\r\nobjetivo sanar as falhas no processo da Rio 92.\r\nEm discurso durante a sessão de encerramento do evento,\r\no vice-presidente do Banco Mundial para a América Latina\r\ne o Caribe afirmou: “Esta Cúpula de Legisladores mostrou\r\nclaramente que, apesar dos acordos globais serem úteis,\r\nnão precisamos esperar. Podemos agir e avançar agora,\r\nporque as escolhas feitas hoje nas áreas de infraestrutura,\r\nenergia e tecnologia determinarão o futuro”. <br><br>\r\nDisponível em: worldbank.org.\r\nAcesso em: 22 jul. 2012 (adaptado).<br><br>O compromisso assumido pelos legisladores, explicitado\r\nno texto acima, é condizente com o fato de que', 'os acordos internacionais relativos ao meio ambiente\r\nsão autônomos, não exigindo de seus signatários\r\na adoção de medidas internas de implementação\r\npara que sejam revestidos de exigibilidade pela\r\ncomunidade internacional.', 'a mera assinatura de chefes de Estado em acordos\r\ninternacionais não garante a implementação interna\r\ndos termos de tais acordos, sendo imprescindível,\r\npara isso, a efetiva participação do Poder Legislativo\r\nde cada país.', 'as metas estabelecidas na Conferência Rio 92 foram\r\ncumpridas devido à propositura de novas leis internas,\r\nincremento de verbas orçamentárias destinadas ao\r\nmeio ambiente e monitoramento da implementação da\r\nagenda do Rio pelos respectivos governos signatários.', 'a atuação dos parlamentos dos países signatários de\r\nacordos internacionais restringe-se aos mandatos de seus\r\nrespectivos governos, não havendo relação de causalidade\r\nentre o compromisso de participação legislativa e o\r\nalcance dos objetivos definidos em tais convenções.', 'a Lei de Mudança Climática aprovada recentemente\r\nno México não impacta o alcance de resultados dos\r\ncompromissos assumidos por aquele país de reduzir\r\nas emissões de gases do efeito estufa, de evitar o\r\ndesmatamento e de se adaptar aos impactos das\r\nmudanças climáticas.', 'B', '', '', 'renato', 'figuras/'),
(48, 'Formação Geral', 'A tabela apresenta a taxa de rotatividade no mercado\r\nformal brasileiro, entre 2007 e 2009. Com relação a esse\r\nmercado, sabe-se que setores como o da construção\r\ncivil e o da agricultura têm baixa participação no total\r\nde vínculos trabalhistas e que os setores de comércio e\r\nserviços concentram a maior parte das ofertas. A taxa\r\nmédia nacional é a taxa média de rotatividade brasileira\r\nno período, excluídos transferências, aposentadorias,\r\nfalecimentos e desligamentos voluntários.<br><br>\r\nCom base nesses dados, avalie as afirmações seguintes.<br><br>\r\nI. A taxa média nacional é de, aproximadamente, 36%.<br><br>\r\nII. O setor de comércio e o de serviços, cujas taxas de\r\nrotatividade estão acima da taxa média nacional,\r\ntêm ativa importância na taxa de rotatividade, em\r\nrazão do volume de vínculos trabalhistas por eles\r\nestabelecidos.<br><br>\r\nIII. As taxas anuais de rotatividade da indústria de\r\ntransformação são superiores à taxa média nacional.<br><br>\r\nIV. A construção civil é o setor que apresenta a maior\r\ntaxa de rotatividade no mercado formal brasileiro,\r\nno período considerado.<br><br>\r\nÉ correto apenas o que se afirma em<br><br>', 'I e II', 'I e III', 'III e IV', 'I, II e IV', 'II, III e IV', 'D', '', '', 'renato', 'figuras/logsim2012fig2.JPG'),
(49, 'Logística', 'A gestão dos processos de distribuição e transportes\r\npode ser aferida por intermédio do uso de indicadores de\r\ndesempenho calculados para essa finalidade. <br><br>Considerando\r\nesse contexto, avalie as afirmações abaixo acerca de\r\nconceitos de indicadores usados para mensurar a qualidade\r\ndo processo de transporte.<br><br>\r\nI. Pedido perfeito – mensura o percentual de\r\npedidos entregues no prazo negociado com o\r\ncliente, completo, sem avarias e sem problemas\r\nna documentação fiscal.<br><br>\r\nII. Percentual de entregas (ou coletas) realizadas no\r\nprazo – mensura o percentual de entregas (ou\r\ncoletas) realizadas dentro do prazo combinado\r\ncom o cliente.<br><br>\r\nIII. Custo com não-conformidades em transportes –\r\nmensura a participação de custos decorrentes de\r\nnão conformidades no processo de planejamento,\r\ngestão e operação de transportes, tais como:\r\ndevoluções, re-entregas, multas por atraso em\r\nentregas, indenizações de avarias, gastos com\r\nfrete aéreo não previsto.<br><br>\r\nIV. Índice de atendimento do pedido – mensura\r\no percentual de pedidos atendidos em sua\r\ntotalidade, na quantidade e na diversidade de\r\nitens, na primeira remessa ao cliente.<br><br>\r\nSão corretos os conceitos apresentados nas proposições<br><br>', 'I e III, apenas', 'I e IV, apenas.', 'II e III, apenas.', 'II e IV, apenas.', 'I, II, III e IV.', 'E', '', '', 'renato', 'figuras/'),
(50, 'Logística', 'O procedimento de despacho aduaneiro é iniciado na\r\nparametrização da carga em canais, onde é submetida\r\nà análise fiscal e selecionada para um dos canais de\r\nconferência. Os canais de conferência são quatro: verde,\r\namarelo, vermelho e cinza. <br><br>Considerando esse contexto,\r\navalie as afirmações abaixo.<br><br>\r\nI. A importação selecionada para o canal verde é\r\ndesembaraçada automaticamente, sem qualquer\r\nverificação.<br><br>\r\nII. No caso de seleção para o canal vermelho, ocorre\r\na conferência documental, mas não há verificação\r\nfísica da mercadoria.<br><br>\r\nIII. No canal amarelo é realizada a verificação física\r\nda mercadoria e a aplicação de procedimento\r\nespecial de controle aduaneiro, para verificação\r\nde elementos indiciários de fraude.<br><br>\r\nÉ correto o que se afirma em:<br><br>', 'I, apenas.', 'II, apenas.', 'I e III, apenas.', 'II e III, apenas.', 'I, II e III.', 'A', '', '', 'renato', 'figuras/'),
(51, 'Logística', 'Segundo a Associação Brasileira de Movimentação e\r\nLogística (ABML), o operador logístico\r\n“É o fornecedor de serviços logísticos, especializado\r\nem gerenciar e executar atividades logísticas da cadeia\r\nde abastecimento de seu cliente, agregando valor ao\r\nproduto e com competência para prestar serviços nas três\r\natividades básicas: controle de estoque, armazenagem e\r\ngestão de transportes”.<br><br>\r\nSegundo esse conceito, os critérios de operação de um\r\noperador logístico dedicado a produtos alimentícios\r\né diferente daqueles que caracterizam o operador de\r\nprodutos de bens duráveis, quanto a movimentação\r\ne estocagem.<br><br> Considerando esse contexto, avalie as\r\nseguintes asserções e a relação proposta entre elas.<br><br>\r\nI. A movimentação de um operador logístico\r\nespecializado em produtos alimentícios deve utilizar\r\na metodologia F.I.F.O. (First-Input-First-Output), pois\r\nesses produtos têm prazo de validade e devem ser\r\nmovimentados na sua ordem de chegada, mesmo que\r\nessa metodologia seja mais dispendiosa.<br><br>\r\nPORQUE<br><br>\r\nII. A movimentação de um operador logístico\r\nespecializado em produtos de bens duráveis pode\r\nutilizar uma metodologia mais barata como a L.I.F.O.\r\n(Last-Input-First-Output), pois esses produtos podem\r\nser manuseados independentemente da sua ordem\r\nde chegada.<br><br>\r\nConsiderando essas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'B', '', '', 'renato', 'figuras/'),
(52, 'Logística', 'Os impactos ambientais das atividades empresariais, como\r\nresíduos e lixo, podem ser administrados nas organizações\r\ncom iniciativas de logística reversa. <br><br>A logística reversa não\r\né apenas uma prática ambiental a fim de recolher resíduos\r\npara sua reutilização como novas matérias-primas. Inclui\r\ntambém o tratamento e o acondicionamento final dos\r\nrejeitos de maneira apropriada.<br><br>\r\nLEITE, P. R. Logística reversa: meio ambiente e competitividade. São Paulo:\r\nPrentice Hall, 2003 (adaptado).<br><br>\r\nConsiderando o texto acima, avalie as afirmações a seguir.<br><br>\r\nI. A logística de pós-venda é caracterizada pelo\r\nrecolhimento dos resíduos dos produtos da\r\nempresa junto aos consumidores, tais como\r\nembalagens de plástico e caixas de papelão, e sua\r\ndestinação.<br><br>\r\nII. A logística de pós-consumo é caracterizada pela\r\ngestão dos produtos após terem sido utilizados\r\npelo consumidor, tais como lâmpadas e baterias.<br><br>\r\nIII. Os comportamentos não lucrativos são\r\nprovenientes da gestão dos fluxos reversos,\r\nque admitem a concepção de um novo fluxo de\r\nmatérias-primas advindas das etapas de pósconsumo\r\ne/ou pós-venda.<br><br>\r\nÉ correto o que se afirma em:<br><br>', 'Apenas I', 'Apenas III', 'I e II, apenas.', 'II e III, apenas.', 'I, II e III.', 'C', '', '', 'renato', 'figuras/'),
(53, 'Logística', 'Normalmente, o transporte é o elemento que mais\r\nimpacta nos custos logísticos de uma empresa,\r\nchegando a absorver, em média, dois terços desses\r\ncustos. A administração da atividade de transporte\r\nenvolve a escolha do modal de transporte mais adequado\r\nem função de suas vantagens e desvantagens para\r\ncada situação.<br><br>\r\nBALLOU, R. H. Gerenciamento da cadeia de suprimentos: logística empresarial.\r\n5 ed. Porto Alegre: Bookman Editora, 2006 (adaptado).<br><br>\r\nA respeito de modais de transporte, avalie as informações\r\na seguir.<br><br>\r\nI. O modal aéreo é veloz e caro, apresentando uma\r\nrelação desempenho versus custo viável, quando\r\nse trata do envio de cargas de alto valor agregado.<br><br>\r\nII. O modal rodoviário caracteriza-se pela\r\nbaixa flexibilidade, sendo utilizado para\r\ncomplementar o transporte entre os pontos de\r\nembarque e desembarque.<br><br>\r\nIII. O modal ferroviário apresenta leadtimes lentos,\r\nbaixo custo de frete, e flexibilidade e capilaridade\r\nbaixas com os destinos fixos.<br><br>\r\nIV. O modal hidroviário é o transporte que utiliza o\r\nmeio aquático para a movimentação de cargas\r\ne passageiros. <br><br>\r\nÉ correto apenas o que se afirma em: <br><br>', 'I e II.', 'I e IV.', 'II e III.', 'I, III e IV.', 'II, III e IV.', 'D', '', '', 'renato', 'figuras/'),
(54, 'Logística', 'O intercâmbio eletrônico de dados (eletronic data\r\ninterchange - EDI) é um formato padrão para trocar\r\ndados de negócios. Uma mensagem EDI contém uma\r\nsequência de dados, por exemplo, preço, número de\r\nsérie e quantidade. <br><br>O EDI é usado entre duas empresas\r\nque fazem sempre o mesmo tipo de transação,\r\ncomo as transações entre fornecedor e comprador.<br><br>\r\nOs dados trafegam pela Internet, integrando empresas\r\nindependentemente do seu porte, da estrutura de\r\ntecnologia da informação ou do nível de conhecimento\r\nde seus funcionários. Logo, não há necessidade de\r\nsoftware e treinamentos específicos para uso do sistema\r\nque opera em ambiente web. <br><br>O EDI tem como benefícios<br><br>\r\nI. a eliminação da necessidade de impressão,\r\npostagem, verificação e manuseio de inúmeros\r\nformulários e documentos comerciais.<br><br>\r\nII. a redução de atrasos pela utilização de\r\nformatos padrão.<br><br>\r\nIII. a diminuição de custos com a redução do uso de\r\npapel, da postagem e da mão-de-obra.<br><br>\r\nÉ correto o que se afirma em<br><br>', 'I, apenas.', 'III, apenas.', 'I e II, apenas.', 'II e III, apenas.', 'I, II e III.', 'E', '', '', 'renato', 'figuras/'),
(55, 'Logística', 'A distribuição é um processo que está normalmente\r\nassociado ao movimento de material de um ponto de\r\nprodução ou armazenagem até o cliente. As atividades\r\nabrangem as funções de gestão e controle de estoque,\r\nmanuseio de materiais ou produtos acabados, transporte,\r\narmazenagem, administração de pedidos, análises de\r\nlocais e redes de distribuição, entre outras. <br><br>O retorno de\r\nprodutos em bom ou mau estado também é parte desse\r\nprocesso, embora em alguns segmentos pouca atenção\r\nseja dada a essa função.<br><br>\r\nBERTAGLIA, P. R. Logística e gerenciamento da cadeia de abastecimento.\r\nSão Paulo: Atlas, 2003.<br><br>\r\nCom base no texto, avalie as seguintes asserções e a\r\nrelação proposta entre elas.<br><br>\r\nI. As organizações que querem ter sucesso no mercado\r\ncompetitivo global dependem do relacionamento que\r\nmantêm com seus fornecedores para atender com\r\neficiência a demanda dos clientes.<br><br>\r\nPORQUE<br><br>\r\nII. Em uma empresa, conhecer a cadeia de suprimentos\r\ne seus subprocessos é fundamental para se atingir os\r\nresultados esperados e responder prontamente às\r\nmudanças, com flexibilidade e agilidade.<br><br>\r\nA respeito dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/'),
(56, 'Logística', 'Qual é a atividade responsável pela coleta do mix\r\ncorreto de produtos, em suas quantidades adequadas\r\npara a área de armazenagem de modo a satisfazer as\r\nnecessidades do consumidor?', 'Logística integrada.', 'Atividade de picking.', 'Coleta sincronizada.', 'Just in time.', 'Kanban.', 'B', '', '', 'renato', 'figuras/'),
(57, 'Logística', 'A escolha de um modal de transporte depende de\r\numa variedade de características dos serviços que são\r\nfundamentais, como tarifas de fretes, confiabilidade,\r\ntempo em trânsito, perdas, danos, processamento das\r\nrespectivas reclamações, rastreabilidade, considerações\r\nde mercado do embarcador e considerações relativas\r\naos transportadores, que afetam significativamente os\r\ncustos dos serviços.<br><br>\r\nBALLOU, R. H. Gerenciamento da cadeia de suprimentos: logística\r\nempresarial. 5. ed., Porto Alegre: Bookman, 2006, p. 188.<br><br>\r\nConsiderando o contexto mencionado acima, avalie as\r\nasserções a seguir e a relação proposta entre elas.<br><br>\r\nI. Quando se escolhem serviços de menor agilidade\r\ne confiabilidade, mais estoques aparecerão no\r\ncanal de distribuição.<br><br>\r\nPORQUE<br><br>\r\nII. A rapidez e a confiabilidade afetam os níveis de\r\nestoques do embarcador e do comprador (estoque\r\nde pedido e estoque de segurança), tanto quanto o\r\nnível dos estoques em trânsito entre as sedes do\r\nembarcador e do comprador.<br><br>\r\nA respeito dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/'),
(58, 'Logística', 'As mudanças da forma física das mercadorias e o\r\naparecimento de métodos de manipulação, condições de\r\narmazenagem e processo de transformação deram um\r\nimpulso para o desenvolvimento operacional da forma\r\nde embarque nos modais. Com isso, destacam-se alguns\r\nequipamentos de unitização como', 'rastreamento e distribuição.', 'roteirização e suprimento.', 'siscomex e draw back.', 'big-bags e contêineres.', 'portainer e transtainer.', 'D', '', '', 'renato', 'figuras/'),
(59, 'Logística', 'Uma empresa do setor metal mecânico foi contratada para produzir 10 000 espelhos retrovisores para uma montadora\r\nde veículos, devendo entregar 1 000 peças por mês. De acordo com a equipe responsável pela gestão de estoques, foi\r\nsugerido adquirir 10 000 kits para a produção do equipamento, mas, com o início da produção, observou-se um índice\r\nde refugo na confecção do retrovisor que gerou os seguintes dados.<br><br>Ao final do 9º mês, a equipe de produção e logística verificou que não seria possível produzir os 1 000 retrovisores\r\nda última remessa. <br>Desse modo, foram solicitados novos kits para a reposição de estoques e, consequentemente, o\r\ncumprimento do contrato. <br>Qual a quantidade mínima de kits necessária nessa situação?', '585', '650', '935', '1000', '1065', 'B', '', '', 'renato', 'figuras/logsim2012fig3.JPG'),
(60, 'Logística', 'Em logística, existem dois prazos cruciais para a eficiência do processo: o prazo logístico, resultante da soma dos tempos\r\nde aquisição dos insumos, de manufatura do produto e de entrega ao cliente; e o ciclo do pedido do cliente, que é o\r\ntempo decorrido entre o pedido e o recebimento do produto pelo cliente.<br><br>\r\nConsiderando essa observação, avalie as seguintes asserções e a relação proposta entre elas.<br><br>\r\nI. Um dos desafios da logística está em igualar o prazo logístico ao ciclo do pedido do cliente.<br><br>\r\nPORQUE<br><br>\r\nII. Os consumidores querem os bens e serviços no tempo, no lugar e com a qualidade contratada.<br><br>\r\nA respeito dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é uma justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a II não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma proposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma proposição verdadeira.', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/'),
(61, 'Logística', 'As tecnologias de identificação de produtos, insumos ou\r\nserviços mais utilizadas são o código de barras e as etiquetas\r\neletrônicas (Radio Frequency Identification - RFID). <br><br>Quanto\r\na essas tecnologias, avalie as afirmações a seguir.<br>\r\nI. A tecnologia de código de barras tem uma\r\ncaracterística de grande importância para o\r\nmercado atual, que é a identificação única do\r\nproduto, insumo, palete ou caixa.<br><br>\r\nII. A tecnologia RFID armazena as informações em\r\num chip instalado em sua estrutura.<br><br>\r\nIII. Sistemas com código de barras necessitam acessar\r\num banco de dados para coletar informações\r\npertinentes aos produtos, insumos ou serviços\r\nque estão sendo movimentados.<br><br>\r\nÉ correto o que se afirma em<br><br>', 'I, apenas.', 'III, apenas.', 'I e II, apenas.', 'II e III, apenas.', 'I, II e III.', 'E', '', '', 'renato', 'figuras/'),
(62, 'Logística', 'A forma de entrega de um produto aliada ao tempo de\r\nespera influencia a percepção dos clientes que buscam\r\ndiferenciais que excedam suas expectativas. Os processos\r\ninternos podem cooperar para que o recebimento de um\r\nmaterial seja agilizado.<br><br>\r\nSuponha que uma indústria responsável pela manufatura\r\nde robôs para a indústria automobilística passa por um\r\ngrande momento de produção, pois as montadoras\r\nfizeram encomendas de novos robôs para suas linhas\r\nde montagem e querem que o produto seja entregue\r\nem tempo recorde.<br><br> A matéria-prima que envolve a\r\nmanufatura de robôs tem custo elevado em razão de\r\ncomponentes eletrônicos importados. Aliado a esse fator,\r\nverifica-se grande rotação de peças no almoxarifado,\r\nsendo necessário controlar, com precisão, o material que\r\né enviado para a produção, a qual trabalha em três turnos\r\ne, por isso, exige um abastecimento rápido.<br><br>\r\nPara que esse controle seja feito de forma apropriada, é adequado<br><br>', 'fazer o controle usando o inventário rotativo.', 'contratar uma transportadora eficiente.', 'reduzir o número de itens a serem armazenados.', 'fazer o controle usando um inventário semestral.', 'implantar câmeras de circuito fechado no almoxarifado.', 'A', '', '', 'renato', 'figuras/'),
(63, 'Logística', 'O departamento de compras de uma empresa deve\r\nmanter em seu cadastro, no mínimo, três fornecedores\r\npara cada tipo de material, pois não é recomendável\r\numa empresa depender do fornecimento de apenas\r\numa fonte. As vantagens desse critério para a área de\r\ncompras incluem<br><br><br>\r\nI. maior segurança no ciclo de reposição de materiais.<br><br>\r\nII. maior liberdade de negociação e, consequentemente,\r\nfavorecimento do potencial de redução do preço\r\nde compra.<br><br>\r\nIII. maiores oportunidades para os fornecedores se\r\nfamiliarizarem com os componentes ou peças\r\nproduzidos pela empresa.<br><br>\r\nÉ correto o que se afirma em<br><br>', 'I, apenas.', 'III, apenas.', 'I e II, apenas.', 'II e III, apenas.', 'I, II e III.', 'E', '', '', 'renato', 'figuras/'),
(65, 'Logística', 'Uma grande rede de supermercados realiza todo\r\ndia 5 de cada mês uma promoção para a venda de\r\n5 040 litros de leite longa vida. <br><br>Para que isso seja possível,\r\na movimentação dos fardos inicia-se no dia 3 no seu\r\ndepósito de embalagens. <br><br>No dia 3 do mês de outubro,\r\nhouve um problema na movimentação, pois o palete\r\nrompeu-se durante o translado do depósito até o veículo\r\nde transporte, danificando 100 fardos contendo 12 litros\r\ncada um. <br><br>No mesmo momento, o gerente de compras\r\nentrou em contato com o fornecedor para substituir\r\nos fardos danificados, mas a empresa responsável pela\r\nvenda e entrega do produto conseguiu disponibilizar\r\napenas 50 fardos.<br><br>\r\nNa situação descrita acima, se o supermercado fatura\r\nR$ 0,20 por litro de leite vendido, então, no mês de\r\noutubro, a venda de leite gerou um faturamento de<br><br>', '1008,00', '988,00', '888,00', '768,00', '240,00', 'C', '', '', 'renato', 'figuras/'),
(66, 'Logística', 'O uso de sistemas de rastreamento tem-se tornado muito\r\ncomum entre os grandes operadores logísticos e empresas\r\ntransportadoras. <br><br>Os sistemas têm-se mostrado cada vez\r\nmais completos e complexos, pois possibilitam, entre\r\noutras funcionalidades, a criação de cercas eletrônicas, o\r\nmonitoramento de baús, lacres e fechaduras e, juntamente\r\ncom ferramentas de Radio Frequency Identification (RFID),\r\npermitem o rastreamento das cargas transportadas.<br><br>\r\nCom relação ao uso de sistemas de rastreamento e\r\nmonitoramento, avalie as seguintes asserções e a relação\r\nproposta entre elas.<br><br>\r\nI. O uso da tecnologia RFID possibilita a identificação e\r\na localização de uma carga, utilizando, para isso, o seu\r\nposicionamento via satélite.<br><br>\r\nPORQUE<br><br>\r\nII. Os rastreadores não enviam informações específicas\r\nda carga transportada, mas permitem a sua localização,\r\nutilizando o sistema de Global Positioning System\r\n(GPS), a triangulação de antenas de rádio e redes de\r\ntelefonia celular.<br><br>\r\nAcerca dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'E', '', '', 'renato', 'figuras/'),
(67, 'Logística', 'Em toda a cadeia de suprimentos, a utilização de\r\nequipamentos e de dispositivos de movimentação de\r\ncarga e armazenagem é fundamental para o fluxo de\r\nmercadorias. <br><br>Considerando a boa utilização desses\r\nequipamentos e dispositivos, avalie as afirmações abaixo.<br><br>\r\nI. Os paletes são fabricados de acordo com as\r\nnormas da empresa e podem ser feitos em\r\nmadeira, plástico ou metal.<br><br>\r\nII. Paletes auxiliam e facilitam tarefas de embalagem,\r\nunitização, movimentação interna, transporte e\r\narmazenagem de materiais.<br><br>\r\nIII. No que se refere à armazenagem de recursos\r\nmateriais, o uso de prateleiras é adequado à\r\nestocagem de materiais de dimensões variadas.<br><br>\r\nIV. Nas leis da movimentação de materiais, estão previstos\r\na mínima utilização dos equipamentos e o uso de\r\nquaisquer equipamentos, embalagens e layout.<br><br>\r\nV. O tombador de caminhões é posicionado junto às áreas\r\nde armazenagem para movimentar grãos e líquidos.<br><br>\r\nÉ correto apenas o que se afirma em<br><br>', 'I e II.', 'I e V.', 'II e III.', 'III e IV.', 'IV e V.', 'C', '', '', 'renato', 'figuras/'),
(68, 'Logística', 'Determinada empresa, após uma detalhada análise dos\r\ndiversos equipamentos disponíveis no mercado para\r\nmovimentação de materiais, optou pela utilização do\r\nsistema de porta-paletes, drive-in e drive-thru.<br><br>\r\nConsiderando as vantagens na utilização desse sistema de\r\nmovimentação de materiais, avalie as afirmações abaixo.<br><br><br><br>\r\nI. Proporciona alta densidade de armazenamento,\r\ngraças à eliminação de corredores.<br><br>\r\nII. Possui acesso aos paletes intermediários, sem\r\nnecessidade de movimentação de outros paletes.<br><br>\r\nIII. O sistema pode utilizar empilhadeiras comuns,\r\ncom pequenas modificações na estrutura de\r\nproteção ao operador.<br><br>\r\nIV. Permite maior velocidade de armazenagem em\r\ncomparação com o porta-palete convencional.<br><br>\r\nÉ correto apenas o que se afirma em<br><br>', 'I', 'II', 'I e III', 'II e IV', 'III e IV', 'C', '', '', 'renato', 'figuras/'),
(69, 'Logística', 'No esquema, busca-se demonstrar', 'as várias fases de um processo de produção.', 'as várias fases de um processo de armazenagem.', 'um processo múltiplo de produção e armazenagem.', 'um processo de automação em logística por meio do WMS.', 'um processo de logística com foco na identificação por código de barra.', 'B', '', '', 'renato', 'figuras/logsim2012fig4.JPG'),
(70, 'Logística', 'O gráfico mostra o perfil do estoque de um produto durante 25 semanas. Sabe-se que o tempo de ressuprimento é de 3 semanas.\r\n<br><br>Com base nesses dados, avalie as afirmações abaixo.<br><br>\r\nI. A demanda semanal do produto é constante.<br><br>\r\nII. O ponto de ressuprimento é de 1 800 unidades.<br><br>\r\nIII. O modelo de gestão de estoque é o Sistema de Revisão Contínua.<br><br>\r\nIV. Os tamanhos dos pedidos f oram de 2 600, 3 200 e 3 400 unidades, tendo sido entregues nas semanas 8,\r\n14 e 21, respectivamente.<br><br>\r\nÉ correto apenas o que se afirma em<br><br>', 'I e III.', 'I e IV.', 'II e III.', 'I, II e IV.', 'II, III e IV.', 'C', '', '', 'renato', 'figuras/logsim2012fig5.JPG'),
(71, 'Logística', 'A empresa XYZ está com elevado custo anual com relação aos estoques de um produto. Com o objetivo de minimizar o\r\ncusto total anual, a empresa decidiu adotar, como regra de decisão para o tamanho do lote, a quantidade econômica\r\nde pedido (Q*) para o produto. <br><br>A demanda trimestral do produto é de 5 000 unidades, comprado de um fornecedor\r\npor R$ 100,00 a unidade. O custo para emitir um pedido ao fornecedor é de R$ 5,00 por pedido e cada unidade do\r\nproduto tem um custo de armazenagem de 5% ao ano. <br><br>A quantidade econômica de pedido é calculada pela fórmula abaixo, em que D é a demanda por unidade de tempo, <br><br>P é o custo de emissão de pedidos por pedido,<br><br>\r\nm é a taxa de custo de armazenagem e c é o custo unitário do item.<br><br>\r\nCom base nessas informações, qual é, em unidades, a quantidade econômica de pedido?<br><br>', '10', '20', '100', '200', '1000', 'D', '', '', 'renato', 'figuras/logsim2012fig6.JPG'),
(72, 'Logística', 'A Internet pode ser usada eficientemente no planejamento\r\ndo fluxo de pedidos ao longo de um canal de\r\nsuprimentos. <br><br>Com relação aos principais integrantes do\r\ncanal de suprimentos, a saber, comprador, fornecedor\r\ne transportador, avalie as afirmações a seguir.<br><br><br><br>\r\nI. Eles podem, por meio da web, facilmente\r\nintercomunicar-se, intercambiar informações em\r\ntempo real e reagir com rapidez às mudanças\r\nimprevistas.<br><br>\r\nII. Eles conseguem compartilhar um banco de dados\r\ncomum, que facilita o rastreamento e a expedição.<br><br>\r\nIII. Eles obtêm, por meio da melhora da coordenação,\r\na redução dos custos dos pedidos e a melhoria dos\r\nserviços aos clientes.<br><br>\r\nÉ correto o que se afirma em<br><br>', 'Apenas I', 'Apenas II', 'I e II', 'II e III', 'I, II e III', 'E', '', '', 'renato', 'figuras/'),
(73, 'Logística', 'O sistema de programação Kanban utiliza o método de\r\ncontrole de estoque de ponto de pedido para determinar\r\nlotes padronizados de produção-compra, funcionando com\r\ncustos muito baixos de planejamento e tempos de reposição\r\nreduzidos. No que refere às características que garantem a\r\neficiência do Kanban como sistema just-in-time, avalie as\r\nafirmações abaixo.<br><br>I. Os modelos no programa mestre de produção são\r\nrepetidos continuamente e comparados com uma\r\nprogramação construída para tirar proveito das\r\neconomias de escala.<br><br>\r\nII. Os tempos de reposição tornam-se altamente\r\nprevisíveis porque são curtos.<br><br>\r\nIII. Os lotes de pedidos são pequenos porque os\r\ncustos de preparação e obtenção são mantidos\r\nbaixos.<br><br>\r\nIV. Um alto nível de cooperação entre fabricante e\r\nfornecedor surge para garantir a obtenção do\r\ndesejado nível do desempenho do produto e\r\nda logística.<br><br><br>\r\nSão corretas as características<br><br>', 'I e II, apenas.', 'I e IV, apenas.', 'II e III, apenas.', 'III e IV, apenas.', 'I, II, III e IV.', 'E', '', '', 'renato', 'figuras/'),
(74, 'Logística', 'A natureza da demanda pode ser altamente diferenciada,\r\ndependendo do modo de operação da empresa.\r\nA demanda independente é gerada a partir de muitos\r\nclientes, enquanto a demanda dependente deriva das\r\nexigências específicas de programas de produção.<br><br>\r\nBALLOU, R. H. Gerenciamento da cadeia de suprimentos, logística empresarial.\r\n5 ed. Porto Alegre: Bookman, 2006, p. 242 (adaptado).<br><br>\r\nConsiderando esse contexto, avalie as seguintes asserções\r\ne a relação proposta entre elas.<br><br>\r\nI. A previsão de necessidades por intermédio da\r\ndemanda dependente resulta em previsões perfeitas.<br><br>\r\nPORQUE<br><br>\r\nII. A demanda do produto final é conhecida\r\nantecipadamente e com exatidão.<br><br>\r\nA respeito dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/'),
(75, 'Logística', 'O setup é uma atividade de preparação da máquina antes\r\nde se iniciar a produção de um produto. Inclui-se, nesse\r\ntempo, o que se chama usualmente de try-out, que é o\r\ntempo necessário para produção das primeiras peças,\r\npara se verificar se o equipamento pode ser liberado para\r\na produção.<br><br>\r\nMARTINS, P. G.; LAUGENI, F. P. Administração da produção.\r\nSão Paulo: Saraiva, 2005 (adaptado).<br><br>\r\nConsiderando esse contexto, avalie as seguintes asserções\r\ne a relação proposta entre elas.<br><br>\r\nI. O tempo de setup ocorre tanto em atividades acíclicas\r\nquanto cíclicas dentro do processo de produção.<br><br>\r\nPORQUE<br><br>\r\nII. Quanto menor o tempo de preparação da máquina,\r\nmenor poderá ser o tamanho do lote produzido,\r\naumentando, assim, a eficiência.<br><br>\r\nA respeito dessas asserções, assinale a opção correta.<br><br>', 'As asserções I e II são proposições verdadeiras, e a II é\r\numa justificativa da I.', 'As asserções I e II são proposições verdadeiras, mas a\r\nII não é uma justificativa da I.', 'A asserção I é uma proposição verdadeira, e a II é uma\r\nproposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma\r\nproposição verdadeira.', 'As asserções I e II são proposições falsas.', 'B', '', '', 'renato', 'figuras/'),
(76, 'Logística', 'Uma empresa está em processo de seleção de novos\r\nfornecedores. <br><br>Além dos elementos tradicionais que\r\ninfluem na seleção de um fornecedor (habilidade técnica,\r\nconfiabilidade, localização, preço, qualidade etc.), o\r\ngerente de logística determinou que os seus futuros\r\nfornecedores atendam aos princípios da sustentabilidade\r\nambiental por meio da diminuição dos impactos\r\nambientais causados pelas atividades da logística, como,\r\npor exemplo, a redução da emissão de CO2 e do consumo\r\nde combustível e o uso de biocombustível.<br><br>\r\nEsses novos requisitos para a seleção dos futuros\r\nfornecedores da empresa estão relacionados com o(a)<br>', 'cross-docking.', 'logística reversa.', 'logística direta.', 'logística verde.', 'tempo de ressuprimento.', 'D', '', '', 'renato', 'figuras/'),
(77, 'Matemática', 'A soma dos números 25  e 40 resulta em:', '45', '65', '85', '35', '40', 'B', '', '', 'renato', 'figuras/'),
(78, 'História', 'O Brasil, em 1500, foi descoberto por:', 'Napoleão', 'Pedro Álvares Cabral', 'Visconde do rio Branco', 'Cristóvão Colombo', 'Epitácio Pessoa', 'B', '', '', 'renato', 'figuras/'),
(79, 'Geografia', 'O mapa se refere a que estado brasileiro?', 'São Paulo', 'Paraná', 'Acre', 'Rio de Janeiro', 'Votorantim', 'C', '', '', 'renato', 'figuras/mapafig01.jpg'),
(80, 'Ética e Cidadania', 'Leia o texto abaixo e assinale a alternativa correta a respeito das asserções.', 'As asserções I e II são proposições verdadeiras, e a II é uma justificativa correta da I.', 'As asserções I e II são proposições verdadeiras, mas a II não é uma justificativa correta da I.', 'A asserção I é uma proposição verdadeira, e a II é uma proposição falsa.', 'A asserção I é uma proposição falsa, e a II é uma proposição verdadeira.', 'As asserções I e II são proposições falsas.', 'A', '', '', 'renato', 'figuras/logq01.JPG'),
(81, 'Matemática e Estatística', ' Uma empresa utiliza o sistema de média móvel trimestral para previsão de compra de uma determinada matéria-prima. Observe as quantidades efetivamente consumidas nos últimos cinco meses. De quantas unidades deverá ser o pedido para o próximo mês? ', '220', '150', '135', '132', '120', 'E', '', '', 'renato', 'figuras/enadesim01.JPG'),
(82, 'Administração', 'A Empresa Consultar foi chamada a opinar sobre a implantação de uma produção Just In Time (JIT) na Fábrica de Pregos e Parafusos Ltda. A justificativa central para a adoção do JIT relaciona-se ao fato de que a Fábrica poderá.', 'reduzir seus custos através de diminuição dos níveis de estoque. ', 'decidir suas compras em cima da hora. ', 'utilizar um sistema de produção on line.', 'aumentar o uso de computadores no controle da distribuição com redução de custos', 'manter estoques elevados em uma determinada hora.', 'A', '', '', 'renato', 'figuras/'),
(83, 'Matemática e Estatística', 'Sabe-se que a capacidade calculada de produção de uma célula é função da utilização real da capacidade instalada e da eficiência de seu uso. Uma célula de trabalho de uma empresa é  formada por cinco máquinas, que são operadas oito horas por dia, durante seis dias na semana. <br><br>Historicamente, a utilização de cada célula tem sido de 50% devido a manutenções periódicas necessárias, sendo que ela é operada com uma eficiência de 110%. Qual a capacidade calculada (semanal) de cada célula? <br>', '108 horas', '120 horas', '132 horas', '240 horas', '528 horas', 'C', '', '', 'renato', 'figuras/'),
(84, 'Logística', 'O JUST IN TIME (JIT) é um método que visa disponibilizar o produto, o componente ou a matéria-prima no local onde será utilizado somente quando necessário. <br><br>Assim, a compra, o transporte e a produção devem ocorrer no momento correto. Com relação ao JIT, é <b>INCORRETO</b> afirmar que: ', 'a qualificação dos fornecedores é fator importante.', 'o meio de transporte utilizado para as entregas é indiferente.', 'o Kanban é um exemplo de ferramenta relacionada ao JIT.', 'é baseado na qualidade e flexibilidade do processo de compras. ', 'visa reduzir os custos de armazenagem.', 'B', '', '', 'renato', 'figuras/'),
(85, 'Matemática', 'A Cia. Goiás Velho S.A., fabricante de conectores, recebeu uma encomenda de 1.200 conjuntos extensão tomada, cuja árvore de estrutura é mostrada na figura. <br><br> \r\n Os números entre parênteses referem-se às quantidades utilizadas na produção de cada conjunto. A Goiás Velho possui em estoque: extensão-tomada = 200; tomada = 100; extensão = 500; fio = 2.000. A nova política de estoques da empresa é a de não manter saldos em estoque, quer em conjuntos, quer em componentes. <br><br>A partir das informações apresentadas, pode-se concluir que a quantidade do componente fio (especificação 2 x 16 AWG) que precisa ser adquirido para atender a encomenda de 1.200 conjuntos extensão-tomada (utilizando todo o estoque existente) é: <br>', '25.600', '21.000', '12.700', '11.000', '10.700', 'E', '', '', 'renato', 'figuras/enadesim02.JPG'),
(86, 'Logística', 'Com base no gráfico de estoque abaixo, pode-se afirmar que o LEAD TIME ou tempo de ressuprimento, em dias, é de: ', '5', '8', '10', '20', '30', 'B', '', '', 'renato', 'figuras/enadesim03.JPG'),
(87, 'Logística', 'O método do período fixo é aquele no qual se verifica, a um período fixo, a situação do estoque e, caso necessário, se providencia sua complementação. As afirmativas a seguir representam vantagens desse sistema de reposição de estoques, EXCETO: ', 'se vários itens são adquiridos de um mesmo fornecedor, é possível efetivar ordens de compras de diversos itens com redução de custos de emissão, custos de transporte, programações dos recebimentos com reduções de custos. ', 'individualiza a frequência de revisão do estoque, pois ela vai depender essencialmente do comportamento da demanda.', 'nesse sistema, o estoque só precisa ser conhecido por ocasião da revisão destinada a determinar a quantidade a ser encomendada, tornando-se aplicáveis, por exemplo, os casos de itens perecíveis em que se programem entregas semanais. ', 'permite concentrar de forma regular as entregas e os recebimentos dos materiais com economias operacionais significativas. ', 'permite programar adequadamente as entregas dos itens aos usuários.', 'B', '', '', 'renato', 'figuras/');
INSERT INTO `cadastro_questoes` (`Codigo`, `Disciplina`, `Questao`, `RespostaA`, `RespostaB`, `RespostaC`, `RespostaD`, `RespostaE`, `Correta`, `Feedback_Positivo`, `Feedback_Negativo`, `Professor_Responsavel`, `Figura`) VALUES
(88, 'Logística', 'A JRQ Brinquedos Eletrônicos tem um consumo anual de 100.000 chips, sempre transportados pelo mesmo meio. O Dr. Quintana, gerente de produção da JRQ, está analisando as opções de compra semestral ou trimestral de chips, representadas nos gráficos a seguir.  O Dr.Quintana deve tomar a sua decisão considerando que a compra:', 'trimestral apresenta maior custo de manutenção de estoque.', 'trimestral resulta em consumo anual menor.', 'semestral apresenta menor investimento em estoques.', 'semestral resulta em estoque zerado duas vezes ao ano, implicando menor risco de falta.', 'semestral resulta em maior custo de transporte. ', 'D', '', '', 'renato', 'figuras/enadesim04.JPG'),
(89, 'Logística', 'A necessidade da armazenagem consiste no fato de as organizações não poderem prever a demanda precisamente, ou seja, de maneira 100% segura. Os custos gastos com armazenagem e manuseio de materiais são justificados e compensados por meio dos custos de transporte e de produção. Baseado nos princípios básicos de armazenagem, dotar a área de armazenagem de sistemas que garantam a integridade física das mercadorias armazenadas, mão-de-obra, segurança das instalações e equipamentos e a saúde financeira da empresa, mantendo as equipes de trabalho devidamente treinadas para eventual emergência tem relação com a: ', 'Segurança ', 'Mecanização ', 'Integração ', 'Otimização de equipamento e mão-de-obra ', 'Verticalização ', 'A', '', '', 'renato', 'figuras/'),
(90, 'Logística', 'A Maçã Verde Produtos Agrícolas Ltda. Está estudando os custos de distribuição de seus produtos. Existem três possibilidades para o transporte das maças produzidas desde a fazenda até o armazém de distribuição da empresa localizado na cidade de Natal. <br><br>A tabela a seguir mostra os  custos dos diferentes tipos de transporte, o número de dias para a entrega por tipo de transporte e o custo de manutenção do estoque em trânsito por sai (principalmente refrigeração). Colocando-se em ordem crescente de custos totais os diversos tipos de transporte, tem-se: <br>', 'Rodoviário, Marítimo e Aéreo. ', 'Rodoviário, Aéreo e Marítimo. ', 'Aéreo, Marítimo e Rodoviário. ', 'Marítimo, Rodoviário e Aéreo. ', 'Marítimo, Aéreo e Rodoviário. ', 'A', '', '', 'renato', 'figuras/enadesim05.JPG'),
(91, 'Logística', 'Podemos dizer sobre o processo de Suply Chain Management (SCM) que: \r\n', 'Sempre terá o Fornecedor na distribuição e seu cliente no recebimento. ', 'Nunca terá o seu Cliente na distribuição e Fornecedor no recebimento. ', 'Sempre terá o seu Cliente na distribuição e Fornecedor no recebimento. ', 'Nunca terá o Fornecedor na distribuição e seu cliente no recebimento. ', 'Sempre terá o seu Cliente na distribuição e Fornecedor na distribuição e no recebimento. ', 'C', '', '', 'renato', 'figuras/'),
(92, 'Logística', 'Podemos dizer sobre o estoque em processo: ', ' É um insumo ou matéria-prima, passando por um ou mais processos de transformação ', 'É aquele que está em fase de transformação, não está definido', 'É aquele pronto para ser entregue ao cliente', 'É aquele que embora circulando, ainda é da empresa ', 'É aquele que está em fase de transformação, mas já está definido', 'B', '', '', 'renato', 'figuras/'),
(93, 'Logística', 'É correto afirmar que é um exemplo de \"estoque em trânsito\". ', 'A devolução de produtos ao fornecedor, da doca de recebimento ', 'A devolução de produtos do cliente, antes do recebimento', ' A distribuição de produtos às filiais ', 'A distribuição de produtos aos cliente', 'A distribuição de produtos aos fornecedores ', 'C', '', '', 'renato', 'figuras/'),
(94, 'Logística', 'Podemos dizer que os processos de suporte:', 'Visam transformar uma fração em outra através de processos químicos \r\n', 'São sempre de natureza física e têm por objetivo desdobrar o petróleo em suas frações básicas ', 'Têm por finalidade principal eliminar as impurezas que, estando presentes nas frações, possam comprometer suas qualidades finais ', 'São aqueles que se destinam a fornecer insumos à operação dos outros anteriormente citados', 'São sempre de natureza abstrata e têm por objetivo desdobrar o petróleo em suas frações básicas ', 'D', '', '', 'renato', 'figuras/'),
(95, 'Logística', 'Podemos dizer que os processos de conversão: ', 'Visam transformar uma fração em outra através de processos químicos ', 'São sempre de natureza física e têm por objetivo desdobrar o petróleo em suas frações básicas ', 'Têm por finalidade principal eliminar as impurezas que, estando presentes nas frações, possam comprometer suas qualidades finais ', 'São aqueles que se destinam a fornecer insumos à operação dos outros anteriormente citados', 'São sempre de natureza abstrata e têm por objetivo desdobrar o petróleo em suas frações básicas', 'A', '', '', 'renato', 'figuras/'),
(96, 'Logística', 'Podemos dizer que os processos de separação:', 'Visam transformar uma fração em outra através de processos químicos ', 'São sempre de natureza física e têm por objetivo desdobrar o petróleo em suas frações básicas', 'Têm por finalidade principal eliminar as impurezas que, estando presentes nas frações, possam comprometer suas qualidades finais ', 'São aqueles que se destinam a fornecer insumos à operação dos outros anteriormente citados ', 'São sempre de natureza abstrata e têm por objetivo desdobrar o petróleo em suas frações básicas ', 'B', '', '', 'renato', 'figuras/'),
(97, 'Logística', 'A Obras Públicas Ltda. está se preparando para a obtenção de uma licença de construção de uma ponte na Região Sudeste. As tarefas que serão executadas são: A,B,C,D,E,F,G,H,I,J,K,L,M. <br><br>\r\nAs precedências e os tempos (entre parênteses) para a execução de todas as tarefas são mostrados na figura a seguir. A Livraria Virtual Ltda. decidiu introduzir a venda de livros através de sua homepage. Para tal, ela precisa dispor de um sistema que possa determinar, com base em seu atual banco de dados, uma segmentação de clientes para a posteriori utilizar esta informação na personalização do acesso à homepage. Que tipo de Sistema poderá ajudar a empresa na segmentação de seus clientes? <br><br>Como a obra tem interesse social, em quantos dias, no máximo, deve ser executada? <br>', '17', '16', '15', '14', '12', 'A', '', '', 'renato', 'figuras/enadesim06.JPG'),
(98, 'Logística', 'Você é consultor e estuda o mercado de esmagamento de soja no Brasil. Os produtos comercializados nesse mercado são farelo de soja e óleo vegetal. As plantações de soja estão espalhadas por todo o interior do país. A margem de lucro dos produtos é muito pequena, e a logística é um custo significativo da operação. O transporte é feito via modal rodoviário e o volume de soja colhida é muito superior ao volume somado de farelo e óleo.   <br><br>Para ter um desempenho sustentável em longo prazo, é necessário que as empresas tenham: <br><br>I. grande volume de esmagamento;<br><br> II. proximidade de centros de plantação de soja; <br><br>III. frota de transporte próprio; <br><br>IV. localização perto de uma grande capital metropolitana.   <br><br>Estão CORRETAS somente as afirmativas: <br>', 'I e III', 'II e III', 'I e II', 'Apenas III', 'I e IV', 'C', '', '', 'renato', 'figuras/'),
(99, 'Logística', 'A Ponto Quente Aparelhos Elétricos S.A. produz aquecedores e ventiladores. As árvores de estrutura de ambos os produtos estão representadas a seguir (os números entre parênteses referem-se à quantidade utilizada na produção). <br><br>Considerando que os eixos utilizados em ambos os casos são os mesmos, quantos eixos devem ser comprados para a produção de 100 ventiladores e 50 aquecedores, se o estoque inicial é de 40 eixos e, ao final da produção, deseja-se ter um estoque de 50 eixos? <br>', '300', '260', '250', '240', '210', 'B', '', '', 'renato', 'figuras/enadesim07.JPG'),
(100, 'Logística', 'A CPV possui duas fábricas que abastecem três depósitos. As fábricas têm um nível máximo de produção baseado nas suas dimensões e nas safras previstas. Os custos em R$/t estão anotados em cada rota (ligação entre as fábricas e depósitos). José de Almeida, estudante de Administração, foi contratado pelo Departamento de Logística com a finalidade de atender a demanda dos depósitos sem exceder a capacidade das fábricas, minimizando o custo total do transporte. <br><br>Em sua decisão ele considerou as seguintes situações: <br><br>I - 1.000 unidades devem ser transportadas da Fábrica 2 para o Depósito 1. A demanda restante deve ser suprida a partir da Fábrica 1;<br><br> II - 2.500 unidades devem ser transportadas da Fábrica 1 para os Depósitos 1 e 2. A demanda restante deve ser suprida a partir da Fábrica 2; <br><br>III - 1.000 unidades devem ser transportadas da Fábrica 2 para o Depósito 2. A demanda restante deve ser suprida a partir da Fábrica 1. <br><br>Apresenta(m) o(s) menor(es) custo(s) apenas a(s) situação(ões): <br>', 'I', 'II', 'III', 'I e III', 'II e III', 'D', '', '', 'renato', 'figuras/enadesim08.JPG'),
(101, 'Logística', 'A Alberto Conservas Ltda. tem de fazer, para os próximos três meses, um plano de produção  de um dos seus produtos (ervilhas). O departamento de marketing da empresa assim estima a demanda do produto: Considere que a empresa deseja manter um nível de produção estável, detém hoje 100.000  unidades de ervilhas em conserva em estoque e deseja, ao final do período, ter um estoque de 150.000 unidades. Qual deve ser o respectivo nível de estoque ao final de cada mês?   \r\n ', '200.000; 300.000 e 200.000. ', '200.000; 200.000 e 200.000.', '180.000; 100.000 e 150.000', '120.000; 280.000 e 150.000', '20.000; 280.000 e 300.000.', 'C', '', '', 'renato', 'figuras/enadesim09.JPG'),
(102, 'Informática', 'No atual cenário empresarial mundial, as empresas buscam cada vez mais aumentar a sua competitividade, seja pela redução de custos, pela melhoria do produto, agregando mais valor ao produto e se diferenciando da concorrência ou se especializando em algum segmento ou nicho de mercado. A competição tem escalas globais, acontecimentos em países distantes podem trazer consequências instantâneas para a indústria local. Nesse contexto, muitas empresas estão optando pelos pacotes ERP (Enterprise Resource Planning ou, numa tradução literal, \"Planejamento dos Recursos da Empresa\"), entendidos, no Brasil, como Sistemas Integrados de Gestão Empresarial, que  controlam e fornecem suporte a todos os processos operacionais, produtivos, administrativos e comerciais da empresa. Sendo assim, qual a importância dos Sistemas ERP no contexto da logística empresarial? ', 'Nenhuma importância', 'Sistemas de ERP nas nuvens podem gerar gastos maiores a longo prazo, pois, em geral, esse tipo de licenciamento exige pagamento periódico, como se fosse uma assinatura. Será que no longo prazo esse pagamento periódico compensará? Esse é um exemplo de questionamento que precisa ser feito no momento da adoção.', 'É importante à empresa analisar as soluções de ERP existentes no mercado e as modalidades de licenciamento oferecidas por cada uma para saber qual opção é mais adequada às suas atividades. Se a empresa não tiver uma equipe de Tecnologia da Informação (TI) capaz de fazer essa análise, pode valer a pena procurar um serviço de consultoria.', 'O tempo de implementação também é um parâmetro importante. Sistemas de ERP não começam a funcionar da noite para o dia, dependendo do tamanho da empresa. Muitas vezes, os provedores das soluções precisam de tempo para adaptar o software ao negócio e, nesse processo, devem avaliar a infraestrutura, considerar os recursos de segurança, fazer testes, treinar pessoal, integrar departamentos, migrar sistemas legados, entre outros.', 'São importantes pois, diminuem custos, tornam a comunicação mais eficiente, ajudam na tomada de decisões, permitem uma apuração mais precisa do que está acontecendo na companhia, enfim. Não é por menos que muitas empresas consideram este tipo de software imprescindível às suas atividades.', 'E', '', '', 'renato', 'figuras/'),
(103, 'Logística', 'Para produtos e materiais que não possuem regulamentação exclusiva para a armazenagem, a organização dos itens depende de vários fatores e decisões feitas pela própria empresa. A figura  representa o arranjo físico de um armazém que é condizente com a estratégia de/para: ', 'colocação alfanumérica, visto que, na área de produtos E, os materiais estão próximos uns aos outros. ', 'frequência de colocação e retirada, onde, na região A, são colocados os materiais de maior utilização. ', 'seleção de colocação pelo fator de densidade, pois reserva áreas vazias assinaladas com a letra E (empty). ', 'colocação rápida, devido à localização das áreas das regiões C e D. ', 'consolidação de cargas, em que a movimentação e a flexibilidade de armazenamento são fatores prioritários. ', 'B', '', '', 'renato', 'figuras/enadesim0a.JPG'),
(104, 'Logística', 'Paletes são estrados que podem ser de madeira, metal, papelão ou plástico, que permitem a formação da carga unitária. As alternativas a seguir mostram vantagens da paletização, EXCETO: ', 'necessidade de investimentos em equipamentos adequados a seu manuseio. ', 'maior densidade de carga no armazenamento.', 'padronização e automação dos sistemas de recebimento e fornecimento dos materiais. ', 'redução dos custos de manuseio e movimentação, além de redução no tempo de transporte e maior rapidez nas operações de carga e descarga.', 'melhoria na utilização dos espaços verticais, aumentando a utilização dos espaços destinados ao armazenamento dos materiais.', 'A', '', '', 'renato', 'figuras/'),
(105, 'Logística', 'Para atender à demanda dos clientes, produtos devem ser distribuídos de maneira otimizada em termos de custo e tempo de atendimento. Muitas empresas optam por sistemas de estoques de múltiplos estágios. Os centros de distribuição são estágios importantes e que têm diversas funções na gestão da cadeia de suprimentos, EXCETO: ', 'possibilitar o uso de diversos modais de transporte.', 'reduzir o número de rotas de transporte. ', 'dispor de pontos para consolidação de cargas, crossdocking e merger-in-transit', 'coordenar o suprimento de matérias-primas com o ritmo de produção. ', 'simplificar os meios de comunicação entre estágios de distribuição.', 'D', '', '', 'renato', 'figuras/'),
(106, 'Logística', 'Um analista de comercialização e logística, ao realizar serviços de apoio ao navio no porto, reconhece que:', 'o Órgão de Gestão de Mão de Obra (OGMO) é responsável por promover o treinamento e o cadastro do trabalhador portuário avulso, cujo registro deve ser feito pelo navio, quando da sua utilização. ', 'arrumadores ou portuários são mão de obra avulsa utilizada para a execução de serviços a bordo', 'a estiva é uma mão de obra avulsa utilizada para os serviços em terra. ', 'as taxas de atracação são cobradas em função do comprimento do navio e do tempo em que ele permanece atracado.', 'para o cálculo do peso das mercadorias movimentadas deve ser feito o somatório dos pesos brutos de todas as mercadorias.', 'D', '', '', 'renato', 'figuras/'),
(107, 'Logística', 'A Tintas Brasil Ltda. está estudando uma forma de nivelar sua produção durante o ano. O Departamento de Marketing fez uma pesquisa de mercado e descobriu que o setor de tintas é altamente sazonal (muitas famílias resolvem pintar suas residências no 4º trimestre, devido ao período de festas). O gráfico abaixo mostra as previsões de vendas para o próximo ano.  De quantos milhares de galões deve ser o nível de produção trimestral da empresa para nivelar sua produção? ', '100', '75', '55', '50', '40', 'C', '', '', 'renato', 'figuras/enadesim0b.JPG'),
(108, 'Informática', 'Considere as afirmações sobre SCM:\r\n<br><br>\r\nI - O Supply Chain Management (SCM) ou Gerenciamento da Cadeia de Suprimentos é uma ferramenta que, usando a Tecnologia da Informação (TI) possibilita à empresa gerenciar a cadeia de suprimentos com maior eficácia e eficiência.\r\n<br><br>II - Nesses tempos modernos em que a exigência de consumo atingiu o limite extremo, o Supply Chain Management permite às empresas alcançarem melhores padrões de competitividade.<br><br>III - O conceito de Supply Chain Management surgiu como uma evolução natural do conceito de Logística. Enquanto a Logística representa uma integração interna de atividades, o Supply Chain Management representa sua integração externa, pois estende a coordenação dos fluxos de materiais e informações aos fornecedores e ao cliente final.<br><br> Estão corretas:<br>', 'Apenas I', 'Apenas II', 'I e II', 'Apenas III', 'I, II e III', 'E', '', '', 'renato', 'figuras/'),
(109, 'Logística', 'Uma das características atuais do processo de globalização é a exigência, cada vez maior, de fluidez de informações e mercadorias, ou, em essência, do próprio capital. Tal exigência tem conduzido os países à reestruturação de seus sistemas de circulação. Nesse sentido, no Estado brasileiro, nos últimos anos:', 'priorizou-se o transporte público urbano, com a ampliação do número de linhas do Metropolitano em todas as capitais dos Estados. ', 'houve uma ampla recuperação da malha ferroviária, com a construção de novos trechos, a exemplo da Transnordestina.', 'privilegiou-se o sistema de cabotagem, valorizando-se o transporte de passageiros pelo território nacional e interligando as áreas costeiras do país. ', 'priorizou-se o transporte hidroviário, voltado à exportação de grãos, conforme atestam as hidrovias Tietê-Paraná e do Rio São Francisco. ', 'intensificou-se a modernização do sistema portuário, incluindo a construção de portos como os de Sepetiba (RJ) e Pecém (CE)', 'E', '', '', 'renato', 'figuras/'),
(110, 'Logística', 'Diante da entrada de uma grande embarcação em uma baía, um analista de comercialização e logística foi questionado sobre aspectos relacionados aos seguros marítimos, respondendo que o(a): ', 'seguro do casco engloba todo o navio, exceto máquinas e acessórios.', 'prêmio é uma participação do segurado num percentual do sinistro, feito pela dedução no pagamento da indenização. ', 'indenização traz lucros ao segurado.', 'não convocação do prático em zona de praticagem obrigatória pode causar a rescisão do seguro.', 'probabilidade de ocorrência de riscos não interfere na base de cálculo dos valores envolvidos. ', 'D', '', '', 'renato', 'figuras/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int(11) NOT NULL,
  `curso` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`codigo`, `curso`) VALUES
(1, 'Logística'),
(2, 'ADS'),
(3, 'Eletr. Automotiva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gabaritos`
--

CREATE TABLE `gabaritos` (
  `Codigo` int(11) NOT NULL,
  `Aluno` int(11) NOT NULL,
  `Prova` varchar(30) NOT NULL,
  `Questao` int(11) NOT NULL,
  `Resposta_Aluno` varchar(3) NOT NULL,
  `Resposta_Correta` varchar(3) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Finalizado` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gabaritos`
--

INSERT INTO `gabaritos` (`Codigo`, `Aluno`, `Prova`, `Questao`, `Resposta_Aluno`, `Resposta_Correta`, `Numero`, `Finalizado`) VALUES
(2736, 13, 'ENADESIM', 81, 'A', 'E', 1, 'Sim'),
(2737, 13, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2738, 13, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2739, 13, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2740, 13, 'ENADESIM', 85, 'D', 'E', 5, 'Sim'),
(2741, 13, 'ENADESIM', 86, 'E', 'B', 6, 'Sim'),
(2742, 13, 'ENADESIM', 87, 'C', 'B', 7, 'Sim'),
(2743, 13, 'ENADESIM', 88, 'C', 'D', 8, 'Sim'),
(2744, 13, 'ENADESIM', 89, 'D', 'A', 9, 'Sim'),
(2745, 13, 'ENADESIM', 90, 'A', 'A', 10, 'Sim'),
(2746, 13, 'ENADESIM', 91, 'A', 'C', 11, 'Sim'),
(2747, 13, 'ENADESIM', 92, 'A', 'B', 12, 'Sim'),
(2748, 13, 'ENADESIM', 93, 'D', 'C', 13, 'Sim'),
(2749, 13, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2750, 13, 'ENADESIM', 95, 'A', 'A', 15, 'Sim'),
(2751, 13, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2752, 13, 'ENADESIM', 97, 'D', 'A', 17, 'Sim'),
(2753, 13, 'ENADESIM', 98, 'C', 'C', 18, 'Sim'),
(2754, 13, 'ENADESIM', 99, 'B', 'B', 19, 'Sim'),
(2755, 13, 'ENADESIM', 100, 'E', 'D', 20, 'Sim'),
(2756, 13, 'ENADESIM', 101, 'D', 'C', 21, 'Sim'),
(2757, 13, 'ENADESIM', 102, 'D', 'E', 22, 'Sim'),
(2758, 13, 'ENADESIM', 103, 'B', 'B', 23, 'Sim'),
(2759, 13, 'ENADESIM', 104, 'A', 'A', 24, 'Sim'),
(2760, 13, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2761, 13, 'ENADESIM', 106, 'D', 'D', 26, 'Sim'),
(2762, 13, 'ENADESIM', 107, 'C', 'C', 27, 'Sim'),
(2763, 13, 'ENADESIM', 108, 'E', 'E', 28, 'Sim'),
(2764, 13, 'ENADESIM', 109, 'E', 'E', 29, 'Sim'),
(2765, 13, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2766, 26, 'ENADESIM', 81, 'E', 'E', 1, 'Sim'),
(2767, 26, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2768, 26, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2769, 26, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2770, 26, 'ENADESIM', 85, 'D', 'E', 5, 'Sim'),
(2771, 26, 'ENADESIM', 86, 'E', 'B', 6, 'Sim'),
(2772, 26, 'ENADESIM', 87, 'C', 'B', 7, 'Sim'),
(2773, 26, 'ENADESIM', 88, 'D', 'D', 8, 'Sim'),
(2774, 26, 'ENADESIM', 89, 'E', 'A', 9, 'Sim'),
(2775, 26, 'ENADESIM', 90, 'D', 'A', 10, 'Sim'),
(2776, 26, 'ENADESIM', 91, 'A', 'C', 11, 'Sim'),
(2777, 26, 'ENADESIM', 92, 'D', 'B', 12, 'Sim'),
(2778, 26, 'ENADESIM', 93, 'C', 'C', 13, 'Sim'),
(2779, 26, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2780, 26, 'ENADESIM', 95, 'A', 'A', 15, 'Sim'),
(2781, 26, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2782, 26, 'ENADESIM', 97, 'E', 'A', 17, 'Sim'),
(2783, 26, 'ENADESIM', 98, 'C', 'C', 18, 'Sim'),
(2784, 26, 'ENADESIM', 99, 'C', 'B', 19, 'Sim'),
(2785, 26, 'ENADESIM', 100, 'D', 'D', 20, 'Sim'),
(2786, 26, 'ENADESIM', 101, 'D', 'C', 21, 'Sim'),
(2787, 26, 'ENADESIM', 102, 'E', 'E', 22, 'Sim'),
(2788, 26, 'ENADESIM', 103, 'A', 'B', 23, 'Sim'),
(2789, 26, 'ENADESIM', 104, 'A', 'A', 24, 'Sim'),
(2790, 26, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2791, 26, 'ENADESIM', 106, 'D', 'D', 26, 'Sim'),
(2792, 26, 'ENADESIM', 107, 'C', 'C', 27, 'Sim'),
(2793, 26, 'ENADESIM', 108, 'E', 'E', 28, 'Sim'),
(2794, 26, 'ENADESIM', 109, 'E', 'E', 29, 'Sim'),
(2795, 26, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2796, 15, 'ENADESIM', 81, 'A', 'E', 1, 'Sim'),
(2797, 15, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2798, 15, 'ENADESIM', 83, 'D', 'C', 3, 'Sim'),
(2799, 15, 'ENADESIM', 84, 'A', 'B', 4, 'Sim'),
(2800, 15, 'ENADESIM', 85, 'D', 'E', 5, 'Sim'),
(2801, 15, 'ENADESIM', 86, 'D', 'B', 6, 'Sim'),
(2802, 15, 'ENADESIM', 87, 'C', 'B', 7, 'Sim'),
(2803, 15, 'ENADESIM', 88, 'D', 'D', 8, 'Sim'),
(2804, 15, 'ENADESIM', 89, 'A', 'A', 9, 'Sim'),
(2805, 15, 'ENADESIM', 90, 'B', 'A', 10, 'Sim'),
(2806, 15, 'ENADESIM', 91, 'E', 'C', 11, 'Sim'),
(2807, 15, 'ENADESIM', 92, 'B', 'B', 12, 'Sim'),
(2808, 15, 'ENADESIM', 93, 'D', 'C', 13, 'Sim'),
(2809, 15, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2810, 15, 'ENADESIM', 95, 'A', 'A', 15, 'Sim'),
(2811, 15, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2812, 15, 'ENADESIM', 97, 'E', 'A', 17, 'Sim'),
(2813, 15, 'ENADESIM', 98, 'B', 'C', 18, 'Sim'),
(2814, 15, 'ENADESIM', 99, 'B', 'B', 19, 'Sim'),
(2815, 15, 'ENADESIM', 100, 'D', 'D', 20, 'Sim'),
(2816, 15, 'ENADESIM', 101, 'D', 'C', 21, 'Sim'),
(2817, 15, 'ENADESIM', 102, 'D', 'E', 22, 'Sim'),
(2818, 15, 'ENADESIM', 103, 'B', 'B', 23, 'Sim'),
(2819, 15, 'ENADESIM', 104, 'A', 'A', 24, 'Sim'),
(2820, 15, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2821, 15, 'ENADESIM', 106, 'D', 'D', 26, 'Sim'),
(2822, 15, 'ENADESIM', 107, 'C', 'C', 27, 'Sim'),
(2823, 15, 'ENADESIM', 108, 'E', 'E', 28, 'Sim'),
(2824, 15, 'ENADESIM', 109, 'E', 'E', 29, 'Sim'),
(2825, 15, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2826, 10, 'ENADESIM', 81, 'E', 'E', 1, 'Sim'),
(2827, 10, 'ENADESIM', 82, 'Z', 'A', 2, 'Sim'),
(2828, 10, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2829, 10, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2830, 10, 'ENADESIM', 85, 'Z', 'E', 5, 'Sim'),
(2831, 10, 'ENADESIM', 86, 'B', 'B', 6, 'Sim'),
(2832, 10, 'ENADESIM', 87, 'D', 'B', 7, 'Sim'),
(2833, 10, 'ENADESIM', 88, 'Z', 'D', 8, 'Sim'),
(2834, 10, 'ENADESIM', 89, 'Z', 'A', 9, 'Sim'),
(2835, 10, 'ENADESIM', 90, 'Z', 'A', 10, 'Sim'),
(2836, 10, 'ENADESIM', 91, 'Z', 'C', 11, 'Sim'),
(2837, 10, 'ENADESIM', 92, 'Z', 'B', 12, 'Sim'),
(2838, 10, 'ENADESIM', 93, 'Z', 'C', 13, 'Sim'),
(2839, 10, 'ENADESIM', 94, 'Z', 'D', 14, 'Sim'),
(2840, 10, 'ENADESIM', 95, 'Z', 'A', 15, 'Sim'),
(2841, 10, 'ENADESIM', 96, 'Z', 'B', 16, 'Sim'),
(2842, 10, 'ENADESIM', 97, 'Z', 'A', 17, 'Sim'),
(2843, 10, 'ENADESIM', 98, 'Z', 'C', 18, 'Sim'),
(2844, 10, 'ENADESIM', 99, 'Z', 'B', 19, 'Sim'),
(2845, 10, 'ENADESIM', 100, 'Z', 'D', 20, 'Sim'),
(2846, 10, 'ENADESIM', 101, 'Z', 'C', 21, 'Sim'),
(2847, 10, 'ENADESIM', 102, 'Z', 'E', 22, 'Sim'),
(2848, 10, 'ENADESIM', 103, 'Z', 'B', 23, 'Sim'),
(2849, 10, 'ENADESIM', 104, 'Z', 'A', 24, 'Sim'),
(2850, 10, 'ENADESIM', 105, 'Z', 'D', 25, 'Sim'),
(2851, 10, 'ENADESIM', 106, 'Z', 'D', 26, 'Sim'),
(2852, 10, 'ENADESIM', 107, 'Z', 'C', 27, 'Sim'),
(2853, 10, 'ENADESIM', 108, 'Z', 'E', 28, 'Sim'),
(2854, 10, 'ENADESIM', 109, 'Z', 'E', 29, 'Sim'),
(2855, 10, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2856, 20, 'ENADESIM', 81, 'E', 'E', 1, 'Sim'),
(2857, 20, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2858, 20, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2859, 20, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2860, 20, 'ENADESIM', 85, 'E', 'E', 5, 'Sim'),
(2861, 20, 'ENADESIM', 86, 'B', 'B', 6, 'Sim'),
(2862, 20, 'ENADESIM', 87, 'B', 'B', 7, 'Sim'),
(2863, 20, 'ENADESIM', 88, 'D', 'D', 8, 'Sim'),
(2864, 20, 'ENADESIM', 89, 'Z', 'A', 9, 'Sim'),
(2865, 20, 'ENADESIM', 90, 'A', 'A', 10, 'Sim'),
(2866, 20, 'ENADESIM', 91, 'A', 'C', 11, 'Sim'),
(2867, 20, 'ENADESIM', 92, 'B', 'B', 12, 'Sim'),
(2868, 20, 'ENADESIM', 93, 'C', 'C', 13, 'Sim'),
(2869, 20, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2870, 20, 'ENADESIM', 95, 'E', 'A', 15, 'Sim'),
(2871, 20, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2872, 20, 'ENADESIM', 97, 'A', 'A', 17, 'Sim'),
(2873, 20, 'ENADESIM', 98, 'C', 'C', 18, 'Sim'),
(2874, 20, 'ENADESIM', 99, 'B', 'B', 19, 'Sim'),
(2875, 20, 'ENADESIM', 100, 'D', 'D', 20, 'Sim'),
(2876, 20, 'ENADESIM', 101, 'C', 'C', 21, 'Sim'),
(2877, 20, 'ENADESIM', 102, 'E', 'E', 22, 'Sim'),
(2878, 20, 'ENADESIM', 103, 'C', 'B', 23, 'Sim'),
(2879, 20, 'ENADESIM', 104, 'B', 'A', 24, 'Sim'),
(2880, 20, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2881, 20, 'ENADESIM', 106, 'C', 'D', 26, 'Sim'),
(2882, 20, 'ENADESIM', 107, 'C', 'C', 27, 'Sim'),
(2883, 20, 'ENADESIM', 108, 'E', 'E', 28, 'Sim'),
(2884, 20, 'ENADESIM', 109, 'D', 'E', 29, 'Sim'),
(2885, 20, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2886, 11, 'ENADESIM', 81, 'E', 'E', 1, 'Sim'),
(2887, 11, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2888, 11, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2889, 11, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2890, 11, 'ENADESIM', 85, 'E', 'E', 5, 'Sim'),
(2891, 11, 'ENADESIM', 86, 'B', 'B', 6, 'Sim'),
(2892, 11, 'ENADESIM', 87, 'B', 'B', 7, 'Sim'),
(2893, 11, 'ENADESIM', 88, 'D', 'D', 8, 'Sim'),
(2894, 11, 'ENADESIM', 89, 'A', 'A', 9, 'Sim'),
(2895, 11, 'ENADESIM', 90, 'A', 'A', 10, 'Sim'),
(2896, 11, 'ENADESIM', 91, 'C', 'C', 11, 'Sim'),
(2897, 11, 'ENADESIM', 92, 'B', 'B', 12, 'Sim'),
(2898, 11, 'ENADESIM', 93, 'C', 'C', 13, 'Sim'),
(2899, 11, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2900, 11, 'ENADESIM', 95, 'D', 'A', 15, 'Sim'),
(2901, 11, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2902, 11, 'ENADESIM', 97, 'E', 'A', 17, 'Sim'),
(2903, 11, 'ENADESIM', 98, 'C', 'C', 18, 'Sim'),
(2904, 11, 'ENADESIM', 99, 'C', 'B', 19, 'Sim'),
(2905, 11, 'ENADESIM', 100, 'D', 'D', 20, 'Sim'),
(2906, 11, 'ENADESIM', 101, 'A', 'C', 21, 'Sim'),
(2907, 11, 'ENADESIM', 102, 'E', 'E', 22, 'Sim'),
(2908, 11, 'ENADESIM', 103, 'B', 'B', 23, 'Sim'),
(2909, 11, 'ENADESIM', 104, 'A', 'A', 24, 'Sim'),
(2910, 11, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2911, 11, 'ENADESIM', 106, 'D', 'D', 26, 'Sim'),
(2912, 11, 'ENADESIM', 107, 'D', 'C', 27, 'Sim'),
(2913, 11, 'ENADESIM', 108, 'E', 'E', 28, 'Sim'),
(2914, 11, 'ENADESIM', 109, 'D', 'E', 29, 'Sim'),
(2915, 11, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2916, 12, 'ENADESIM', 81, 'E', 'E', 1, 'Sim'),
(2917, 12, 'ENADESIM', 82, 'A', 'A', 2, 'Sim'),
(2918, 12, 'ENADESIM', 83, 'C', 'C', 3, 'Sim'),
(2919, 12, 'ENADESIM', 84, 'B', 'B', 4, 'Sim'),
(2920, 12, 'ENADESIM', 85, 'E', 'E', 5, 'Sim'),
(2921, 12, 'ENADESIM', 86, 'B', 'B', 6, 'Sim'),
(2922, 12, 'ENADESIM', 87, 'B', 'B', 7, 'Sim'),
(2923, 12, 'ENADESIM', 88, 'A', 'D', 8, 'Sim'),
(2924, 12, 'ENADESIM', 89, 'A', 'A', 9, 'Sim'),
(2925, 12, 'ENADESIM', 90, 'B', 'A', 10, 'Sim'),
(2926, 12, 'ENADESIM', 91, 'B', 'C', 11, 'Sim'),
(2927, 12, 'ENADESIM', 92, 'B', 'B', 12, 'Sim'),
(2928, 12, 'ENADESIM', 93, 'C', 'C', 13, 'Sim'),
(2929, 12, 'ENADESIM', 94, 'D', 'D', 14, 'Sim'),
(2930, 12, 'ENADESIM', 95, 'D', 'A', 15, 'Sim'),
(2931, 12, 'ENADESIM', 96, 'B', 'B', 16, 'Sim'),
(2932, 12, 'ENADESIM', 97, 'A', 'A', 17, 'Sim'),
(2933, 12, 'ENADESIM', 98, 'B', 'C', 18, 'Sim'),
(2934, 12, 'ENADESIM', 99, 'B', 'B', 19, 'Sim'),
(2935, 12, 'ENADESIM', 100, 'D', 'D', 20, 'Sim'),
(2936, 12, 'ENADESIM', 101, 'C', 'C', 21, 'Sim'),
(2937, 12, 'ENADESIM', 102, 'D', 'E', 22, 'Sim'),
(2938, 12, 'ENADESIM', 103, 'B', 'B', 23, 'Sim'),
(2939, 12, 'ENADESIM', 104, 'A', 'A', 24, 'Sim'),
(2940, 12, 'ENADESIM', 105, 'D', 'D', 25, 'Sim'),
(2941, 12, 'ENADESIM', 106, 'D', 'D', 26, 'Sim'),
(2942, 12, 'ENADESIM', 107, 'B', 'C', 27, 'Sim'),
(2943, 12, 'ENADESIM', 108, 'D', 'E', 28, 'Sim'),
(2944, 12, 'ENADESIM', 109, 'A', 'E', 29, 'Sim'),
(2945, 12, 'ENADESIM', 110, 'D', 'D', 30, 'Sim'),
(2946, 50, 'ENADE2018', 41, 'C', 'D', 1, 'Nao'),
(2947, 50, 'ENADE2018', 42, 'Z', 'E', 2, 'Nao'),
(2948, 50, 'ENADE2018', 43, 'Z', 'D', 3, 'Nao'),
(2949, 50, 'ENADE2018', 44, 'Z', 'E', 4, 'Nao'),
(2950, 50, 'ENADE2018', 45, 'Z', 'C', 5, 'Nao'),
(2951, 50, 'ENADE2018', 46, 'Z', 'A', 6, 'Nao'),
(2952, 50, 'ENADE2018', 47, 'Z', 'B', 7, 'Nao'),
(2953, 50, 'ENADE2018', 48, 'Z', 'D', 8, 'Nao'),
(2954, 50, 'ENADE2018', 49, 'Z', 'E', 9, 'Nao'),
(2955, 50, 'ENADE2018', 50, 'Z', 'A', 10, 'Nao'),
(2956, 50, 'ENADE2018', 51, 'Z', 'B', 11, 'Nao'),
(2957, 50, 'ENADE2018', 52, 'Z', 'C', 12, 'Nao'),
(2958, 50, 'ENADE2018', 53, 'Z', 'D', 13, 'Nao'),
(2959, 50, 'ENADE2018', 54, 'Z', 'E', 14, 'Nao'),
(2960, 50, 'ENADE2018', 55, 'Z', 'A', 15, 'Nao'),
(2961, 50, 'ENADE2018', 56, 'Z', 'B', 16, 'Nao'),
(2962, 50, 'ENADE2018', 57, 'Z', 'A', 17, 'Nao'),
(2963, 50, 'ENADE2018', 58, 'Z', 'D', 18, 'Nao'),
(2964, 50, 'ENADE2018', 59, 'Z', 'B', 19, 'Nao'),
(2965, 50, 'ENADE2018', 60, 'Z', 'A', 20, 'Nao'),
(2966, 50, 'ENADE2018', 61, 'Z', 'E', 21, 'Nao'),
(2967, 50, 'ENADE2018', 62, 'Z', 'A', 22, 'Nao'),
(2968, 50, 'ENADE2018', 63, 'Z', 'E', 23, 'Nao'),
(2969, 50, 'ENADE2018', 65, 'Z', 'C', 24, 'Nao'),
(2970, 50, 'ENADE2018', 66, 'Z', 'E', 25, 'Nao'),
(2971, 50, 'ENADE2018', 67, 'Z', 'C', 26, 'Nao'),
(2972, 50, 'ENADE2018', 68, 'Z', 'C', 27, 'Nao'),
(2973, 50, 'ENADE2018', 69, 'Z', 'B', 28, 'Nao'),
(2974, 50, 'ENADE2018', 70, 'Z', 'C', 29, 'Nao'),
(2975, 50, 'ENADE2018', 71, 'Z', 'D', 30, 'Nao'),
(2976, 50, 'ENADE2018', 72, 'Z', 'E', 31, 'Nao'),
(2977, 50, 'ENADE2018', 73, 'Z', 'E', 32, 'Nao'),
(2978, 50, 'ENADE2018', 74, 'Z', 'A', 33, 'Nao'),
(2979, 50, 'ENADE2018', 75, 'Z', 'B', 34, 'Nao'),
(2980, 50, 'ENADE2018', 76, 'Z', 'D', 35, 'Nao'),
(3011, 8, 'TUTORIAL', 79, 'C', 'C', 1, 'Sim'),
(3012, 8, 'TUTORIAL', 78, 'D', 'B', 2, 'Sim'),
(3013, 8, 'TUTORIAL', 77, 'C', 'B', 3, 'Sim'),
(3014, 5, 'ENADESIM', 81, 'Z', 'E', 1, 'Nao'),
(3015, 5, 'ENADESIM', 82, 'Z', 'A', 2, 'Nao'),
(3016, 5, 'ENADESIM', 83, 'Z', 'C', 3, 'Nao'),
(3017, 5, 'ENADESIM', 84, 'Z', 'B', 4, 'Nao'),
(3018, 5, 'ENADESIM', 85, 'Z', 'E', 5, 'Nao'),
(3019, 5, 'ENADESIM', 86, 'Z', 'B', 6, 'Nao'),
(3020, 5, 'ENADESIM', 87, 'Z', 'B', 7, 'Nao'),
(3021, 5, 'ENADESIM', 88, 'Z', 'D', 8, 'Nao'),
(3022, 5, 'ENADESIM', 89, 'Z', 'A', 9, 'Nao'),
(3023, 5, 'ENADESIM', 90, 'Z', 'A', 10, 'Nao'),
(3024, 5, 'ENADESIM', 91, 'Z', 'C', 11, 'Nao'),
(3025, 5, 'ENADESIM', 92, 'Z', 'B', 12, 'Nao'),
(3026, 5, 'ENADESIM', 93, 'Z', 'C', 13, 'Nao'),
(3027, 5, 'ENADESIM', 94, 'Z', 'D', 14, 'Nao'),
(3028, 5, 'ENADESIM', 95, 'Z', 'A', 15, 'Nao'),
(3029, 5, 'ENADESIM', 96, 'Z', 'B', 16, 'Nao'),
(3030, 5, 'ENADESIM', 97, 'Z', 'A', 17, 'Nao'),
(3031, 5, 'ENADESIM', 98, 'Z', 'C', 18, 'Nao'),
(3032, 5, 'ENADESIM', 99, 'Z', 'B', 19, 'Nao'),
(3033, 5, 'ENADESIM', 100, 'Z', 'D', 20, 'Nao'),
(3034, 5, 'ENADESIM', 101, 'Z', 'C', 21, 'Nao'),
(3035, 5, 'ENADESIM', 102, 'Z', 'E', 22, 'Nao'),
(3036, 5, 'ENADESIM', 103, 'Z', 'B', 23, 'Nao'),
(3037, 5, 'ENADESIM', 104, 'Z', 'A', 24, 'Nao'),
(3038, 5, 'ENADESIM', 105, 'Z', 'D', 25, 'Nao'),
(3039, 5, 'ENADESIM', 106, 'Z', 'D', 26, 'Nao'),
(3040, 5, 'ENADESIM', 107, 'Z', 'C', 27, 'Nao'),
(3041, 5, 'ENADESIM', 108, 'Z', 'E', 28, 'Nao'),
(3042, 5, 'ENADESIM', 109, 'Z', 'E', 29, 'Nao'),
(3043, 5, 'ENADESIM', 110, 'Z', 'D', 30, 'Nao'),
(3044, 5, 'TUTORIAL', 79, 'C', 'C', 1, 'Sim'),
(3045, 5, 'TUTORIAL', 78, 'B', 'B', 2, 'Sim'),
(3046, 5, 'TUTORIAL', 77, 'C', 'B', 3, 'Sim'),
(3047, 26, 'ENADE2018', 41, 'D', 'D', 1, 'Sim'),
(3048, 26, 'ENADE2018', 42, 'C', 'E', 2, 'Sim'),
(3049, 26, 'ENADE2018', 43, 'C', 'D', 3, 'Sim'),
(3050, 26, 'ENADE2018', 44, 'D', 'E', 4, 'Sim'),
(3051, 26, 'ENADE2018', 45, 'B', 'C', 5, 'Sim'),
(3052, 26, 'ENADE2018', 46, 'D', 'A', 6, 'Sim'),
(3053, 26, 'ENADE2018', 47, 'B', 'B', 7, 'Sim'),
(3054, 26, 'ENADE2018', 48, 'D', 'D', 8, 'Sim'),
(3055, 26, 'ENADE2018', 49, 'E', 'E', 9, 'Sim'),
(3056, 26, 'ENADE2018', 50, 'A', 'A', 10, 'Sim'),
(3057, 26, 'ENADE2018', 51, 'A', 'B', 11, 'Sim'),
(3058, 26, 'ENADE2018', 52, 'C', 'C', 12, 'Sim'),
(3059, 26, 'ENADE2018', 53, 'B', 'D', 13, 'Sim'),
(3060, 26, 'ENADE2018', 54, 'E', 'E', 14, 'Sim'),
(3061, 26, 'ENADE2018', 55, 'B', 'A', 15, 'Sim'),
(3062, 26, 'ENADE2018', 56, 'B', 'B', 16, 'Sim'),
(3063, 26, 'ENADE2018', 57, 'A', 'A', 17, 'Sim'),
(3064, 26, 'ENADE2018', 58, 'D', 'D', 18, 'Sim'),
(3065, 26, 'ENADE2018', 59, 'C', 'B', 19, 'Sim'),
(3066, 26, 'ENADE2018', 60, 'A', 'A', 20, 'Sim'),
(3067, 26, 'ENADE2018', 61, 'E', 'E', 21, 'Sim'),
(3068, 26, 'ENADE2018', 62, 'A', 'A', 22, 'Sim'),
(3069, 26, 'ENADE2018', 63, 'C', 'E', 23, 'Sim'),
(3070, 26, 'ENADE2018', 65, 'C', 'C', 24, 'Sim'),
(3071, 26, 'ENADE2018', 66, 'B', 'E', 25, 'Sim'),
(3072, 26, 'ENADE2018', 67, 'A', 'C', 26, 'Sim'),
(3073, 26, 'ENADE2018', 68, 'D', 'C', 27, 'Sim'),
(3074, 26, 'ENADE2018', 69, 'B', 'B', 28, 'Sim'),
(3075, 26, 'ENADE2018', 70, 'B', 'C', 29, 'Sim'),
(3076, 26, 'ENADE2018', 71, 'A', 'D', 30, 'Sim'),
(3077, 26, 'ENADE2018', 72, 'E', 'E', 31, 'Sim'),
(3078, 26, 'ENADE2018', 73, 'E', 'E', 32, 'Sim'),
(3079, 26, 'ENADE2018', 74, 'A', 'A', 33, 'Sim'),
(3080, 26, 'ENADE2018', 75, 'A', 'B', 34, 'Sim'),
(3081, 26, 'ENADE2018', 76, 'D', 'D', 35, 'Sim'),
(3082, 12, 'ENADE2018', 41, 'Z', 'D', 1, 'Sim'),
(3083, 12, 'ENADE2018', 42, 'Z', 'E', 2, 'Sim'),
(3084, 12, 'ENADE2018', 43, 'Z', 'D', 3, 'Sim'),
(3085, 12, 'ENADE2018', 44, 'Z', 'E', 4, 'Sim'),
(3086, 12, 'ENADE2018', 45, 'Z', 'C', 5, 'Sim'),
(3087, 12, 'ENADE2018', 46, 'Z', 'A', 6, 'Sim'),
(3088, 12, 'ENADE2018', 47, 'Z', 'B', 7, 'Sim'),
(3089, 12, 'ENADE2018', 48, 'Z', 'D', 8, 'Sim'),
(3090, 12, 'ENADE2018', 49, 'Z', 'E', 9, 'Sim'),
(3091, 12, 'ENADE2018', 50, 'Z', 'A', 10, 'Sim'),
(3092, 12, 'ENADE2018', 51, 'Z', 'B', 11, 'Sim'),
(3093, 12, 'ENADE2018', 52, 'Z', 'C', 12, 'Sim'),
(3094, 12, 'ENADE2018', 53, 'Z', 'D', 13, 'Sim'),
(3095, 12, 'ENADE2018', 54, 'Z', 'E', 14, 'Sim'),
(3096, 12, 'ENADE2018', 55, 'Z', 'A', 15, 'Sim'),
(3097, 12, 'ENADE2018', 56, 'Z', 'B', 16, 'Sim'),
(3098, 12, 'ENADE2018', 57, 'Z', 'A', 17, 'Sim'),
(3099, 12, 'ENADE2018', 58, 'Z', 'D', 18, 'Sim'),
(3100, 12, 'ENADE2018', 59, 'Z', 'B', 19, 'Sim'),
(3101, 12, 'ENADE2018', 60, 'Z', 'A', 20, 'Sim'),
(3102, 12, 'ENADE2018', 61, 'Z', 'E', 21, 'Sim'),
(3103, 12, 'ENADE2018', 62, 'Z', 'A', 22, 'Sim'),
(3104, 12, 'ENADE2018', 63, 'Z', 'E', 23, 'Sim'),
(3105, 12, 'ENADE2018', 65, 'Z', 'C', 24, 'Sim'),
(3106, 12, 'ENADE2018', 66, 'Z', 'E', 25, 'Sim'),
(3107, 12, 'ENADE2018', 67, 'Z', 'C', 26, 'Sim'),
(3108, 12, 'ENADE2018', 68, 'Z', 'C', 27, 'Sim'),
(3109, 12, 'ENADE2018', 69, 'Z', 'B', 28, 'Sim'),
(3110, 12, 'ENADE2018', 70, 'Z', 'C', 29, 'Sim'),
(3111, 12, 'ENADE2018', 71, 'Z', 'D', 30, 'Sim'),
(3112, 12, 'ENADE2018', 72, 'Z', 'E', 31, 'Sim'),
(3113, 12, 'ENADE2018', 73, 'Z', 'E', 32, 'Sim'),
(3114, 12, 'ENADE2018', 74, 'Z', 'A', 33, 'Sim'),
(3115, 12, 'ENADE2018', 75, 'Z', 'B', 34, 'Sim'),
(3116, 12, 'ENADE2018', 76, 'Z', 'D', 35, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provas`
--

CREATE TABLE `provas` (
  `Codigo` int(11) NOT NULL,
  `Codigo_Aluno` int(11) NOT NULL,
  `Codigo_ProvaAluno` int(11) NOT NULL,
  `Gabarito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `provas_realizadas`
--

CREATE TABLE `provas_realizadas` (
  `Codigo` int(11) NOT NULL,
  `Aluno` int(11) NOT NULL,
  `Prova` int(11) NOT NULL,
  `Nota` double NOT NULL,
  `Data_Realizacao` varchar(10) NOT NULL,
  `Finalizada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_questoes`
--

CREATE TABLE `tabela_questoes` (
  `Codigo` int(11) NOT NULL,
  `Codigo_Prova` varchar(30) NOT NULL,
  `Questao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tabela_questoes`
--

INSERT INTO `tabela_questoes` (`Codigo`, `Codigo_Prova`, `Questao`) VALUES
(42, 'ENADE2018', 41),
(43, 'ENADE2018', 42),
(44, 'ENADE2018', 43),
(45, 'ENADE2018', 44),
(46, 'ENADE2018', 45),
(47, 'ENADE2018', 46),
(48, 'ENADE2018', 47),
(49, 'ENADE2018', 48),
(50, 'ENADE2018', 49),
(51, 'ENADE2018', 50),
(52, 'ENADE2018', 51),
(53, 'ENADE2018', 52),
(54, 'ENADE2018', 53),
(55, 'ENADE2018', 54),
(56, 'ENADE2018', 55),
(57, 'ENADE2018', 56),
(58, 'ENADE2018', 57),
(59, 'ENADE2018', 58),
(60, 'ENADE2018', 59),
(61, 'ENADE2018', 60),
(62, 'ENADE2018', 61),
(63, 'ENADE2018', 62),
(64, 'ENADE2018', 63),
(65, 'ENADE2018', 65),
(66, 'ENADE2018', 66),
(67, 'ENADE2018', 67),
(68, 'ENADE2018', 68),
(69, 'ENADE2018', 69),
(70, 'ENADE2018', 70),
(71, 'ENADE2018', 71),
(72, 'ENADE2018', 72),
(73, 'ENADE2018', 73),
(74, 'ENADE2018', 74),
(75, 'ENADE2018', 75),
(76, 'ENADE2018', 76),
(77, 'TUTORIAL', 79),
(78, 'TUTORIAL', 78),
(79, 'TUTORIAL', 77),
(81, 'ENADESIM', 81),
(82, 'ENADESIM', 82),
(83, 'ENADESIM', 83),
(84, 'ENADESIM', 84),
(85, 'ENADESIM', 85),
(86, 'ENADESIM', 86),
(87, 'ENADESIM', 87),
(88, 'ENADESIM', 88),
(89, 'ENADESIM', 89),
(90, 'ENADESIM', 90),
(91, 'ENADESIM', 91),
(92, 'ENADESIM', 92),
(93, 'ENADESIM', 93),
(94, 'ENADESIM', 94),
(95, 'ENADESIM', 95),
(96, 'ENADESIM', 96),
(97, 'ENADESIM', 97),
(98, 'ENADESIM', 98),
(99, 'ENADESIM', 99),
(100, 'ENADESIM', 100),
(101, 'ENADESIM', 101),
(102, 'ENADESIM', 102),
(103, 'ENADESIM', 103),
(104, 'ENADESIM', 104),
(105, 'ENADESIM', 105),
(106, 'ENADESIM', 106),
(107, 'ENADESIM', 107),
(108, 'ENADESIM', 108),
(109, 'ENADESIM', 109),
(110, 'ENADESIM', 110);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro_alunos`
--
ALTER TABLE `cadastro_alunos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `cadastro_professor`
--
ALTER TABLE `cadastro_professor`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `cadastro_provas`
--
ALTER TABLE `cadastro_provas`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `cadastro_questoes`
--
ALTER TABLE `cadastro_questoes`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `gabaritos`
--
ALTER TABLE `gabaritos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `provas_realizadas`
--
ALTER TABLE `provas_realizadas`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `tabela_questoes`
--
ALTER TABLE `tabela_questoes`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastro_alunos`
--
ALTER TABLE `cadastro_alunos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cadastro_professor`
--
ALTER TABLE `cadastro_professor`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cadastro_provas`
--
ALTER TABLE `cadastro_provas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cadastro_questoes`
--
ALTER TABLE `cadastro_questoes`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gabaritos`
--
ALTER TABLE `gabaritos`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3117;

--
-- AUTO_INCREMENT for table `provas`
--
ALTER TABLE `provas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provas_realizadas`
--
ALTER TABLE `provas_realizadas`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabela_questoes`
--
ALTER TABLE `tabela_questoes`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
