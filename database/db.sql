USE formation;
DROP TABLE IF EXISTS products;
CREATE TABLE products(
    id INT UNSIGNED AUTO_INCREMENT,
    product_name VARCHAR(50) NOT NULL,
    price FLOAT(10) NOT NULL,
    category VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO products(product_name,price,category)
VALUES ('café',4.50,'Epicerie'),('vin',9.90,'Liquide'),('lait(1l)',0.90,'Cremerie');