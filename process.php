<?php
// Iniciar ou retomar a sessão
session_start();

// Função para validar o formato do código postal português (XXXX-XXX)
function validarCodigoPostal($cp) {
    return preg_match('/^\d{4}-\d{3}$/', $cp);
}

// Função para validar NIF português (9 dígitos)
function validarNIF($nif) {
    return preg_match('/^\d{9}$/', $nif);
}

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recolher e sanitizar dados do formulário
    $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $morada = trim(filter_input(INPUT_POST, 'morada', FILTER_SANITIZE_STRING));
    $codigo_postal = trim(filter_input(INPUT_POST, 'codigo_postal', FILTER_SANITIZE_STRING));
    $cidade = trim(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING));
    $pais = trim(filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING));
    $nif = trim(filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING));
    $telefone = trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING));
    
    // Verificar se os termos foram aceites
    $terms = isset($_POST['terms']) ? true : false;
    
    // Validação dos dados
    $errors = [];
    
    if (empty($nome)) {
        $errors[] = "Nome completo é obrigatório.";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail válido é obrigatório.";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Palavra-passe deve ter pelo menos 6 caracteres.";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "As palavras-passe não coincidem.";
    }
    
    if (empty($morada)) {
        $errors[] = "Morada é obrigatória.";
    }
    
    if (empty($codigo_postal) || !validarCodigoPostal($codigo_postal)) {
        $errors[] = "Código postal inválido. Use o formato XXXX-XXX.";
    }
    
    if (empty($cidade)) {
        $errors[] = "Cidade é obrigatória.";
    }
    
    if (empty($pais)) {
        $errors[] = "País é obrigatório.";
    }
    
    if (empty($nif) || !validarNIF($nif)) {
        $errors[] = "NIF inválido. Deve conter 9 dígitos.";
    }
    
    if (!$terms) {
        $errors[] = "Deve aceitar os termos e condições.";
    }
    
    // Se não houver erros, processar os dados
    if (empty($errors)) {
        try {
            // Conectar à base de dados Access usando PDO e ODBC
            $dsn = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=" . __DIR__ . "/ecommerce.accdb";
            $pdo = new PDO($dsn, "", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Verificar se o email já existe
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Utilizadores WHERE Email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                header("Location: index.php?error=Este e-mail já está registado.");
                exit;
            }
            
            // Verificar se o NIF já existe
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Utilizadores WHERE NIF = ?");
            $stmt->execute([$nif]);
            if ($stmt->fetchColumn() > 0) {
                header("Location: index.php?error=Este NIF já está registado.");
                exit;
            }
            
            // Hash da password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Preparar e executar a inserção
            $stmt = $pdo->prepare("
                INSERT INTO Utilizadores 
                (Nome, Email, Password, Morada, CodigoPostal, Cidade, Pais, NIF, Telefone, DataRegisto) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $nome,
                $email,
                $hashed_password,
                $morada,
                $codigo_postal,
                $cidade,
                $pais,
                $nif,
                $telefone
            ]);
            
            // Redirecionar para a página de confirmação
            header("Location: confirmation.php");
            exit;
            
        } catch (PDOException $e) {
            $error_message = "Erro na base de dados: " . $e->getMessage();
            header("Location: index.php?error=" . urlencode($error_message));
            exit;
        }
    } else {
        // Se houver erros, redirecionar de volta para o formulário com os erros
        $error_string = implode("<br>", $errors);
        header("Location: index.php?error=" . urlencode($error_string));
        exit;
    }
} else {
    // Se alguém acessar esta página diretamente, redirecionar para o formulário
    header("Location: index.php");
    exit;
}
?>
