$(document).ready(function () {
    // Slider
    let currentSlide = 0;
    const slides = $(".slides img");
    slides.eq(currentSlide).addClass("active");

    setInterval(() => {
        slides.eq(currentSlide).removeClass("active");
        currentSlide = (currentSlide + 1) % slides.length;
        slides.eq(currentSlide).addClass("active");
    }, 3000);

    // Fetch Products (Simulating AJAX)
    const products = [
        { id: 1, name: "محصول ۱", image: "product1.jpg", category: "electronics" },
        { id: 2, name: "محصول ۲", image: "product2.jpg", category: "fashion" },
        { id: 3, name: "محصول ۳", image: "product3.jpg", category: "books" },
        { id: 4, name: "محصول ۴", image: "product4.jpg", category: "electronics" },
    ];

    function renderProducts(filter = "all") {
        $("#products").empty();
        const filteredProducts = products.filter(
            (p) => filter === "all" || p.category === filter
        );
        filteredProducts.forEach((product) => {
            $("#products").append(`
                <div class="product">
                    <img src="${product.image}" alt="${product.name}">
                    <p>${product.name}</p>
                </div>
            `);
        });
    }

    renderProducts();

    // Apply Filter
    $("#apply-filter").click(() => {
        const selectedCategory = $("#filter-category").val();
        renderProducts(selectedCategory);
    });

    // Search Functionality
    $("#search-button").click(() => {
        const query = $("#search-input").val().toLowerCase();
        $("#products").empty();
        products
            .filter((p) => p.name.toLowerCase().includes(query))
            .forEach((product) => {
                $("#products").append(`
                    <div class="product">
                        <img src="${product.image}" alt="${product.name}">
                        <p>${product.name}</p>
                    </div>
                `);
            });
    });
});
