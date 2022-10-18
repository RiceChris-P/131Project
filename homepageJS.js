
function createSuggestedItemNode() {
    document.getElementById("suggestedItemContainer").innerHTML += ('<div class="suggestedItem"> <img src="banana.png" alt="banana" class="productImage"> <button class="cartButton">Add to cart</button></div>' )
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
