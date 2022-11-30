//get stock from db
var myArr;
var req = new XMLHttpRequest(); //new request
req.onload = function() {
    myArr = JSON.parse(this.responseText);
};
req.open("get", "handler/getStock.php", true);
req.send();

//global vars
let total = 0.00;
let cart = [];

function addToCart(name) {
    console.log("Add to Cart Called!");
    //init product
    var product;
    //find product by name
    myArr.forEach(item => {
        if(item.Name === name) {
            product = item;
        }
    })

    //find product in cart
    var exists = false;
    cart.forEach(item => {
        //if in cart, increment
        if(item.prod.Name == product.Name) {
            if(item.count < item.prod.Stock) {
                item.count++;
            }
            exists = true;
        }
    })
    //if not in cart, create new obj and add to cart
    if(!exists) {
        //product.Name = product.Name.replace(/\s/g, "");
        let temp = {prod: product, count: 1};
        cart.push(temp);
    }
    //render
    renderCart(cart);
}

//save cart on window exit
window.onbeforeunload = function(){
    postCart(cart);
}

//restore cart on page load
window.onload = function() {
    getCart();
}

//set cart to saved cart
function setCart(obj) {
    console.log("Set Cart Called!");
    cart = JSON.parse(obj);
    total = 0;

    document.getElementById("items").innerHTML = null;

    cart.forEach(item => {
        total += item.count * item.prod.Price;
        renderObject(item.prod, item.count);
    })
    document.getElementById("cartTotalText").innerHTML = "$"+total.toFixed(2);

    console.log(cart);

    document.getElementById("checkoutbtn").style.visibility = "hidden";
    document.getElementById("cart").style.visibility = "hidden";
    document.getElementById("dropdownmenu").style.visibility = "hidden";
}

function postCart(cart) {
    console.log("Post Cart Called!");
    var req = new XMLHttpRequest(); //new request
    req.open("POST", "handler/postCart.php", true); //sending as POST
    req.send(JSON.stringify(cart)); //send cart
}

function getCart() {
    console.log("Get Cart Called!");
    var req = new XMLHttpRequest(); //new request
    req.onload = function() {
        setCart(this.responseText); //set cart to saved cart
    };
    req.open("get", "handler/getCart.php", true); //send as GET
    req.send(); //send req
}

function renderCart(cart) {
    total = 0;
    document.getElementById("items").innerHTML = null;
    cart.forEach(item => {
        total += item.count * item.prod.Price;
        renderObject(item.prod, item.count);
    })
    document.getElementById("cartTotalText").innerHTML = "$"+total.toFixed(2);

    console.log(cart);

    if(cart.length > 0) {
        document.getElementById("checkoutbtn").style.visibility = "visible";
    }
    else {
        document.getElementById("checkoutbtn").style.visibility = "hidden";
        document.getElementById("cart").style.visibility = "hidden";
    }
}

function renderObject(product, count) {
    console.log("Render Object Called!")
    var productTotal = product.Price * count;
    productTotal = productTotal.toFixed(2)
    var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
    var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 0;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
    var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+productTotal+'</p><div class="addsubButton"><button class="addButton" onclick="decrement('+product.Name.replace(/\s/g, "_")+')">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment('+product.Name.replace(/\s/g, "_")+')">+</button></div><button class="removeCart" onclick="removeFromCart('+product.Name.replace(/\s/g, "_")+')">Remove</button></div>'
    var element = '<div class="cartItemContainer" id='+product.Name.replace(/\s/g, "_")+'>'+image + description + rightSide+'</div>';
    document.getElementById("items").innerHTML = document.getElementById("items").innerHTML +  element;
    var cartDisplay = document.getElementById("cart");
    if (cartDisplay.style.visibility === "hidden") {
        cartDisplay.style.visibility = "visible";
    }
}

function showCart() {
    var length = cart.length;
    var cartDisplay = document.getElementById("cart");
    var checkout = document.getElementById("checkoutbtn");
    var dropdownmenu = document.getElementById("dropdownmenu");

    if (cartDisplay.style.visibility === "hidden") {
        if(dropdownmenu.style.visibility === "visible") {
            dropdownmenu.style.visibility = "hidden";
        }
        cartDisplay.style.visibility = "visible";
    } else {
        cartDisplay.style.visibility = "hidden";
    }
    if (checkout.style.visibility === "hidden" && length > 0) {
        if(dropdownmenu.style.visibility === "visible") {
            dropdownmenu.style.visibility = "hidden";
        }
        checkout.style.visibility = "visible";
    } else {
        checkout.style.visibility = "hidden";
    }
}

function removeFromCart(name){
    console.log("Remove Called!");
    //get item name from html
    try{
        name = name.item(0).id;
    } catch {
        name = name.id;
    }
    //for products with whitespace
    name = name.replace(/_/g, " ");
    //init product
    var product;
    //find product by name
    myArr.forEach(item => {
        if(item.Name === name) {
            product = item;
        }
    })

    //find in cart
    cart.forEach(item => {
        if(item.prod.Name == product.Name) {
            //remove
            var index = cart.indexOf(item);
            cart.splice(index, 1);
            console.log('removed: ' + item.prod.Name);
        }
    })
    //render
    renderCart(cart);
}

function increment(name){
    console.log("Increment Called!");
    //get name from html
    try{
        name = name.item(0).id;
    } catch {
        name = name.id;
    }
    //for products with whitespace
    name = name.replace(/_/g, " ");
    //init product
    var product;
    myArr.forEach(item => {
        if(item.Name === name) {
            product = item;
        }
    })

    //find in cart
    cart.forEach(item => {
        if(item.prod.Name == product.Name) {
            //increment
            if(item.count < item.prod.Stock) {
                item.count++;
            }
        }
    })
    //render
    renderCart(cart);
}

function decrement(name){
    console.log("Decrement Cart Called!");
    try{
        nameID = name.item(0).id;
    } catch {
        nameID = name.id;
    }
    //for products with whitespace
    nameID = nameID.replace(/_/g, " ");
    //init product
    var product;
    myArr.forEach(item => {
        if(item.Name === nameID) {
            product = item;
        }
    })

    //find in cart
    cart.forEach(item => {
        if(item.prod.Name == product.Name) {
            //decrement
            item.count--;
            //if count is now 0, remove
            if(item.count == 0) {
                var index = cart.indexOf(item);
                cart.splice(index, 1);
            }
        }
    })
    renderCart(cart);
}

function checkOut() {
    location.href = "checkout.php";
}

function dropDown() {
    var dropdownmenu = document.getElementById('dropdownmenu');
    var cartDisplay = document.getElementById('cart');
    var checkout = document.getElementById("checkoutbtn");
    if (dropdownmenu.style.visibility === "hidden") {
        if(cartDisplay.style.visibility === "visible") {
            cartDisplay.style.visibility = "hidden";
        }
        if(checkout.style.visibility === "visible") {
            checkout.style.visibility = "hidden";
        }
        dropdownmenu.style.visibility = "visible";
    } else {
        dropdownmenu.style.visibility = "hidden";
    }
}