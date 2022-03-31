
INSERT INTO clients 
(clientFirstname,clientLastname,clientEmail,clientPassword,comment)
VALUES
('Tony','Stark','tony@starkent.com','Iam1ronM@n',"I am the real Ironman");

UPDATE clients
SET clientLevel = 3
WHERE  clientId = 1;

UPDATE inventory
SET
invDescription = replace(invDescription,"small interior","spacious interior")
WHERE invId = 12;

SELECT invModel,
	carclassification.classificationName
FROM inventory
	INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = "SUV";

DELETE
FROM
  inventory
WHERE
  invMake = "Jeep" AND invModel= "Wrangler";


UPDATE inventory 
SET 
    invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);

    