<?php

  // Página principal (index.php)
  
  // Ativa o bloco que conecta ao banco de dados
  require_once 'conecta.php';
  include 'cabecalho.php';
?>


  <!-- end header -->
  <section id="featured" class="bg">
  <!-- start slider -->

      
  <!-- start slider -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        

<!-- Slider -->
<div id="main-slider" class="main-slider flexslider">
    <ul class="slides">
        <li>
            <img src="img/slides/flexslider/1.jpg" alt="" />
            <div class="flex-caption">
                <?php if ($nivel == "Professor") { // Verifica se o usuário é professor ?>
                    <h3>Cadastre sua prova</h3>
                    <p>Use o sistema de cadastro para gerar seu simulado</p>
                    <a href="cadprova.php" class="btn btn-theme">Cadastrar</a>
                <?php } else { // Caso contrário, o conteúdo é para aluno/visitante ?>
                    <h3>Realize seu simulado</h3> 
                    <p>Com o nosso sistema de simulados online o resultado sai na hora.</p> 
                    <a href="realiza.php" class="btn btn-theme">Começar</a>
                <?php } ?>
            </div>
        </li>

        <li>
            <img src="img/slides/flexslider/2.jpg" alt="" />
            <div class="flex-caption">
                <?php if ($nivel == "Professor") {  ?>
                    <h3>Cadastre seu aluno</h3>
                    <p>É necessário o cadastro dos alunos para a realização dos simulados</p>
                    <a href="cadAluno.php" class="btn btn-theme">Cadastrar Aluno</a>
                <?php } else {  ?>
                    <h3>Aumente suas chances</h3> 
                    <p>Solicite ao professor o código da prova e teste seus conhecimentos.</p> 
                    <a href="realiza.php" class="btn btn-theme">Começar</a>
                <?php } ?>
            </div>
        </li>

        <li>
            <img src="img/slides/flexslider/3.jpg" alt="" />
            <div class="flex-caption">
                <?php if ($nivel == "Professor") {  ?>
                    <h3>Não esqueça!</h3>
                    <p>Forneça o código da prova para seus alunos que irão realizar o simulado</p>
                   
                <?php } else {  ?>
                    <h3>Faça onde Quiser</h3> 
                    <p>E correção é na mesma hora, sem esperas.</p> 
                    <a href="veprova.php" class="btn btn-theme">Começar</a>
                <?php } ?>
            </div>
        </li>
    </ul>
</div>
<!-- end slider -->
      </div>
    </div>
  </div>  

