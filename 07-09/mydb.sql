DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  price INTEGER,
  stock INTEGER
);

INSERT INTO items (name, price, stock) VALUES
('laptop computer', 120000, 2),
('desktop computer', 99800, 0),
('display', 30350, 100),
('keyboard', 2980, 10);

SELECT id,name FROM items WHERE stock>1;

UPDATE items SET stock=1 WHERE id=2;

DELETE FROM items WHERE id=4;

SELECT * FROM items;
