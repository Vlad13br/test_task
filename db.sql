-- Створення таблиці users
CREATE TABLE users
(
    user_id    SERIAL PRIMARY KEY,
    name       VARCHAR(100),
    surname    VARCHAR(100),
    email      VARCHAR(255),
    address    VARCHAR(255),
    phone      VARCHAR(20),
    password   VARCHAR(255),
    role       VARCHAR(50) DEFAULT 'user',
    created_at TIMESTAMP   DEFAULT NOW(),
    updated_at TIMESTAMP   DEFAULT NOW()
);

-- Створення таблиці watchers
CREATE TABLE watchers
(
    watcher_id   SERIAL PRIMARY KEY,
    product_name VARCHAR(255),
    price        DECIMAL(10, 2),
    description  TEXT,
    material     VARCHAR(50),
    rating       DECIMAL(3, 2),
    rating_count INT,
    discount     DECIMAL(10, 2),
    brand        VARCHAR(50),
    stock        INT,
    image_url    TEXT
);

-- Створення таблиці orders
CREATE TABLE orders
(
    order_id        SERIAL PRIMARY KEY,
    order_start     TIMESTAMP   DEFAULT NOW(),
    order_end       TIMESTAMP,
    payment_method  VARCHAR(50),
    shipping_status VARCHAR(50) DEFAULT 'pending',
    user_id         INT REFERENCES users (user_id) ON DELETE CASCADE
);

-- Створення таблиці order_items
CREATE TABLE order_items
(
    order_item_id SERIAL PRIMARY KEY,
    order_id      INT REFERENCES orders (order_id) ON DELETE CASCADE,
    quantity      INT,
    price         DECIMAL(10, 2),
    watcher_id    INT REFERENCES watchers (watcher_id) ON DELETE CASCADE
);

-- Оновлена таблиця reviews
CREATE TABLE reviews
(
    review_id   SERIAL PRIMARY KEY,
    rating      DECIMAL(3, 2),
    review_text TEXT,
    review_date TIMESTAMP DEFAULT NOW(),
    user_id     INT REFERENCES users (user_id) ON DELETE CASCADE,
    watcher_id  INT REFERENCES watchers (watcher_id) ON DELETE CASCADE
);

-- Створення таблиці carts
CREATE TABLE carts
(
    cart_id    SERIAL PRIMARY KEY,
    user_id    INT REFERENCES users (user_id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);

-- Створення таблиці cart_items
CREATE TABLE cart_items
(
    cart_item_id SERIAL PRIMARY KEY,
    cart_id      INT REFERENCES carts (cart_id) ON DELETE CASCADE,
    watcher_id   INT REFERENCES watchers (watcher_id) ON DELETE CASCADE,
    quantity     INT,
    price        DECIMAL(10, 2),
    added_at     TIMESTAMP DEFAULT NOW()
);
