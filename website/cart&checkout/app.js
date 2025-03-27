let iconCart = document.querySelector('.iconCart');
let cart = document.querySelector('.cart');
let container = document.querySelector('.container');
let close = document.querySelector('.close');

iconCart.addEventListener('click', function(){
    if(cart.style.right == '-100%'){
        cart.style.right = '0';
        container.style.transform = 'translateX(-400px)';
    }else{
        cart.style.right = '-100%';
        container.style.transform = 'translateX(0)';
    }
});
close.addEventListener('click', function (){
    cart.style.right = '-100%';
    container.style.transform = 'translateX(0)';
});

// Define products directly in script
let products = [
    { id: 1, name: "Absolut Vodka", price: 59.99, image: "./cart&checkout/images/Absolut vodka.png" },
    { id: 2, name: "Jack Daniels", price: 79.99, image: "./cart&checkout/images/jd.png" }
];

addDataToHTML();

// Show products in the list
function addDataToHTML(){
    let listProductHTML = document.querySelector('.listProduct');
    listProductHTML.innerHTML = '';

    products.forEach(product => {
        let newProduct = document.createElement('div');
        newProduct.classList.add('item');
        newProduct.innerHTML = 
        `<img src="${product.image}" alt="">
        <h2>${product.name}</h2>
        <div class="price">${product.price}zl</div>
        <button onclick="addCart(${product.id})">Add To Cart</button>`;

        listProductHTML.appendChild(newProduct);
    });
}

// Use cookies so the cart doesn't get lost on page refresh
let listCart = [];
function checkCart(){
    var cookieValue = document.cookie.split('; ').find(row => row.startsWith('listCart='));
    if(cookieValue){
        listCart = JSON.parse(cookieValue.split('=')[1]);
    }
}
checkCart();

function addCart(idProduct){
    let product = products.find(p => p.id === idProduct);
    let cartItem = listCart.find(item => item.id === idProduct);
    
    if(cartItem){
        cartItem.quantity++;
    } else {
        listCart.push({...product, quantity: 1});
    }
    
    document.cookie = "listCart=" + JSON.stringify(listCart) + "; expires=Thu, 31 Dec 2025 23:59:59 UTC; path=/;";
    addCartToHTML();
}

addCartToHTML();

function addCartToHTML(){
    let listCartHTML = document.querySelector('.listCart');
    listCartHTML.innerHTML = '';
    let totalHTML = document.querySelector('.totalQuantity');
    let totalQuantity = 0;

    listCart.forEach(product => {
        if(product){
            let newCart = document.createElement('div');
            newCart.classList.add('item');
            newCart.innerHTML = 
                `<img src="${product.image}">
                <div class="content">
                    <div class="name">${product.name}</div>
                    <div class="price">${product.price}zl</div>
                </div>
                <div class="quantity">
                    <button onclick="changeQuantity(${product.id}, '-')">-</button>
                    <span class="value">${product.quantity}</span>
                    <button onclick="changeQuantity(${product.id}, '+')">+</button>
                </div>`;

            listCartHTML.appendChild(newCart);
            totalQuantity += product.quantity;
        }
    });
    totalHTML.innerText = totalQuantity;
}

function changeQuantity(idProduct, type){
    let cartItem = listCart.find(item => item.id === idProduct);
    if(!cartItem) return;

    if(type === '+') cartItem.quantity++;
    if(type === '-' && cartItem.quantity > 1) cartItem.quantity--;
    else if(type === '-' && cartItem.quantity === 1) {
        listCart = listCart.filter(item => item.id !== idProduct);
    }

    document.cookie = "listCart=" + JSON.stringify(listCart) + "; expires=Thu, 31 Dec 2025 23:59:59 UTC; path=/;";
    addCartToHTML();
}
