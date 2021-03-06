<?php
// define variables and set to empty values

$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Nome é obrigatorio";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Zà-úÀ-Ú ]*$/", $name)) {
            $nameErr = "Apenas letras e espaços em branco são permitidos";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email é obrigatorio";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
        $comment = wordwrap($comment, 70);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Sexo é obrigatorio";
    } else {
        $gender = test_input($_POST["gender"]);
    }
    /*
      Envio de e-mail
     */
    $para = 'xandy.bq@gmail.com';
    $assunto = 'E-mail através do formulario';
    $mensagem = "De: $name <$email> \r\n";
    $mensagem .= "Site: $website \r\n";
    $mensagem .= "Sexo: $gender \r\n";
    $mensagem .= "Comentarios \r\n\n $comment";
    $headers = "From $name <$email>"
            . "\r\n" . 'X-MAILER: PHP/' . phpversion();

    IF (strlen($nameErr) == 0 && strlen($emailErr) == 0 && strlen($websiteErr) == 0 && strlen($name != 0) && strlen($email != 0)) {
        mail($para, $assunto, $mensagem, $headers);
        $statusMail = TRUE;
    } else {
        $statusMail = FALSE;
    }
}

// Função que faz a limpeza de dados
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data); /* coloca \ quando tem aspas */
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Escolinha PHP</title>
        <style>
            .err{
                outline: 1px dashed red;
                background-color: rgb(255,0,0,2);
            }
        </style>
    </head>
    <body>      
        <h1>Manuseio de Formulário com PHP</h1>
        <h2>Referências:</h2>
        <ul>
            <li><a href="http://www.w3schools.com/php/" target="_back">W3Schools</a></li>
            <li><a href="http://php.net/" target="_back" >Manual do PHP</a></li>
        </ul>

        <!--Deve ser utilizado "htmlspecialchars" para segurança, sempre utilizar com PHP_SELF -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Name: <input type="text" name="name" value="<?= $name; ?>" class="<?= strlen($nameErr) != 0 ? "err" : ''; ?>">
            <span class="error">* <?php echo @$nameErr; ?></span>
            <br><br>
            E-mail:
            <input type="email" name="email" value="<?= $email; ?>" class="<?= strlen($emailErr) != 0 ? "err" : ''; ?>">
            <span class="error">* <?php echo @$emailErr; ?></span>
            <br><br>
            Website:
            <input type="url" name="website" value="<?= $website; ?>" class="<?= strlen($websiteErr) != 0 ? "err" : ''; ?>">
            <span class="error"><?php echo @$websiteErr; ?></span>
            <br><br>
            Comentario: <textarea name="comment" rows="5" cols="40"><?= $comment; ?></textarea>
            <br><br>
            Sexo:
            <input type="radio" name="gender" value="Feminino" <?php if (isset($gender) && $gender == "Feminino") echo "checked"; ?> class="<?= strlen($genderErr) != 0 ? "err" : ''; ?>">Feminino
            <input type="radio" name="gender" value="Masculino" <?php if (isset($gender) && $gender == "Masculino") echo "checked"; ?> class="<?= strlen($genderErr) != 0 ? "err" : ''; ?>">Masculino
            <span class="error">* <?php echo $genderErr; ?></span>

            <br><br>
            <input type="submit" name="submit" value="Enviar"> 
        </form>

        <!-- Envio de E-mail-->
        <?php
        IF (isset($statusMail) && $statusMail) {
            echo "<h1> E-mail enviado!</h1>";
        } else {
            echo "<h1 class='err'> E-mail não enviado!</h1>";
        };
        ?>

    </body>
</html>
