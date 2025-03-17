-- Este é um modelo para a criação da tabela Utilizadores no Access
-- No Access, você precisará criar esta tabela manualmente ou usando SQL semelhante

CREATE TABLE Utilizadores (
    ID AUTOINCREMENT PRIMARY KEY,
    Nome VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Morada MEMO NOT NULL,
    CodigoPostal VARCHAR(10) NOT NULL,
    Cidade VARCHAR(100) NOT NULL,
    Pais VARCHAR(100) NOT NULL,
    NIF VARCHAR(9) NOT NULL UNIQUE,
    Telefone VARCHAR(15),
    DataRegisto DATETIME DEFAULT Now()
);

-- Criar índices para otimização de consultas
CREATE INDEX idx_email ON Utilizadores (Email);
CREATE INDEX idx_nif ON Utilizadores (NIF);

# Configuração da Base de Dados Access

## Estrutura da Base de Dados

A aplicação utiliza uma base de dados Microsoft Access (.accdb) com a seguinte estrutura:

### Tabela: Utilizadores

| Campo        | Tipo         | Restrições                       |
|--------------|--------------|----------------------------------|
| ID           | AutoNumber   | Chave Primária                   |
| Nome         | Text(255)    | NOT NULL                         |
| Email        | Text(255)    | NOT NULL, UNIQUE                 |
| Password     | Text(255)    | NOT NULL                         |
| Morada       | Memo         | NOT NULL                         |
| CodigoPostal | Text(10)     | NOT NULL                         |
| Cidade       | Text(100)    | NOT NULL                         |
| Pais         | Text(100)    | NOT NULL                         |
| NIF          | Text(9)      | NOT NULL, UNIQUE                 |
| Telefone     | Text(15)     |                                  |
| DataRegisto  | Date/Time    | Default = Now()                  |

## Instruções de Configuração

1. Abra o Microsoft Access
2. Crie um novo banco de dados chamado "ecommerce.accdb"
3. Crie uma nova tabela com o nome "Utilizadores"
4. Adicione todos os campos conforme a estrutura acima
5. Configure o campo ID como chave primária e AutoNumber
6. Configure os campos Email e NIF como UNIQUE
7. Salve a tabela
8. Crie os índices para otimização:
   - Índice em Email
   - Índice em NIF
9. Salve o banco de dados
10. Coloque o arquivo ecommerce.accdb na raiz do projeto
