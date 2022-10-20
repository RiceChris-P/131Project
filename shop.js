
function createSuggestedItemNode() {
    document.getElementById("suggestedItemContainer").innerHTML += ('<div class="suggestedItem"> <img src="itemImages/banana.png" alt="banana" class="productImage"> <p class="itemName">Bananas</p> <button class="cartButton">Add to cart</button></div>' )
}

window.onload = function() {
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
    createSuggestedItemNode();
}
