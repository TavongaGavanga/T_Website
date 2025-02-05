document.addEventListener('DOMContentLoaded', function () {
    const checkoutButton = document.querySelector('.checkout');
    const checkoutPage = document.querySelector('.checkoutPage');
    const checkoutItemsContainer = document.querySelector('.checkoutItems');
    const checkoutTotal = document.querySelector('.checkoutTotal');

    checkoutButton.addEventListener('click', () => {
        showCheckoutPage();
        displayCartItems();
    });

    

    // For demonstration purposes, let's add a click event for the "Confirm Payment" button
    const confirmPaymentButton = document.getElementById('confirmPayment');
    confirmPaymentButton.addEventListener('click', () => {
        alert('Payment Confirmed!'); // Replace this with your actual payment confirmation logic
    });

    // Function to show the checkout page
    const showCheckoutPage = () => {
        checkoutPage.style.display = 'block';
    };

    // Function to hide the checkout page
    const hideCheckoutPage = () => {
        checkoutPage.style.display = 'none';
    };

    // Function to display items in the checkout page
    const displayCartItems = () => {
        checkoutItemsContainer.innerHTML = '';
        let totalAmount = 0;

        if (cart.length > 0) {
            cart.forEach(item => {
                let newItem = document.createElement('div');
                newItem.classList.add('checkoutItem');

                let positionProduct = products.findIndex((value) => value.id == item.product_id);
                let info = products[positionProduct];

                let itemTotalPrice = info.price * item.quantity;
                totalAmount = totalAmount + itemTotalPrice;

                newItem.innerHTML = `
                    <div class="image">
                        <img src="${info.image}">
                    </div>
                    <div class="name">
                        ${info.name}
                    </div>
                    <div class="totalPrice">$${itemTotalPrice.toFixed(2)}</div>
                    <div class="quantity">
                        <span>${item.quantity}</span>
                    </div>
                `;

                checkoutItemsContainer.appendChild(newItem);
            });
        }

        checkoutTotal.innerText = `Overall Total: $${totalAmount.toFixed(2)}`;
    };

    // ... (your existing code)

});

