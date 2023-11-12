-- Tabela Vehicle
CREATE TABLE Vehicle (
                         id SERIAL PRIMARY KEY,
                         Placa VARCHAR(7) NOT NULL,
                         Renavam VARCHAR(30),
                         Modelo VARCHAR(20) NOT NULL,
                         Marca VARCHAR(20) NOT NULL,
                         Ano INTEGER NOT NULL,
                         Cor VARCHAR(20) NOT NULL
);

-- Tabela Motorist
CREATE TABLE Motorist (
                          id SERIAL PRIMARY KEY,
                          Nome VARCHAR(200) NOT NULL,
                          RG VARCHAR(20) NOT NULL,
                          CPF VARCHAR(11) NOT NULL,
                          Telefone VARCHAR(20),
                          Veiculo INTEGER REFERENCES Vehicle(id) -- Esta é uma chave estrangeira referenciando a tabela Vehicle
);

-- Adicionar 10 caminhões fictícios na tabela Vehicle
INSERT INTO Vehicle (Placa, Renavam, Modelo, Marca, Ano, Cor) VALUES
                                                                  ('ABC1234', '12345678901234567890', 'FH 540', 'Volvo', 2018, 'Branco'),
                                                                  ('XYZ5678', '98765432109876543210', 'S 500 A', 'Scania', 2015, 'Azul'),
                                                                  ('DEF9999', '11111111112222222222', 'Actros 2651', 'Mercedes-Benz', 2020, 'Vermelho'),
                                                                  ('GHI7777', '22223333444455556666', 'R440', 'Renault', 2019, 'Verde'),
                                                                  ('JKL5555', '33334444555566667777', 'VM 260', 'Volkswagen', 2017, 'Amarelo'),
                                                                  ('MNO2222', '44445555666677778888', 'FH 460', 'Volvo', 2016, 'Cinza'),
                                                                  ('PQR1111', '55556667778889990000', '1242', 'Ford', 2021, 'Preto'),
                                                                  ('STU8888', '66667778889990001111', 'FH 500', 'Volvo', 2019, 'Prata'),
                                                                  ('VWX4444', '77778889990001112222', 'R450', 'Renault', 2020, 'Azul'),
                                                                  ('YZA0000', '88889990001112223333', 'S 450 A', 'Scania', 2018, 'Vermelho');


-- Adicionar 10 motoristas fictícios na tabela Motorist, associando-os a veículos de 1 a 10
INSERT INTO Motorist (Nome, RG, CPF, Telefone, Veiculo) VALUES
                                                            ('João', '123456789', '11122233344', '99998888', 1),
                                                            ('Maria', '987654321', '55544433322', '77776666', 2),
                                                            ('Pedro', '111111111', '99988877766', NULL, 3),
                                                            ('Carla', '222222222', '12312312312', '12345678', 4),
                                                            ('Marcos', '333333333', '45678912345', '98765432', 5),
                                                            ('Ana', '444444444', '78945612378', '34567891', 6),
                                                            ('Rafael', '555555555', '96385274136', '13579246', 7),
                                                            ('Mariana', '666666666', '15935785246', '35748691', 8),
                                                            ('Carlos', '777777777', '75395148672', '95175364', 9),
                                                            ('Sofia', '888888888', '98765432123', '65498721', 10);
