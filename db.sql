CREATE TABLE users
(
    user_id    INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100),
    surname    VARCHAR(100),
    email      VARCHAR(255),
    address    VARCHAR(255),
    phone      VARCHAR(20),
    password   VARCHAR(255),
    role       VARCHAR(50) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE categories
(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE products
(
    product_id   INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255),
    price        DECIMAL(10, 2),
    description  TEXT,
    rating       DECIMAL(3, 2),
    rating_count INT,
    discount     DECIMAL(10, 2),
    brand        VARCHAR(50),
    stock        INT,
    image_url    TEXT,
    category_id  INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL  -- Вказуємо, що буде відбуватися, якщо категорія видалена
);

CREATE TABLE orders
(
    order_id        INT AUTO_INCREMENT PRIMARY KEY,
    order_start     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_end       TIMESTAMP,
    payment_method  VARCHAR(50),
    shipping_status VARCHAR(50) DEFAULT 'pending',
    user_id         INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE order_items
(
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id      INT,
    quantity      INT,
    price         DECIMAL(10, 2),
    product_id    INT,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE reviews
(
    review_id   INT AUTO_INCREMENT PRIMARY KEY,
    rating      DECIMAL(3, 2),
    review_text TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id     INT,
    product_id  INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE carts
(
    cart_id    INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE cart_items
(
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id      INT,
    product_id   INT,
    quantity     INT,
    price        DECIMAL(10, 2),
    added_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(cart_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);
