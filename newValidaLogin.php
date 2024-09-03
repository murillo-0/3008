<!DOCTYPE html>
    <head> 
        <meta charset="utf-8" />
        <title>App Help Desk</title>
    </head>
    
<body> 
<?php
    session_start();
    $_SESSION ['X']='Seção oficialmente aberta';
    print_r($_SESSION['X']);
    echo'<hr>';

    $usuario_autenticator=false; /* é para criar uma condição*/


    //nosso servidor
    $servername= "localhost";

    //usuário padrão do servidor local
    $username= "root";

    //senha padrão do servidor local
    $password= "";

    //nome do banco de dados
    $db_name= "validalogin";

    //faz a coneção com o banco de dados, sequindo informações especificadas
    $conn= new mysqli($servername,$username,$password,$db_name);

    //verifica a conexão com o banco de dados, em caso de erro
    if($conn->connect_error) {
        //o die encerra o script e pode conter uma mensagem de erro
        die("Falha na coneção!" . $conn->conect_error);
    }

    //capturando os dados fornecidos pelo formulário
    $email=$_POST['email'];
    $senha=password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $usuarios_app= array($email . $senha);
    $sqlmail= "SELECT * FROM usuarios WHERE nome='$email';";
    $sqlsenha= "SELECT * FROM usuarios WHERE nome='$senha';";
    $sql = array(
        'email' => $sqlmail ,
        'senha' => $sqlsenha
    );
    

    if ($sql['email']==$_POST['email'] && $sql['senha']==$_POST['senha']) {
        $usuario_autenticator=true;      
    }

/* -se o email e a senha for igual os arreys é true */

    if($usuario_autenticator) {
    echo "Usuario Autenticado";
    $_SESSION['autenticado'] = 'SIM';
    header('Location: home.php');
    }
    else{ /*se não encontrar devolver usuario não encontrado*/ 
    header('Location: index.php?login=erro');
    $_SESSION['autenticado'] = 'NAO';
    }


$conn->close();
?>
</body>
</html>