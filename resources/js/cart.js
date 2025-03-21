document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-to-cart-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            let productId = this.dataset.productId;
            let productName = this.dataset.productName;
            let productPrice = this.dataset.productPrice;
            let productImage = this.dataset.productImage;

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                },
                body: JSON.stringify({
                    product: {
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage
                    }
                })
            })
            alert("Товар додано в кошик");
        });
    });
});
document.querySelector("#profile-form").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector("#status-message").classList.remove("hidden");
            } else {
                alert("Не вдалося оновити профіль.");
            }
        })
        .catch(error => console.error("Помилка:", error));
});



document.addEventListener('DOMContentLoaded', function () {
    const updateQuantityForms = document.querySelectorAll('.cart-item .update-quantity-form');

    updateQuantityForms.forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            const data = await response.json();

            if (data.success) {
                const quantityInput = form.querySelector('input[name="quantity"]');
                quantityInput.value = data.cartItem.quantity;

                const totalPriceElement = document.querySelector('.cart-summary p');
                totalPriceElement.textContent = `${data.totalPrice} грн`;

                const statusMessage = document.getElementById('status-message');
                statusMessage.textContent = 'Товар оновлено';
                statusMessage.classList.remove('hidden');
            } else {
                alert('Сталася помилка при оновленні товару');
            }
        });
    });

    const deleteButtons = document.querySelectorAll('.cart-item .delete-item-form');

    deleteButtons.forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });

            const data = await response.json();

            if (data.success) {
                const cartItem = form.closest('.cart-item');
                cartItem.remove();

                const totalPriceElement = document.querySelector('.cart-summary p');
                totalPriceElement.textContent = `${data.totalPrice} грн`;

                const statusMessage = document.getElementById('status-message');
                statusMessage.textContent = 'Товар видалено';
                statusMessage.classList.remove('hidden');
            } else {
                alert('Сталася помилка при видаленні товару');
            }
        });
    });
});
