<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ECONNECT</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>ECONNECT</h1>
      <h2>Hello</h2>
    </div>

    <div class="navbar">
      <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Katalog</a></li>
        <li><a href="#">Favorit</a></li>
        <li><a href="#">Keranjang</a></li>
        <li><a href="#">Riwayat Pemesanan</a></li>
      </ul>

      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
      </div>

      <div class="cart-icon">
        <a href="#"><img src="{{ asset('images/cart.png') }}" alt="Cart"></a>
      </div>

      <div class="user-icon">
        <a href="#"><img src="{{ asset('images/user.png') }}" alt="User"></a>
      </div>
    </div>
  </div>

  <div class="hero">
    <h1>Rethink</h1>
    <h1>Reuse</h1>
    <h1>Reconnect</h1>
  </div>

  <div class="content">
    <!-- Kategori Unggulan -->
    <div class="section">
      <h2>Kategori Unggulan</h2>
      <p>Temukan barang-barang daur ulang dari berbagai jenis limbah. Siap jadi solusi kreatif dan ramah lingkungan!</p>
      <button>Lihat selengkapnya</button>

      <div class="categories">
        <div class="category">
          <img src="images/Product Image.png" alt="Limbah Plastik">
          <h3>Limbah Plastik</h3>
        </div>
        <div class="category">
          <img src="images/Product Image (1).png" alt="Limbah Kayu">
          <h3>Limbah Kayu</h3>
        </div>
        <div class="category">
          <img src="images/Product Image (2).png" alt="Limbah Kain dan Tekstil">
          <h3>Limbah Kain dan Tekstil</h3>
        </div>
      </div>
    </div>

    <!-- Pilihan Favorit -->
    <div class="section">
      <h2>Pilihan Favorit</h2>
      <p>Produk terpopuler yang paling banyak dicari. Limbah berkualitas yang sudah terbukti bernilai!</p>
      <button>Lihat selengkapnya</button>

      <div class="favorites">
        <div class="favorite-item">
          <img src="images/tekstil.png" alt="Limbah Kulit Sintetis">
          <h3>Limbah Kulit Sintetis</h3>
          <p>Rp.28.000 / 1m</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleLeather</p>
              <img src="" alt="">
            </div>
            <div class="rating-info">
              <p>4.8 (100+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="images/Product Image (3).png" alt="Botol Kaca Bekas">
          <h3>Botol Kaca Bekas</h3>
          <p>Rp.7.500 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleGlass</p>
              <img src="#" alt="">
            </div>
            <div class="rating-info">
              <p>4.5 (50+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="images/Product Image (4).png" alt="Sisa Mozaik Keramik">
          <h3>Sisa Mozaik Keramik</h3>
          <p>Rp.20.000 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleCeramics</p>
              <img src="#" alt="">
            </div>
            <div class="rating-info">
              <p>4.9 (200+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk Terbaru -->
    <div class="section">
      <h2>Produk Terbaru</h2>
      <p>Koleksi terbaru dari limbah pilihan. Temukan potensi dalam limbah terkini!</p>
      <button>Lihat selengkapnya</button>

      <div class="favorites">
        <div class="favorite-item">
          <img src="images/tembaga.png" alt="Kabel Tembaga Bekas">
          <h3>Kabel Tembaga Bekas</h3>
          <p>Rp.28.000 / 1m</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleLeather</p>
              <img src="#" alt="">
            </div>
            <div class="rating-info">
              <p>4.8 (100+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="images/Product Image (5).png" alt="Botol Kaca Bekas">
          <h3>Kain Linen Campuran</h3>
          <p>Rp.7.500 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleGlass</p>
              <img src="#" alt="">
            </div>
            <div class="rating-info">
              <p>4.5 (50+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="images/Product Image (6).png" alt="Sisa Mozaik Keramik">
          <h3>Tutup Kaleng Logam Bekas</h3>
          <p>Rp.20.000 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleCeramics</p>
              <img src="#" alt="">
            </div>
            <div class="rating-info">
              <p>4.9 (200+)</p>
              <img src="#" alt="">
            </div>
          </div>
        </div>

        
      </div>
    </div>

    <footer>
      <hr>
      <div class="footer-content">
        <div class="footer-left">
          <h1>Daftar untuk Info Terbaru</h1>
          <p>Jadilah yang pertama tahu tentang produk baru dan penawaran spesial.</p>
        </div>
        <div class="footer-right">
          <div class="about_us">
            <p class="about_us_title">Tentang Kami</p>
            <ul class="about_us_list"> 
              <li><a href="#">Cerita Kami</a></li>
              <li><a href="#">Misi & Visi</a></li>
              <li><a href="#">Prinsip Keberlanjutan</a></li>
              <li><a href="#">Partner & Komunitas</a></li>
              <li><a href="#">Testimoni</a></li>
              <li><a href="#">Media & Publikasi</a></li>
            </ul>
          </div>
          
          <div class="bantuan">
            <p class="batuan_title">Bantuan</p>
            <ul class="bantuan_list">
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Cara Belanja</a></li>
              <li><a href="#">Cara Pengiriman</a></li>
              <li><a href="#">Kebijakan Pengembalian</a></li>
              <li><a href="#">Ketentuan Layanan</a></li>
              <li><a href="#">Hubungi Kami</a></li>
            </ul>
          </div>
        </div>
    </footer>
  </div>
</body>
</html>