<section class="callaction">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cta-text">
                    <?php if ($nivel == "Professor") { // Mostra esta seção apenas se o usuário for um professor ?>
                        <h2>Professor, inclua a sua prova para a realização dos testes</h2>
                        <p><h3>Não esqueça de fornecer o código para seus alunos</h3></p>
                        <a href="cadprova.php" class="btn btn-theme btn-lg">Cadastrar Prova <i class="fa fa-angle-right"></i></a>
                    <?php } else { // Mostra a seção original se o usuário não for professor ?>
                        <h2>Faça agora seu <span>simulado</span> on-line</h2>
                        <p><h3>Solicite ao professor o código da prova</h3></p>
                        <?php if ($nivel == "Visitante") { // Mostra uma mensagem para visitantes ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cta-btn">
                    <?php if ($nivel == "Visitante") { // Mostra o botão de login apenas para visitantes ?>
                        <a href="login.php" class="btn btn-theme btn-lg"> Login <i class="fa fa-angle-right"></i></a>
                    <?php } ?>
                </div>
            </div>  
        </div>
        
        <div class="row">
            <div class="cta-text">
                <?php if ($nivel == "Visitante") { // Mostra a mensagem de cadastro apenas para visitantes ?>
                    <h3>Ainda não tem um Login? Cadastre-se agora.</h3>
                    <div class="cta-btn">
                        <a href="verifica.php" class="btn btn-theme btn-lg"> Cadastre-se <i class="fa fa-angle-right"></i></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>


  
  <section id="content">
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center">
          <h2>Nós utilizamos a mais <span class="highlight">moderna</span> infraestrutura & tecnologia</h2>          
          <p>Construído para faciliar a tarefa de realização e correção de provas para alunos e professores, o sistema permite a rápida verificação dos erros e resultados.</p>
        </div>
      </div>    
    </div>
    </div>
    
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="box">
              <div class="aligncenter">                
                <div class="icon">
                <i class="fa fa-desktop fa-5x"></i>
                </div>
                <h4>Responsivo</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="box">
              <div class="aligncenter">                
                <div class="icon">
                <i class="fa fa-file-code-o fa-5x"></i>
                </div>
                <h4>Disponível On-Line</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="box">
              <div class="aligncenter">                
                <div class="icon">
                <i class="fa fa-paper-plane-o fa-5x"></i>
                </div>
                <h4>Rápido</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="box">
              <div class="aligncenter">                
                <div class="icon">
                <i class="fa fa-cubes fa-5x"></i>
                </div>
                <h4>Interativo</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <!-- divider -->
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="solidline">
        </div>
      </div>
    </div>
    </div>
    <!-- end divider -->
    
    <div class="container">
    <div style = "text-align: justify;">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-sm-6 col-lg-6">
            <h3><span class="highlight">Sobre a FATEC Itu</span></h3>
            <h4><p><strong>Missão, Visão e Valores da Fatec Itu:</p></h4>
              <p><span class="highlight">Missão:</span></strong> Oferecer educação superior profissional tecnológica de qualidade, através da formação de tecnólogos competentes, socialmente responsáveis, éticos e capazes de promover a ampliação e reprodução dos conhecimentos tecnológicos por meio de ações produtivas que privilegiem as demandas da sociedade em prol de uma melhoria de qualidade de vide da sociedade brasileira.</p>
              <p><strong><span class="highlight">Visão: </span></strong>Ser uma instituição de excelência na educação superior tecnológica, reconhecida por prestar serviços de qualidade, relevância e ética, priorizando a sustentabilidade no meio onde está inserida e a inclusão social, sendo agente de desenvolvimento e transformação da sociedade.</p>
              <p><strong><span class="highlight">Visão: </span></strong>Excelência e comprometimento com a educação superior tecnológica de qualidade; desenvolvimento de uma consciência crítica; Inovação e criatividade precedidas pela ética, que levam a construção e socialização do conhecimento e a consequente transformação do meio onde está inserida.</p>
              <p>São os princípios que moldam a Fatec Itu e orientam nossas ações diárias em direção a uma educação superior tecnológica de excelência, com impacto real na sociedade.</p>
            </p>
          </div>
     
          <div class="col-sm-6 col-lg-6">
            <h4>Estatísticas</h4>
            <div class="progress">
              <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
              90% Alunos no mercado de trabalho
              </div>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
              70% Alunos realizaram estágio
              </div>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 98%">
              98% Consideram a melhor Faculdade
              </div>
            </div>
            <div class="progress">
              <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
              95% Formandos satisfeitos
              </div>
            </div>
                                                <div class="progress">
              <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
              90% Consideram a melhor FATEC
              </div>
            </div>
          </div>
              
        </div>
      </div>
    </div>
    </div>
    
    <!-- divider -->
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="blankline">
        </div>
      </div>
    </div>
    </div>
    <!-- end divider -->
    
  <!-- Parallax e Grip Destaivados para implementação de conteúdo 

  <div id="parallax1" class="parallax text-light text-center marginbot50" data-stellar-background-ratio="0.5">  
           <div class="container">
        <div class="row appear stats">
          <div class="col-xs-6 col-sm-3 col-md-3">
            <div class="align-center color-white txt-shadow">
              <div class="icon">
                <i class="fa fa-clock-o fa-5x"></i>
              </div>
            <strong id="counter-coffee" class="number">10758</strong><br />
            <span class="text">Alunos</span>
            </div>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3">
            <div class="align-center color-white txt-shadow">
              <div class="icon">
                <i class="fa fa-music fa-5x"></i>
              </div>
            <strong id="counter-music" class="number">250</strong><br />
            <span class="text">Professores</span>
            </div>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3">
            <div class="align-center color-white txt-shadow">
              <div class="icon">
                <i class="fa fa-coffee fa-5x"></i>
              </div>
            <strong id="counter-clock" class="number">30</strong><br />
            <span class="text">Anos</span>
            </div>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3">
            <div class="align-center color-white txt-shadow">
              <div class="icon">
                <i class="fa fa-trophy fa-5x"></i>
              </div>
            <strong id="counter-heart" class="number">378</strong><br />
            <span class="text">Prêmios</span>
            </div>
          </div>
        </div>
            </div>
  </div>   
  
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-sm-6 col-md-6">
          <h4>Testemunhos</h4>
            <div class="testimonialslide clearfix flexslider">
              <ul class="slides">
                <li><blockquote>
                Estudar na FATEC me ajudou a ingressar no mercado de trabalho e abriu inúmeras portas para meu futuro.
                  </blockquote>
                  <h4>Daniel Dan <span>&#8213; Analista de Sistemas</span></h4> 
                </li>
                <li><blockquote>
                Depois de me formar na FATEC, só coisas boas aconteceram: Fui promovido e consegui novas oportunidades! Obrigado FATEC!
                  </blockquote>
                  <h4>Mark Wellbeck <span>&#8213; CEO Logística </span></h4>
                </li>  
              </ul>
            </div>          
          </div>  
          <div class="col-sm-6 col-lg-6">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#one" data-toggle="tab"><i class="icon-briefcase"></i> ADS</a></li>
              <li><a href="#two" data-toggle="tab">Logística</a></li>
              <li><a href="#three" data-toggle="tab">EA</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="one">
                <p><img src="img/dummy1.jpg" class="pull-left" alt="" />
                  <strong>Augue iriure</strong> dolorum per ex, ne iisque ornatus veritus duo. Ex nobis integre lucilius sit, pri ea falli ludus appareat. Eum quodsi fuisset id, nostro patrioque qui id. Nominati eloquentiam in mea.
                </p>
                <p>
                   No eum sanctus vituperata reformidans, dicant abhorreant ut pro. Duo id enim iisque praesent, amet intellegat per et, solet referrentur eum et.
                </p>
              </div>
              <div class="tab-pane" id="two">
                <p><img src="img/dummy1.jpg" class="pull-right" alt="" />
                   Tale dolor mea ex, te enim assum suscipit cum, vix aliquid omittantur in. Duo eu cibo dolorum menandri, nam sumo dicit admodum ei. Ne mazim commune honestatis cum, mentitum phaedrum sit et.
                </p>
                <p>Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu.</p>
              </div>
              <div class="tab-pane" id="three">
                <p>Lorem ipsum dolor sit amet, vel laoreet pertinacia at, nam ea ornatus ocurreret gubergren. Per facete graecis eu. </p>
                <p>
                   Cu cum commodo regione definiebas. Cum ea eros laboramus, audire deseruisse his at, munere aeterno ut quo. Et ius doming causae philosophia, vitae bonorum intellegat usu cu.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>  
    

    <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="solidline">
        </div>
      </div>
    </div>
    </div>
 
  -->
        
<!-- clients -->
    <div class="container">
        <div class="justify-content-center d-flex">
            <div class="col-xs-6 col-md-2 d-flex justify-content-center align-items-center client">
                <img alt="logo" src="img/clients/logo4.png" class="img-responsive img-hover" />
            </div>                  
            <div class="col-xs-6 col-md-2 d-flex justify-content-center align-items-center client">
                <img alt="logo" src="img/clients/logo5.png" class="img-responsive img-hover" />
            </div>                  
            <div class="col-xs-6 col-md-2 d-flex justify-content-center align-items-center client">
                <img alt="logo" src="img/clients/logo6.png" class="img-responsive img-hover" />
            </div>  
        </div>
    </div>


  </section>
  
<?php
        include 'footer.php';
?>