<?php
foreach ($products as $product): ?>
    <div class="bg-white rounded-lg shadow hover:shadow-md transition">
        <img src="<?= htmlspecialchars($product['image_path']) ?>"
            alt="<?= htmlspecialchars($product['name']) ?>"
            class="w-full h-52 object-cover rounded-t-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2"><?= htmlspecialchars($product['name']) ?></h3>
            <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($product['description']) ?></p>
            <div class="flex justify-between items-center">
                <span class="text-red-500 font-bold text-lg">₫<?= number_format($product['price'], 0, ',', '.') ?></span>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Mua ngay</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>