CREATE TABLE Produits (
    p_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    categorie VARCHAR(50),  
    prix DECIMAL(10, 2) NOT NULL,
    quantite INT NOT NULL,
    chemin_image VARCHAR(255),
    date_Creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Produits (nom, description, categorie, prix, quantite, chemin_image)
VALUES 
('Cannabis Sativa', 'Sativa de haute qualité, connue pour ses effets énergisants', 'Cannabis', 30.00, 100, 'img/cannabissativa.jpg'),
('Cannabis Indica', 'Indica premium, idéale pour la relaxation et le soulagement de la douleur', 'Cannabis', 35.00, 50, 'img/cannabisindica.jpg'),
('MDMA', 'MDMA pure sous forme cristalline, testée pour une haute pureté', 'Stimulants', 70.00, 25, 'img/mdma.jpg'),
('Cocaïne', "Cocaïne de qualité supérieure, provenant d'Amérique du Sud", 'Stimulants', 150.00, 20, 'img/cocaine.jpg'),
('LSD', 'Pastilles de 100 mcg de LSD pur, connues pour des effets psychédéliques intenses', 'Psychédéliques', 50.00, 200, 'img/lsd.jpg'),
('Héroïne', 'Héroïne noire, puissante et de haute qualité', 'Opioïdes', 120.00, 15, 'img/heroine.jpg'),
('Méthamphétamine', 'Méthamphétamine en cristaux, connue pour ses effets stimulants intenses', 'Stimulants', 90.00, 30, 'img/meth.jpg'),
('Champignons Magiques', 'Champignons psilocybine séchés, prêts à être consommés', 'Psychédéliques', 45.00, 75, 'img/champi.jpg'),
('Kétamine', 'Kétamine de qualité médicale, utilisée à des fins récréatives pour ses effets dissociatifs', 'Dissociatifs', 85.00, 40, 'img/ketamine.jpg'),
('Xanax', 'Xanax (alprazolam) de qualité pharmaceutique, populaire pour ses effets calmants', 'Benzodiazépines', 10.00, 500, 'img/xanax.jpg');