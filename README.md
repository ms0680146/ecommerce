#  Ecommerce
這是一個電子商務展示網站，呈現以下功能: 商品展示、結帳、搜尋功能，購物車系統，會員系統。
****
## Techniques
* 01 Use Laradock to build Docker development environment. 
* 02 php version 7.2
* 03 laravel version 5.8
* 04 mysql
* 05 Elasticsearch 6.6
* 06 Google Login Api
* 07 Environment setup: <br>
https://medium.com/@ms0680146/docker%E5%BB%BA%E7%BD%AElaravel%E7%92%B0%E5%A2%83-windows-636460c2ecb7

## Functions
* 01 <strong>商品功能</strong>:    商品展示，Cookie紀錄瀏覽過的商品，關聯商品及類別，商品分頁，提供價格排序。 <br>
* 02 <strong>購物車功能</strong>:     購物車商品移除及新增，Ajax實作購物車商品數量的增加，購物車稍後購買。 <br>
* 03 <strong>結帳功能</strong>:     商品折扣碼使用，結帳資料寫入mysql，查看個人結帳清單。<br>
* 04 <strong>會員功能</strong>:     註冊及登入，修改更新個的人會員資料，提供Google Oauth2登入。<br>
* 05 <strong>搜尋功能</strong>:    採用Elasticsearch做引擎，laravel scout做全文索引。<br>
* 06 <strong>測試feature test</strong>:    以Laravel內建支援的PHPUnit撰寫頁面測試。

## Packages
* 01 <a href="https://github.com/hardevine/LaravelShoppingcart">hardevine/LaravelShoppingcart</a>
* 02 <a href="https://github.com/babenkoivan/scout-elasticsearch-driver">babenkoivan/scout-elasticsearch-driver</a>
* 03 <a href="https://github.com/laravel/socialite">laravel/socialite</a>


## Results

