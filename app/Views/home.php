<div class="relative w-full overflow-hidden shadow-lg">
    <div id="sliderTrack" class="flex">
        <img src="./img/sliders/slide1-pc.jpg" alt="Slide 1" class="min-w-full shrink-0" />
        <img src="./img/sliders/slide2-pc.jpg" alt="Slide 2" class="min-w-full shrink-0" />
        <img src="./img/sliders/slide3-pc.jpg" alt="Slide 3" class="min-w-full shrink-0" />
        <img src="./img/sliders/slide4-pc.jpg" alt="Slide 4" class="min-w-full shrink-0" />
    </div>

    <!-- Navigation arrows -->
    <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 text-black px-3 py-2 rounded-full shadow">
        &#10094;
    </button>
    <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 text-black px-3 py-2 rounded-full shadow">
        &#10095;
    </button>
</div>

<section class="py-10 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-8">Sản phẩm nổi bật</h2>
        <!-- Phần hiển thị sản phẩm -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php include __DIR__ . './partials/product_cart.php'; ?>
        </div>
    </div>
</section>

</body>

</html>