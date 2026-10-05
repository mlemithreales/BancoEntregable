USE db_banco_adso;

INSERT INTO clientes (id, nombre) VALUES
(1, 'Yendris'),
(2, 'Yulieth'),
(3, 'Ana'),
(4, 'Andres'),
(5, 'Juan')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

INSERT INTO cuentas (id, numero_cuenta, saldo, cliente_id) VALUES
(1, '100001', 250000.00, 1),
(2, '100002', 500000.00, 2),
(3, '100003', 750000.00, 3),
(4, '100004', 300000.00, 4),
(5, '100005', 1000000.00, 5)
ON DUPLICATE KEY UPDATE numero_cuenta = VALUES(numero_cuenta), saldo = VALUES(saldo), cliente_id = VALUES(cliente_id);

INSERT INTO usuarios (id, cuenta_id, clave_hash) VALUES
(1, 1, '$2y$10$wE8wY.hby0CWh8S.4Q6DduN5rW2lO9pB9P5e/5K07hCg38V9E5B6y'),
(2, 2, '$2y$10$wE8wY.hby0CWh8S.4Q6DduN5rW2lO9pB9P5e/5K07hCg38V9E5B6y'),
(3, 3, '$2y$10$wE8wY.hby0CWh8S.4Q6DduN5rW2lO9pB9P5e/5K07hCg38V9E5B6y'),
(4, 4, '$2y$10$wE8wY.hby0CWh8S.4Q6DduN5rW2lO9pB9P5e/5K07hCg38V9E5B6y'),
(5, 5, '$2y$10$wE8wY.hby0CWh8S.4Q6DduN5rW2lO9pB9P5e/5K07hCg38V9E5B6y')
ON DUPLICATE KEY UPDATE clave_hash = VALUES(clave_hash);


INSERT INTO retiros (id, cuenta_id, valor, fecha) VALUES
(1, 1, 50000.00, '2026-09-20 09:30:00'),
(2, 2, 100000.00, '2026-09-20 10:15:00'),
(3, 3, 75000.00, '2026-09-21 11:00:00'),
(4, 4, 50000.00, '2026-09-21 14:20:00'),
(5, 5, 200000.00, '2026-09-22 08:45:00')
ON DUPLICATE KEY UPDATE valor = VALUES(valor), fecha = VALUES(fecha);

INSERT INTO transferencias (id, cuenta_origen_id, cuenta_destino_id, valor, fecha) VALUES
(1, 1, 2, 25000.00, '2026-09-20 12:00:00'),
(2, 2, 3, 50000.00, '2026-09-20 15:30:00'),
(3, 3, 4, 100000.00, '2026-09-21 09:45:00'),
(4, 4, 5, 75000.00, '2026-09-21 16:10:00'),
(5, 5, 1, 150000.00, '2026-09-22 10:30:00')
ON DUPLICATE KEY UPDATE valor = VALUES(valor), fecha = VALUES(fecha);
