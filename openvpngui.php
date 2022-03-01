<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>OpenVPN GUI Linux</h1>
            <form action="import-files.php" method="POST" enctype="multipart/form-data">
                <label for="import-file">Importar arquivo</label>
                <input type="file" id="import-file" name="file"/>
                <button type="submit">Enviar</button>
            </form>
            
            <h2>Arquivos importados:</h2>
            <?php 
                $files = array_diff(scandir(getcwd()."/"."files/"), array('..', '.'));
                foreach ($files as $file) {
                    print $file;
                    print "<br/>";
                }
            ?>

            <h2>Conectar</h2>
            <form action="connect.php" method="POST">
                <label for="selected-profile">Profile:</label>
                <select id="selected-profile" name="selected-profile">
                    <?php 
                        foreach ($files as $file) {
                            if(strpos($file, '.ovpn') !== false){
                                print $file;
                                print "<option value='$file'>$file</option>";
                            }
                        }
                    ?>
                </select>
                <button type="submit">Conectar</button>
            </form>

            <h2>Status</h2>
            <div>
                <?php
                    $sessions = shell_exec("openvpn3 sessions-list");
                    echo "<pre>".$sessions."</pre>";
                    $route6 = shell_exec("ip -6 route | grep 2000");
                    echo "<pre>".$route6."</pre>";
                ?>
            </div>

            <h2>Desconectar</h2>
            <form action="disconnect.php" method="POST">
                <label for="session-path">Session path:</label>
                <input type="text" id="session-path" name="session-path" />
                <button type="submit">Desconectar</button>
            </form>
            
            <h2>
                Rota IPv6 2000::/3
                <br/>
                <small>(só aplique se tiver IPv6 configurado na VPN e não tiver recebido a rota default automaticamente)</small>
            </h2>
            <form action="route6.php" method="POST">
                <label for="tun">Nome da interface tun da VPN:</label>
                <input type="text" id="tun" name="tun" />
                <button type="submit">Aplicar</button>
            </form>

            <?php
                include "footer.php";
            ?>
        </div>
    </body>
</html>