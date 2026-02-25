<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+63 912 345 6789',
            'address' => '123 Admin Street, La Union',
            'city' => 'San Fernando',
            'postal_code' => '2500',
            'is_active' => true,
        ]);

        // Customer
        User::create([
            'name' => 'John Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'phone' => '+63 998 765 4321',
            'address' => '456 Customer Ave, La Union',
            'city' => 'San Fernando',
            'postal_code' => '2500',
            'is_active' => true,
        ]);

        // Categories
        $bread = Category::create([
            'name' => 'Bread',
            'description' => 'Freshly baked breads and rolls',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $pastry = Category::create([
            'name' => 'Pastries',
            'description' => 'Delicious sweet and savory pastries',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $cakes = Category::create([
            'name' => 'Cakes',
            'description' => 'Celebration and specialty cakes',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $desserts = Category::create([
            'name' => 'Desserts',
            'description' => 'Sweet treats like cookies, muffins, and more',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Sample Products
        $products = [
            // Bread
            [
                'category_id' => $bread->id,
                'name' => 'Pandesal',
                'short_description' => 'Classic Filipino breakfast bread rolls',
                'description' => 'Soft, warm, and slightly sweet bread rolls perfect for breakfast or snacks.',
                'price' => 5.00,
                'stock' => 200,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/2/21/Pandesal.jpg',
            ],
            [
                'category_id' => $bread->id,
                'name' => 'Banana Bread',
                'short_description' => 'Moist banana bread loaf',
                'description' => 'Rich, moist, and full of banana flavor. Perfect with coffee or tea.',
                'price' => 120.00,
                'stock' => 50,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/4a/Banana_bread_with_sliced_bananas.jpg',
            ],
            [
                'category_id' => $bread->id,
                'name' => 'Ciabatta',
                'short_description' => 'Italian white bread with crispy crust',
                'description' => 'Crusty exterior with soft airy interior, perfect for sandwiches.',
                'price' => 150.00,
                'stock' => 30,
                'is_featured' => false,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Ciabatta_bread.jpg',
            ],

            // Pastries
            [
                'category_id' => $pastry->id,
                'name' => 'Ensaymada',
                'short_description' => 'Soft and sweet brioche pastry topped with cheese',
                'description' => 'Fluffy, buttery, and topped with sugar and cheese. A Filipino classic.',
                'price' => 35.00,
                'stock' => 100,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Ensaymada_bread.jpg',
            ],
            [
                'category_id' => $pastry->id,
                'name' => 'Chocolate Croissant',
                'short_description' => 'Flaky pastry filled with chocolate',
                'description' => 'Golden, buttery, and filled with rich chocolate. Perfect for breakfast or dessert.',
                'price' => 50.00,
                'stock' => 60,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/b/b2/Chocolate_croissant.jpg',
            ],
            [
                'category_id' => $pastry->id,
                'name' => 'Apple Turnover',
                'short_description' => 'Flaky pastry with apple filling',
                'description' => 'Delicious baked pastry with sweet apple and cinnamon filling.',
                'price' => 45.00,
                'stock' => 40,
                'is_featured' => false,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/7d/Apple_turnovers.jpg',
            ],
            [
                'category_id' => $pastry->id,
                'name' => 'Danish Pastry',
                'short_description' => 'Layered sweet pastry with fruit topping',
                'description' => 'Flaky pastry layered and topped with fruit or custard filling.',
                'price' => 60.00,
                'stock' => 55,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/9/94/Danish_pastry.jpg',
            ],

            // Cakes
            [
                'category_id' => $cakes->id,
                'name' => 'Ube Cake',
                'short_description' => 'Filipino purple yam cake',
                'description' => 'Soft and moist cake made with ube, perfect for birthdays and special occasions.',
                'price' => 750.00,
                'stock' => 20,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Ube_cake_slice.jpg',
            ],
            [
                'category_id' => $cakes->id,
                'name' => 'Chocolate Cake',
                'short_description' => 'Rich chocolate layered cake',
                'description' => 'Classic chocolate cake with chocolate frosting, perfect for celebrations.',
                'price' => 800.00,
                'stock' => 25,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Chocolate_cake_slice.jpg',
            ],
            [
                'category_id' => $cakes->id,
                'name' => 'Cheesecake',
                'short_description' => 'Creamy New York style cheesecake',
                'description' => 'Smooth, rich, and creamy cheesecake with graham cracker crust.',
                'price' => 900.00,
                'stock' => 15,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/4b/Classic_cheesecake.jpg',
            ],
            [
                'category_id' => $cakes->id,
                'name' => 'Red Velvet Cake',
                'short_description' => 'Velvety red cake with cream cheese frosting',
                'description' => 'Moist and soft red velvet cake topped with sweet cream cheese frosting.',
                'price' => 850.00,
                'stock' => 18,
                'is_featured' => false,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Red_Velvet_Cake.jpg',
            ],

            // Desserts
            [
                'category_id' => $desserts->id,
                'name' => 'Chocolate Chip Cookies',
                'short_description' => 'Crispy outside, chewy inside',
                'description' => 'Classic cookies loaded with chocolate chips. Perfect with milk or coffee.',
                'price' => 15.00,
                'stock' => 150,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Chocolate_Chip_Cookies_-_kimberlykv.jpg',
            ],
            [
                'category_id' => $desserts->id,
                'name' => 'Blueberry Muffin',
                'short_description' => 'Soft muffin packed with blueberries',
                'description' => 'Delicious and fluffy muffin filled with fresh blueberries.',
                'price' => 40.00,
                'stock' => 80,
                'is_featured' => false,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/15/Blueberry_muffin.jpg',
            ],
            [
                'category_id' => $desserts->id,
                'name' => 'Carrot Cupcake',
                'short_description' => 'Moist carrot cupcake with cream cheese frosting',
                'description' => 'Delicious carrot cupcake topped with smooth cream cheese frosting.',
                'price' => 55.00,
                'stock' => 60,
                'is_featured' => true,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/70/Carrot_cupcake.jpg',
            ],
            [
                'category_id' => $desserts->id,
                'name' => 'Macarons',
                'short_description' => 'Colorful French meringue cookies',
                'description' => 'Delicate and colorful macarons with assorted flavors.',
                'price' => 120.00,
                'stock' => 45,
                'is_featured' => false,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/ab/Macarons_colorful.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'is_active' => true,
            ]));
        }
    }
}