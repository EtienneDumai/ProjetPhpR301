CREATE TABLE Produits (
    p_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    categorie VARCHAR(50),  
    prix DECIMAL(10, 2) NOT NULL,
    Quantite INT NOT NULL,
    Date_Creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO Produits (nom, description, categorie, prix, Quantite)
VALUES 
('Cannabis Sativa', 'Sativa de haute qualité, connue pour ses effets énergisants', 'Cannabis', 30.00, 100),
('Cannabis Indica', 'Indica premium, idéale pour la relaxation et le soulagement de la douleur', 'Cannabis', 35.00, 50),
('MDMA', 'MDMA pure sous forme cristalline, testée pour une haute pureté', 'Stimulants', 70.00, 25),
('Cocaïne', "Cocaïne de qualité supérieure, provenant d'Amérique du Sud", 'Stimulants', 150.00, 20),
('LSD', 'Pastilles de 100 mcg de LSD pur, connues pour des effets psychédéliques intenses', 'Psychédéliques', 50.00, 200),
('Héroïne', 'Héroïne noire, puissante et de haute qualité', 'Opioïdes', 120.00, 15),
('Méthamphétamine', 'Méthamphétamine en cristaux, connue pour ses effets stimulants intenses', 'Stimulants', 90.00, 30),
('Champignons Magiques', 'Champignons psilocybine séchés, prêts à être consommés', 'Psychédéliques', 45.00, 75),
('Kétamine', 'Kétamine de qualité médicale, utilisée à des fins récréatives pour ses effets dissociatifs', 'Dissociatifs', 85.00, 40),
('Xanax', 'Xanax (alprazolam) de qualité pharmaceutique, populaire pour ses effets calmants', 'Benzodiazépines', 10.00, 500);
