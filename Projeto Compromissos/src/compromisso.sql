CREATE TABLE compromisso (
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao   VARCHAR(50) NOT NULL,
    data        DATE NOT NULL,
    hora        TIME NOT NULL,
    status      CHAR(1) -- Agendado, Cancelado, Realizado
) ENGINE = INNODB;

INSERT INTO compromisso ( descricao, data, hora, status ) VALUES
( 'Consulta médica', '2026-12-08', '11:00', 'A' ),
( 'Consulta odontológica', '2026-10-08', '15:00', 'A' ),
( 'Reunião com grupo', '2026-10-07', '13:00', 'R' ),
( 'Prova de Inglês', '2026-10-05', '19:00', 'C' );