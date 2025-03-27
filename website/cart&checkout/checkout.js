let listCart = [];

// Function to load cart from cookies
function checkCart() {
    var cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('listCart='));

    if (cookieValue) {
        try {
            listCart = JSON.parse(cookieValue.split('=')[1]) || [];
        } catch (e) {
            listCart = [];
            console.error("Error parsing cart data:", e);
        }
    }
}
checkCart();
addCartToHTML();

// Function to display cart items in the checkout page
function addCartToHTML() {
    let listCartHTML = document.querySelector('.returnCart .list');
    listCartHTML.innerHTML = '';

    let totalQuantityHTML = document.querySelector('.totalQuantity');
    let totalPriceHTML = document.querySelector('.totalPrice');
    let totalQuantity = 0;
    let totalPrice = 0;

    if (listCart.length > 0) {
        listCart.forEach(product => {
            if (product) {
                let newCart = document.createElement('div');
                newCart.classList.add('item');
                newCart.innerHTML = `
                    <img src="${product.image}">
                    <div class="info">
                        <div class="name">${product.name}</div>
                        <div class="price">${product.price} PLN</div>
                    </div>
                    <div class="quantity">${product.quantity}</div>
                    <div class="returnPrice">${(product.price * product.quantity).toFixed(2)} PLN</div>`;
                
                listCartHTML.appendChild(newCart);

                totalQuantity += product.quantity;
                totalPrice += (product.price * product.quantity + 9.99);
            }
        });
    }

    totalQuantityHTML.innerText = totalQuantity;
    totalPriceHTML.innerText = totalPrice.toFixed(2) + ' PLN';
}

// Function to handle checkout
document.querySelector('.buttonCheckout').addEventListener('click', function() {
    if (listCart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Show success message
    alert("Checkout successful! Your order has been placed.");

    // Clear the cart
    listCart = [];
    document.cookie = "listCart=[]; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"; // Clear cookie

    // Update the UI to reflect empty cart
    addCartToHTML();
});

// Function to toggle payment fields
function togglePaymentFields() {
    const blikField = document.getElementById("blik-field");
    const cardFields = document.getElementById("card-fields");
    const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
    
    if (paymentMethod === "blik") {
        blikField.classList.remove("hidden");
        cardFields.classList.add("hidden");
    } else {
        blikField.classList.add("hidden");
        cardFields.classList.remove("hidden");
    }
}
