<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
    <div class="checkoutLayout">
        
        <div class="returnCart">
            <a href="index.html">Keep Shopping</a>
            <h1>List Product in Cart</h1>
            <div class="list">
                <div class="item">
                    <img src="/images/Absolut vodka.png">
                    <div class="info">
                        <div class="name">Absolut vodka</div>
                        <div class="price">59.99zl</div>
                    </div>
                    <div class="quantity">5</div>
                    <div class="returnPrice">500zl</div>
                </div>
            </div>
        </div>

        <div class="right">
            <h1>Checkout</h1>

            <div class="form">
                <div class="group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name">
                </div>
    
                <div class="group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone">
                </div>
    
                <div class="group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                </div>
    
                <div class="group">
                    <label for="country">Country</label>
                    <select name="country" id="country">
                        <option value="">Choose..</option>
                        <option value="Poland">Poland</option>
                    </select>
                </div>
    
                <div class="group">
                    <label for="city">City</label>
                    <select name="city" id="city">
                        <option value="">Choose..</option>
                        <option value="Rzeszow">Rzeszow</option>
                        <option value="Lublin">Lublin</option>
                        <option value="Warsaw">Warsaw</option>
                    </select>
                </div>
            </div>

            <!-- Payment Method Selection -->
            <div class="payment-method">
                <h2>Payment Method</h2>
                <label><input type="radio" name="payment" value="blik" onclick="togglePaymentFields()"> Blik</label>
                <label><input type="radio" name="payment" value="card" onclick="togglePaymentFields()"> Card</label>
            </div>

            <!-- Blik Code Input -->
            <div id="blik-field" class="hidden">
                <label for="blik-code">Enter Blik Code:</label>
                <input type="text" id="blik-code" maxlength="5" placeholder="12345">
            </div>

            <!-- Card Details Input -->
            <div id="card-fields" class="hidden">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" placeholder="**** **** **** ****">
                
                <label for="expiry">Expiration Date</label>
                <input type="text" id="expiry" placeholder="MM/YY">
                
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" placeholder="123">
            </div>

            <div class="return">
                <div class="row">
                    <div>Total Quantity</div>
                    <div class="totalQuantity">0</div>
                </div>
                <div class="row">
                    <div>Total Price</div>
                    <div class="totalPrice">0zl</div>
                </div>
            </div>
            <button class="buttonCheckout">CHECKOUT</button>
        </div>
    </div>
</div>
<script>
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
    </script>

<script src="checkout.js"></script>
</body>
</html>