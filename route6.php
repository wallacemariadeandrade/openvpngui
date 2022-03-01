<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>Rota IPv6 2000::/3</h1>
            <?php

            if(isset($_POST['tun']) && $_POST['tun'] != "") {
                shell_exec("ip -6 route add 2000::/3 dev ".$_POST['tun']);
                $output = shell_exec("ip -6 route | grep 2000");
                if(isset($output)){
                    echo "<pre>"; 
                    echo $output;
                    echo "</pre>";
                }
                else {
                    print "Ocorreu um erro na configuração da rota IPv6. Veja os logs para mais informações.";
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