CREATE TABLE IF NOT EXISTS TodoList (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    categorie ENUM('NONE', 'TODO', 'SHOPPING', 'WORK', 'FAMILY') NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_echeance DATE,
    etat ENUM('TODO', 'DONE') DEFAULT 'TODO',
    INDEX (categorie),
    INDEX (etat)
);