document.addEventListener("DOMContentLoaded", () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-id');
            addToCart(productId);
        });
    });

    function addToCart(productId) {
        // Here you would typically make an AJAX request to add the product to the cart.
        console.log(`Product ${productId} added to cart!`);
        alert(`Product ${productId} added to cart!`);
    }
});
