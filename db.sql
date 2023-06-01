CREATE TABLE treino (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo VARCHAR(20),
  tempo INT,
  categoria VARCHAR(20)
);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50),
  idade INT,
  peso DECIMAL(5,2),
  altura INT
);

CREATE TABLE resultado (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  treino_id INT,
  repeticoes INT,
  tempo INT,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (treino_id) REFERENCES treino(id)
);
