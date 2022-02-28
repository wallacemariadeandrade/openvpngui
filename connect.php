<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Conexão</h1>
            <?php

            if(isset($_POST['selected-profile'])){
                echo "<pre>"; 
                echo shell_exec("openvpn3 session-start --config ".getcwd()."/"."files/".$_POST['selected-profile']);
                echo "</pre>";
            } else {
                print "Ocorreu um erro ao conectar. Tente novamente depois.";
            }
            ?>
            <a href="openvpngui.php">Retornar</a>
        </div>
    </body>
</html>