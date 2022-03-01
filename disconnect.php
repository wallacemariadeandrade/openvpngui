<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Desconexão</h1>
            <?php

            if(isset($_POST['session-path']) && $_POST['session-path'] != "") {
                $output = shell_exec("openvpn3 session-manage --disconnect --session-path ".$_POST['session-path']);
                if(isset($output)){
                    echo "<pre>"; 
                    echo $output;
                    echo "</pre>";
                }
                else {
                    print "Ocorreu um erro na na desconexão. Veja os logs para mais informações.";
                }
            } else {
                print "Ocorreu um erro na requisição. Veja os logs para mais informações.";
            }
            ?>
            <br/>
            <br/>
            <a href="openvpngui.php">Retornar</a>

            <?php
                include "footer.php";
            ?>
        </div>
    </body>
</html>