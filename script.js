function searchProducts() {
    const query = document.getElementById("search-input").value;
    if (query) {
        alert(`Searching for: ${query}`);
        // Backend logic for searching can be added here
    } else {
        alert("Please enter a search term!");
    }
}

const quoteSection = document.querySelector('.quote-section');
const quotes = [
  { text: "Shop wisely, live happily.", author: "" },
  { text: "Shopping is therapy.", author: "" },
  // Add more quotes here
];

function loadQuote() {
  const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
  quoteSection.innerHTML = `
    <p>"${randomQuote.text}"</p>
    <p>Discover your favorite products below:</p>
  `;
}

loadQuote();

document.addEventListener("DOMContentLoaded", () => {
    const productGrid = document.getElementById("product-grid");

    // Fetch products from backend
    fetch('backend/fetch-products.php')
        .then(response => response.json())
        .then(products => {
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" width="100">
                    <h3>${product.name}</h3>
                    <p>${product.price}</p>
                    <button onclick="addToCart(${product.id})">Add to Cart</button>
                `;
                productGrid.appendChild(productCard);
            });
        });

    // Add to cart functionality
    window.addToCart = function(productId) {
        fetch('backend/add-to-cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ productId })
        }).then(() => alert('Product added to cart!'));
    };
});
