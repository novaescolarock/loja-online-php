document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    
    form.addEventListener('submit', function(event) {
        // Limpar mensagens de erro anteriores
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(element => {
            element.remove();
        });
        
        let hasErrors = false;
        
        // Validar Nome
        const nome = document.getElementById('nome').value.trim();
        if (nome === '') {
            showError('nome', 'Nome completo é obrigatório');
            hasErrors = true;
        }
        
        // Validar Email
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            showError('email', 'E-mail é obrigatório');
            hasErrors = true;
        } else if (!isValidEmail(email)) {
            showError('email', 'Formato de e-mail inválido');
            hasErrors = true;
        }
        
        // Validar Senha
        const password = document.getElementById('password').value;
        if (password === '') {
            showError('password', 'Palavra-passe é obrigatória');
            hasErrors = true;
        } else if (password.length < 6) {
            showError('password', 'Palavra-passe deve ter pelo menos 6 caracteres');
            hasErrors = true;
        }
        
        // Validar Confirmação de Senha
        const confirmPassword = document.getElementById('confirm_password').value;
        if (confirmPassword === '') {
            showError('confirm_password', 'Confirmação de palavra-passe é obrigatória');
            hasErrors = true;
        } else if (password !== confirmPassword) {
            showError('confirm_password', 'As palavras-passe não coincidem');
            hasErrors = true;
        }
        
        // Validar Morada
        const morada = document.getElementById('morada').value.trim();
        if (morada === '') {
            showError('morada', 'Morada é obrigatória');
            hasErrors = true;
        }
        
        // Validar Código Postal
        const codigoPostal = document.getElementById('codigo_postal').value.trim();
        if (codigoPostal === '') {
            showError('codigo_postal', 'Código postal é obrigatório');
            hasErrors = true;
        } else if (!isValidCodigoPostal(codigoPostal)) {
            showError('codigo_postal', 'Formato de código postal inválido (XXXX-XXX)');
            hasErrors = true;
        }
        
        // Validar Cidade
        const cidade = document.getElementById('cidade').value.trim();
        if (cidade === '') {
            showError('cidade', 'Cidade é obrigatória');
            hasErrors = true;
        }
        
        // Validar País
        const pais = document.getElementById('pais').value.trim();
        if (pais === '') {
            showError('pais', 'País é obrigatório');
            hasErrors = true;
        }
        
        // Validar NIF
        const nif = document.getElementById('nif').value.trim();
        if (nif === '') {
            showError('nif', 'NIF é obrigatório');
            hasErrors = true;
        } else if (!isValidNIF(nif)) {
            showError('nif', 'NIF inválido (deve conter 9 dígitos)');
            hasErrors = true;
        }
        
        // Validar Termos e Condições
        const terms = document.getElementById('terms').checked;
        if (!terms) {
            showError('terms', 'Deve aceitar os termos e condições');
            hasErrors = true;
        }
        
        // Se houver erros, impedir o envio do formulário
        if (hasErrors) {
            event.preventDefault();
        }
    });
    
    // Funções auxiliares de validação
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorMessage = document.createElement('div');
        errorMessage.className = 'error-message';
        errorMessage.innerText = message;
        field.parentNode.appendChild(errorMessage);
        field.classList.add('error-input');
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidCodigoPostal(cp) {
        const cpRegex = /^\d{4}-\d{3}$/;
        return cpRegex.test(cp);
    }
    
    function isValidNIF(nif) {
        const nifRegex = /^\d{9}$/;
        return nifRegex.test(nif);
    }
});
