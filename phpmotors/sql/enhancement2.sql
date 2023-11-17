

--User insertion
INSERT INTO CLIENTS (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

--User update
UPDATE CLIENTS SET clientLeveL = 3 WHERE clientId = 1 AND clientFirstname = 'Tony';


--Update inventory description
UPDATE INVENTORY SET invDescription = REPLACE(invDescription, 'small', 'spacious') WHERE invId = 12 AND invMake = 'GM' AND invModel = 'Hummer';


--Select inner join SUV
SELECT inventory.invModel, carclassification.classificationName FROM inventory 
INNER JOIN carclassification ON carclassification.classificationId = inventory.classificationId AND inventory.classificationId = 1;


--Inventory delete
DELETE FROM inventory WHERE invId = 1 AND invMake = 'Jeep' AND invModel = 'Wrangler';

--Update concat /phpmotors to inventory
UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);

