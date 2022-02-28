<html>
<head>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_FILES['file']['tmp_name'])) {
            $dir = getcwd()."/"."files/";
            if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.basename($_FILES['file']['name'])))
                print '<h1>Arquivo importado com sucesso!</h1>';
            else {
                print "<h1>Houve um erro com o import do arquivo!</h1>";
                print print_r($_FILES);
            }
        }
        ?>
        <a href="openvpngui.php">Retornar</a>
        <?php
            include "footer.php";
        ?>
    </div>
</body>
</html>