<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo de Utilizador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registo de Utilizador</h1>
        
        <?php
        // Exibir mensagens de erro ou sucesso se existirem
        if (isset($_GET['error'])) {
            echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        
        if (isset($_GET['success'])) {
            echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        ?>
        
        <form action="process.php" method="post" id="registrationForm">
            <div class="form-group">
                <label for="nome">Nome Completo*:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail*:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Palavra-passe* (mínimo 6 caracteres):</label>
                <input type="password" id="password" name="password" minlength="6" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Palavra-passe*:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <div class="form-group">
                <label for="morada">Morada*:</label>
                <textarea id="morada" name="morada" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="codigo_postal">Código Postal*:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>
            </div>
            
            <div class="form-group">
                <label for="cidade">Cidade*:</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>
            
            <div class="form-group">
                <label for="pais">País*:</label>
                <input type="text" id="pais" name="pais" required>
            </div>
            
            <div class="form-group">
                <label for="nif">Número de Identificação Fiscal (NIF)*:</label>
                <input type="text" id="nif" name="nif" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone">
            </div>
            
            <div class="form-group checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Aceito os Termos e Condições*</label>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Registar" class="submit-btn">
            </div>
            
            <p class="required-fields">* Campos obrigatórios</p>
        </form>
    </div>
    
    <script src="validation.js"></script>
</body>
</html>
