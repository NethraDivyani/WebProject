document.addEventListener('DOMContentLoaded', function () {
    var filterButtons = document.querySelectorAll('.filter_button button');
    var menuItems = document.querySelectorAll('.menu .itemBox');

    for (var i = 0; i < filterButtons.length; i++) {
        filterButtons[i].addEventListener('click', function () {
            // Remove active class from all filter buttons
            for (var j = 0; j < filterButtons.length; j++) {
                filterButtons[j].classList.remove('filter-active');
            }

            // Add active class to the clicked button
            this.classList.add('filter-active');

            // Get the filter name
            var filterName = this.getAttribute('data-name');

            // Filter the menu items
            for (var k = 0; k < menuItems.length; k++) {
                if (filterName === 'All_Categories' || menuItems[k].getAttribute('data-name') === filterName) {
                    menuItems[k].style.display = 'block';
                } else {
                    menuItems[k].style.display = 'none';
                }
            }
        });
    }
});

var basketItems = [];

// addToBasket function
function addToBasket(itemName, itemPrice) {
    var basketItem = {
        name: itemName,
        price: itemPrice,
    };
    basketItems.push(basketItem);
    updateBasket();

    alert(itemName + " added to the basket!");
}

// updateBasket function
function updateBasket() {
    var basketList = document.querySelector(".basket-items");
    basketList.innerHTML = "";

    var totalPrice = 0;
    basketItems.forEach(function (item) {
        var listItem = document.createElement("li");
        listItem.innerText = item.name + " - LKR " + item.price.toFixed(2);
        basketList.appendChild(listItem);
        totalPrice += item.price;
    });

    var totalPriceElement = document.querySelector(".total-price");
    totalPriceElement.innerText = "Total: LKR " + totalPrice.toFixed(2);
}

// Adding event listeners to 'Add to Basket' buttons
var addToBasketButtons = document.querySelectorAll(".add-to-basket");
addToBasketButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
        var itemName = e.target.dataset.item;
        var itemPrice = parseFloat(e.target.dataset.price);
        addToBasket(itemName, itemPrice);
    });
});
function validateForm() {
    var email = document.forms["registerForm"]["email"].value;
    var password = document.forms["registerForm"]["password"].value;
    var cpassword = document.forms["registerForm"]["cpassword"].value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!emailPattern.test(email)) {
        alert("Invalid email format. Please enter a valid email address.");
        return false;
    }

    if (password !== cpassword) {
        alert("Passwords do not match. Please ensure both fields are identical.");
        return false;
    }

    return true;
}
// cart.js

let basket = [];
let totalPrice = 0;

// Function to add items to the basket
function addToBasket(item, price) {
    basket.push({ item, price });
    totalPrice += price;
    updateBasketUI();
}

// Function to update the basket UI
function updateBasketUI() {
    const basketItemsContainer = document.querySelector('.basket-items');
    basketItemsContainer.innerHTML = ''; // Clear previous items

    basket.forEach((basketItem, index) => {
        const li = document.createElement('li');
        li.textContent = `${basketItem.item} - LKR ${basketItem.price.toFixed(2)}`;
        basketItemsContainer.appendChild(li);
    });

    // Update total price display
    document.querySelector('.total-price').textContent = `Total: LKR ${totalPrice.toFixed(2)}`;
}

// Event listener for adding items to the basket
document.querySelectorAll('.add-to-basket').forEach(button => {
    button.addEventListener('click', (event) => {
        const item = event.target.dataset.item;
        const price = parseFloat(event.target.dataset.price);
        addToBasket(item, price);
    });
});
