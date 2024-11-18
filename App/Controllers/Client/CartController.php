<?php 

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Cart\Index;


class CartController
{
    public function index()
    {
        Header::render();
        Index::render();
        Footer::render();
    }

    public function add()
    {
        $data = $_POST;
        $product_id = $data['product_id'];

        //nếu có 1 sản phẩm đó trong giỏ hàng rồi thì tăng số lượng lên
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
            NotificationHelper::set('success', 'Thêm sản phẩm vào giỏ hàng thành công');
            header('Location: /cart');
            return;
        }

        $cart = $_SESSION['cart'] ?? [];

        $cart[$product_id] = [
            'product_id' => $data['product_id'],
            'name' => $data['name'],
            'image' => $data['image'],
            'quantity' => 1,
            'price' => $data['price']
        ];

        $_SESSION['cart'] = $cart;
        NotificationHelper::set('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        header('Location: /cart');
    }

    public function remove($id)
    {
        $data = $_POST;
        $cart = $_SESSION['cart'] ?? [];
        unset($cart[$id]);
        $_SESSION['cart'] = $cart;
        NotificationHelper::set('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        header('Location: /cart');
    }

}

