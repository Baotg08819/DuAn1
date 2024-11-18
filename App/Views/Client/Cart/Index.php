<?php

namespace App\Views\Client\Cart;

use App\Views\BaseView;
use App\Helpers\NotificationHelper;

class Index extends BaseView
{
    public static function render($data = null)
    {
        // var_dump($_SESSION);
?>

        <div class="container mt-5">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
            <div class="section">
                <div class="container">
                    <?php NotificationHelper::render() ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tống tiền</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $item) {
                                    $total += $item['price'] * $item['quantity'];
                            ?>
                                    <tr>
                                        <th scope="row"><?= $key ?></th>
                                        <td><img src="<?= $item['image'] ?>" alt="" style="width: 100px; height: 100px;"></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price']) ?></td>
                                        <td><?= number_format($item['price'] * $item['quantity']) ?></td>
                                        <td>
                                            <a href="/cart/remove/<?= $item['product_id'] ?>" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="6" scope="col">Tổng tiền</td>
                                <td><?= number_format($total) ?> Vnd</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


<?php

    }
}
