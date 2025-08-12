<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etsy Clone</title>
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    header {
      background-color: #f1641e;
      color: #fff;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
    }
    header nav a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
    }
    header nav button {
      background: none;
      border: none;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Homepage Styles */
    #home-page {
      display: block;
    }
    .search-bar {
      padding: 20px;
      text-align: center;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .search-bar input {
      width: 60%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .search-bar button {
      padding: 10px 20px;
      background-color: #f1641e;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .search-bar button:hover {
      background-color: #d4531a;
    }
    .cart-icon {
      font-size: 24px;
      cursor: pointer;
      position: relative;
    }
    .cart-count {
      position: absolute;
      top: -10px;
      right: -10px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .product-card {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      text-align: center;
    }
    .product-card img {
      max-width: 100%;
      border-radius: 8px;
    }
    .product-card h3 {
      margin: 10px 0;
    }
    .product-card p {
      color: #f1641e;
      font-weight: bold;
    }
    .add-to-cart-btn {
      padding: 10px;
      background-color: #f1641e;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .add-to-cart-btn:hover {
      background-color: #d4531a;
    }

    /* Post Add Page Styles */
    #post-add-page {
      display: none;
    }
    .post-add-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 400px;
      margin: 50px auto;
    }
    .post-add-container h2 {
      margin-bottom: 20px;
      text-align: center;
    }
    .post-add-container input,
    .post-add-container textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .post-add-container button {
      width: 100%;
      padding: 10px;
      background-color: #f1641e;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .post-add-container button:hover {
      background-color: #d4531a;
    }
  </style>
</head>
<body>
  <header>
    <h1>Etsy Clone</h1>
    <nav>
      <a href="#" id="home-link" onclick="showPage('home-page')">Home</a>
      <button id="logout-btn" onclick="handleLogout()">Logout</button>
    </nav>
  </header>

  <div class="container">
    <!-- Homepage -->
    <div id="home-page">
      <div class="search-bar">
        <div class="cart-icon" onclick="handleCartClick()">
          📥
          <span class="cart-count" id="cart-count">0</span>
        </div>
        <input type="text" id="search-input" placeholder="Search for handmade products...">
        <button onclick="handleSearch()">Search</button>
        <button onclick="showPage('post-add-page')">Post Add</button>
      </div>
      <div class="product-grid" id="product-grid">
        <!-- Product cards will be dynamically added here -->
      </div>
    </div>

    <!-- Post Add Page -->
    <div id="post-add-page">
      <div class="post-add-container">
        <h2>Post Add</h2>
        <input type="text" id="post-title" placeholder="Title" required>
        <textarea id="post-description" placeholder="Description" rows="4" required></textarea>
        <input type="text" id="product-name" placeholder="Product Name" required>
        <input type="number" id="product-price" placeholder="Price" required>
        <input type="file" id="product-image" accept="image/*" required>
        <button onclick="handlePostAdd()">Add Product</button>
      </div>
    </div>
  </div>

  <script>
    // Array to store products
    let products = [];

    // Array to store cart items
    let cartItems = [];

    // Function to switch between pages
    function showPage(pageId) {
      // Hide all pages
      document.getElementById('home-page').style.display = 'none';
      document.getElementById('post-add-page').style.display = 'none';

      // Show the selected page
      document.getElementById(pageId).style.display = 'block';
    }

    // Function to handle logout
    function handleLogout() {
      alert('Logged out successfully!');
      showPage('home-page');
    }

    // Function to handle post add
    function handlePostAdd() {
      const title = document.getElementById('post-title').value;
      const description = document.getElementById('post-description').value;
      const productName = document.getElementById('product-name').value;
      const price = document.getElementById('product-price').value;
      const image = document.getElementById('product-image').files[0];

      // Simple validation
      if (title && description && productName && price && image) {
        // Create a new product object
        const product = {
          title,
          description,
          productName,
          price,
          image: URL.createObjectURL(image),
        };

        // Add the product to the products array
        products.push(product);

        // Render the products
        renderProducts(products);

        // Clear the form
        document.getElementById('post-title').value = '';
        document.getElementById('post-description').value = '';
        document.getElementById('product-name').value = '';
        document.getElementById('product-price').value = '';
        document.getElementById('product-image').value = '';

        // Redirect to the homepage
        showPage('home-page');
      } else {
        alert('Please fill in all fields.');
      }
    }

    // Function to handle search
    function handleSearch() {
      const searchQuery = document.getElementById('search-input').value.toLowerCase();
      const filteredProducts = products.filter((product) =>
        product.productName.toLowerCase().includes(searchQuery) ||
        product.description.toLowerCase().includes(searchQuery)
      );
      renderProducts(filteredProducts);
    }

    // Function to render products
    function renderProducts(productsToRender) {
      const productGrid = document.getElementById('product-grid');
      productGrid.innerHTML = ''; // Clear the grid

      productsToRender.forEach((product) => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';

        // Add image
        const img = document.createElement('img');
        img.src = product.image;
        productCard.appendChild(img);

        // Add title
        const h3 = document.createElement('h3');
        h3.textContent = product.productName;
        productCard.appendChild(h3);

        // Add description
        const pDesc = document.createElement('p');
        pDesc.textContent = product.description;
        productCard.appendChild(pDesc);

        // Add price
        const pPrice = document.createElement('p');
        pPrice.textContent = `$${product.price}`;
        productCard.appendChild(pPrice);

        // Add "Add to Cart" button
        const addToCartBtn = document.createElement('button');
        addToCartBtn.className = 'add-to-cart-btn';
        addToCartBtn.textContent = 'Add to Cart';
        addToCartBtn.onclick = () => handleAddToCart(product);
        productCard.appendChild(addToCartBtn);

        // Add the product card to the grid
        productGrid.appendChild(productCard);
      });
    }

    // Function to handle "Add to Cart"
    function handleAddToCart(product) {
      cartItems.push(product);
      updateCartCount();
      alert(`${product.productName} added to cart successfully!`);
    }

    // Function to update the cart count
    function updateCartCount() {
      const cartCount = document.getElementById('cart-count');
      cartCount.textContent = cartItems.length;
    }

    // Function to handle cart icon click
    function handleCartClick() {
      alert(`You have ${cartItems.length} items in your cart.`);
    }

    // Default page to show
    showPage('home-page');
  </script>
</body>
</html>
