<?php
    session_start();
    
    $curtoID = 1;
    $longoID = 2;

    $curtoUrl = "?curto=true";
    $longoUrl = "?longo=true";

    $connect = mysqli_connect('localhost','root','', 'vigono');
    if ($connect->connect_error) {
        die("Connection failed: " 
            . $connect->connect_error);
    }
    if(isset($_SESSION['sessaoId'])){
        $logado = true;
        $loginId = $_SESSION['sessaoId'];
    }else{
        $logado = false;
    }

    function assinarPlano($idPlano){
        global $loginId, $connect;

        $sqlquery = "UPDATE `cliente` SET `plano_idPlano` = $idPlano WHERE idCliente = '$loginId'";
        echo "<script language='javascript' type='text/javascript'>
            alert('Plano assinado')</script>";
        if (!$connect->query($sqlquery) == true) {
            echo "Error: " . $sqlquery . "<br>" . $connect->error;
        }
    }
    if(isset($_GET['curto'])) {
        assinarPlano($curtoID);
    }elseif(isset($_GET['longo'])) {
        assinarPlano($longoID);
    }
?>


<html lang="pt">
<head>
    <title>Planos</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/75e8e357fd.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="imagex/png" href="../imgs/Logos/Logo1.ico">
</head>
<body>
    
    <header id="header" class="img">
        <div style="display: flex;">
            <a class="logo img" href="index.php"></a>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="quemSomos.html"><i class="fas fa-users"></i>Quem Somos</a></li>
                <li><a href="carros.php"><i class="fas fa-car"></i>Carros</a></li>
                <li><a href="planos.php"><i class="fas fa-map"></i>Planos</a></li>
                <li><?php
                    if($logado)echo '<a href="logout.php?token='.session_id().'">Sair</a>';
                    else{echo "<button onclick='AparecerModalL()' class='botao-login'> <i class='fas fa-sign-in-alt'></i>Login</button>";}
                ?></li>
            </ul>
            <ul class="social-medias">
                <li><a target="_blank" href="https://instagram.com"><i class="fab fa-instagram-square"></i></a></li>
                <li><a target="_blank" href="https://facebook.com"><i class="fab fa-facebook-square"></i></a></li>
            </ul>
        </div>
    </header>

    <div class="container text-center planos" style="margin-top: 100px">
        <p class="texto-planos">OS MELHORES PLANOS<br>COM OS MELHORES PREÇOS<br><span>DO MERCADO.</span></p>
        <div class="texto-img-planos">
            <div class="half img img-drive"></div>
            <div class="half"><p>
                Produtos únicos no mercado
                Pague o menor preço do mercado, baseado nos KMs que rodar
                <br><br>
                Cheirinho de carro novo
                Carros de luxo preservados ou com baixa quilometragem
                <br><br>
                Chega de burocracia
                Não precisa possuir cartão de crédito e pode ser pago com boleto bancário
                <br><br>
                Tecnologia é a nossa maior aliada
                Carros monitorados e atendimento de emergência 24h
            </p></div>
        </div>
        <p class="texto2-planos">Na VIGONO, temos <span>dois planos</span>. Conheça a diferença entre eles:</p>

        <h1>Conheça nossos planos</h1>
        <div class="cards">
            <div class="half plano1">
                <div class="card">
                    <div class="planos-padding">
                        <p class="titulo-v">VIGONO.</p>
                        <p class="titulo-plano">CURTO PRAZO</p>
                        <h3>R$<span>599</span>,00<br>
                            por semana</h3>
                        <p class="normas">Permanência mínima de 4 semanas ou cobrança de multa contratual (R$800)<br>
                            Sem cobrança por kms adicionais<br>
                            Sistema de monitoramento mais seguro do mercado<br>
                            Assistência 24 horas<br>
                            Pacote proteção pelo menor preço do mercado<br>
                            Renovação semanal automática, sem troca do veículo</p>
                        <?php
                            //LOGICA DE LOCACAO
                            if($logado == true){echo "<a class='assine' href='planos.php$curtoUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="assine">Assinar</button>';}
                        ?>
                    </div>
                </div>
            </div>
            <div class="half plano2">
                <div class="card">
                    <div class="planos-padding">
                        <p class="titulo-v">VIGONO.</p>
                        <p class="titulo-plano">LONGO PRAZO</p>
                        <h3>R$<span>599</span>,00<br>
                            por semana</h3>
                        <p class="normas">Permanência mínima de 6 meses ou cobrança de multa contratual (R$1.600)<br>
                            Sem cobrança por kms adicionais<br>
                            Sistema de monitoramento mais seguro do mercado<br>
                            Assistência 24 horas<br>
                            Pacote proteção pelo menor preço do mercado<br>
                            Renovação semestral não automática, com troca do veículo</p>
                        <?php
                            //LOGICA DE LOCACAO
                            if($logado == true){echo "<a class='assine' href='planos.php$longoUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="assine">Assinar</button>';}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-login" class="modal">
        <div class="modal-content">
            <span onclick="SumirModalL()" class="close">&times;</span>
            <h2>Preencha o Login: </h2> <hr>
            <form id="form-login" method="POST" action="login.php">
                <label for="Cpf">Cpf:</label><br>
                <input type="text" id="login-Cpf" name="Cpf"><br>
                <label for="Senha">Senha:</label><br>
                <input type="password" id="senha-login" name="Senha" minlength="8" required><br>

                <input type="submit" id="logar" value="Logar" name="logar" style="margin-top: 1rem">

                <input type="button" onclick="SumirModalL(); AparecerModalC()" value="Cadastrar" class="botao-cadastro">
            </form>
        </div>
    </div>

    <div id="modal-cadastro" class="modal">
        <div class="modal-content">
            <span onclick="SumirModalC()" class="close">&times;</span>
            <h2>Preencha o formulário de Cadastro: </h2> <hr>
            <form id="form-cadastro" name="cadCliente" method="POST" action="cadastro.php">
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome"><br>
                <label for="Cpf">CPF:</label><br>
                <input type="text" name="Cpf"><br>
                <label for="Email">Email:</label><br>
                <input type="text" name="Email"><br>
                <label for="Senha">Senha:</label><br>
                <input type="password" name="Senha" minlength="8" required><br>


                <input type="submit" name="botao-enviar-cadastro">
            </form>
        </div>
    </div>

    <footer>
        <div id="footer">
            <ul class="footer">
                <li>2020 © Vigono Macchine</li>
                <li><a target="_blank" href="https://instagram.com"><i class="fab fa-instagram-square"></i>Instagram</a></li>
                <li><a target="_blank" href="https://facebook.com"><i class="fab fa-facebook-square"></i>Facebook</a></li>
                <li><a href="mailto:vigonomacchine@sample.com?subject=Contato"><i class="fas fa-envelope"></i>Email</a></li>
            </ul>
        </div>
    </footer>

    <script type="text/javascript">
        var url = "http://localhost/VigonoMacchine/pags/planos.php";
        if(window.location.href != url){
            window.location.replace("http://localhost/VigonoMacchine/pags/planos.php");
        }
    </script>

    <script src="../javascript/script.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</body>
</html>