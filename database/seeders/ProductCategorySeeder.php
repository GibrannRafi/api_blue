<?php

namespace Database\Seeders;

use App\Helper\ImageHelper\ImageHelper;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'tagline' => 'Temukan berbagai produk elektronik terbaik',
                'description' => 'Kategori Produk Elektronik seperti smarphone, laptop, dan gadget lainnya',
                'childrens' => [
                    [
                        'name' => 'Smarphone',
                        'tagline' => 'Smartphone Terbaru dengan teknologi canggih',
                        'description' => 'Berbagai merek smarphone tercanggih terbaru dengan spesifikasi tinggi '
                    ],
                    [
                        'name' => 'Laptop',
                        'tagline' => 'Laptop untuk produktivitas maksimal',
                        'description' => 'Koleksi laptop untuk gaming, kerja, ngoding '
                    ],
                    [
                        'name' => 'Aksesoris Gadget',
                        'tagline' => 'Lengkapi Gadget Anda dengan aksesoris terbaik',
                        'description' => 'Berbagai aksesoris untuk smarphone dan laptop '
                    ],
                ],
            ],
            [
                'name' => 'Fashion',
                'tagline' => 'Temukan gaya fashion terbaik anda ',
                'description' => 'Kategori fashion untuk pria dan wanita ',
                'childrens' => [
                    [
                        'name' => 'Pakaian Pria',
                        'tagline' => 'Koleksi pakaian pria terkini',
                        'description' => 'Berbagai pakaian pria untuk berbagai kesempatan '
                    ],
                    [
                        'name' => 'Pakaian Wanita',
                        'tagline' => 'Koleksi pakaian wanita terkini',
                        'description' => 'Berbagai pakaian wanita untuk berbagai kesempatan '
                    ],

                ],
            ],
            [
                'name' => 'Kesehatan dan Kecantikan',
                'tagline' => 'Produk kesehatan dan kecantikan terbaik ',
                'description' => 'Kategori Produk Kesehatan dan Kecantikan ',
                'childrens' => [
                    [
                        'name' => 'Skincare',
                        'tagline' => 'Produk Perawatan kulit terbaik',
                        'description' => 'Berbagai produk perawatan kulit untuk wajah dan tubuh '
                    ],
                    [
                        'name' => 'Suplemen',
                        'tagline' => 'Produk Suplemen kesehatan berkualitas',
                        'description' => 'Berbagai suplemen untuk menjaga kesehatan tubuh '
                    ],

                ],
            ],
        ];

        $imageHelper = new ImageHelper;

        foreach ($categories as $category) {
            $parent = ProductCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'tagline' => $category['tagline'],
                'description' => $category['description'],
                'image' => $imageHelper->storeAndResizeImage(
                    $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                    'product-category',
                    250,
                    250
                ),
                'parent_id' => null,

            ]);

            foreach ($category['childrens'] as $child) {
                ProductCategory::create([
                    'name' => $child['name'],
                    'slug' => Str::slug($child['name']),
                    'tagline' => $child['tagline'],
                    'description' => $child['description'],
                    'image' => $imageHelper->storeAndResizeImage(
                        $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                        'product-category',
                        250,
                        250
                    ),
                    'parent_id' => $parent->id,

                ]);
            }
        }
    }
}
