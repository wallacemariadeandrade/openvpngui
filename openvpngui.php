<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div class="container">
            <h1>OpenVPN GUI Linux</h1>
            <form action="import-profile.php" method="POST" enctype="multipart/form-data">
                <label for="import-profile">Importar profile</label>
                <input type="file" id="import-profile" name="profile" accept=".ovpn"/>
                <button type="submit">Enviar</button>
            </form>
            
            <h2>Perfis importados:</h2>
            <?php 
                $profiles = array_diff(scandir(getcwd()."/"."profiles/"), array('..', '.'));
                foreach ($profiles as $profile) {
                    print $profile;
                    print "<br/>";
                }
            ?>

            <h2>Conectar</h2>
            <form action="connect.php" method="POST">
                <label for="selected-profile">Profile:</label>
                <select id="selected-profile" name="selected-profile">
                    <?php 
                        foreach ($profiles as $profile) {
                            print $profile;
                            print "<option value='$profile'>$profile</option>";
                        }
                    ?>
                </select>
                <button type="submit">Conectar</button>
            </form>

            <h2>Status</h2>
            <div>
                <?php
                    echo "<pre>".shell_exec("openvpn3 sessions-list")."</pre>";
                ?>
            </div>
            
            <?php
                include "footer.php";
            ?>
        </div>
    </body>
</html>