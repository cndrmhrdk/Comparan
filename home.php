<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blooming – Plant Shop</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --green-dark: #1a4231;
      --green-mid:  #2a5c44;
      --orange:     #e8612a;
      --cream:      #f5f0e8;
      --white:      #ffffff;
    }

    * { box-sizing: border-box; }

    body {
      background: #d0d0d0;
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ── Browser chrome wrapper ── */
    .browser-wrap {
      width: 960px;
      max-width: 100%;
      background: #e2e2e2;
      border-radius: 16px;
      box-shadow: 0 20px 60px rgba(0,0,0,.35);
      overflow: hidden;
    }

    .browser-bar {
      background: #d4d4d4;
      padding: 10px 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .dot { width: 12px; height: 12px; border-radius: 50%; }
    .dot-r { background: #ff5f56; }
    .dot-y { background: #ffbd2e; }
    .dot-g { background: #27c93f; }

    /* ── Landing Page ── */
    .landing {
      background: var(--green-dark);
      padding: 32px 48px 48px;
      position: relative;
      overflow: hidden;
    }

    /* Navbar */
    .nav-logo {
      font-family: 'DM Sans', sans-serif;
      font-weight: 700;
      font-size: 1.15rem;
      color: var(--white);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .nav-logo .icon {
      width: 32px; height: 32px;
      background: var(--orange);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 14px;
    }
    .nav-link-custom {
      color: rgba(255,255,255,.75);
      text-decoration: none;
      font-size: .9rem;
      transition: color .2s;
    }
    .nav-link-custom:hover { color: var(--white); }
    .nav-link-custom.active { color: var(--white); font-weight: 700; }

    .btn-contact {
      background: #5ec46a;
      color: var(--white);
      border: none;
      border-radius: 50px;
      padding: 8px 22px;
      font-size: .85rem;
      font-weight: 600;
      transition: background .2s;
    }
    .btn-contact:hover { background: #4aad56; }

    /* Hero */
    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.4rem, 5vw, 3.6rem);
      font-weight: 900;
      color: var(--white);
      line-height: 1.1;
    }

    .toggle-pill {
      display: inline-flex;
      align-items: center;
      background: rgba(255,255,255,.15);
      border: 2px solid rgba(255,255,255,.35);
      border-radius: 50px;
      padding: 4px 10px 4px 4px;
      gap: 8px;
      vertical-align: middle;
    }
    .toggle-dot {
      width: 28px; height: 28px;
      background: var(--orange);
      border-radius: 50%;
    }
    .toggle-arrow { color: var(--white); font-size: 1rem; }

    /* Side plant card */
    .side-plant {
      color: rgba(255,255,255,.85);
      font-size: .82rem;
      line-height: 1.5;
    }
    .side-plant img {
      width: 130px;
      filter: drop-shadow(0 8px 16px rgba(0,0,0,.4));
    }

    /* Center oval */
    .oval-wrap {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: flex-end;
    }
    .oval-bg {
      width: 280px;
      height: 340px;
      background: var(--cream);
      border-radius: 50% / 55% 55% 45% 45%;
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    .center-plant {
      position: relative;
      z-index: 2;
      width: 240px;
      filter: drop-shadow(0 12px 24px rgba(0,0,0,.3));
    }

    /* Price bubble */
    .price-bubble {
      position: absolute;
      left: -10px;
      bottom: 80px;
      z-index: 3;
      width: 90px; height: 90px;
      background: var(--green-dark);
      border: 3px solid rgba(255,255,255,.2);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: .7rem;
      font-weight: 700;
      text-align: center;
    }
    .price-bubble span { font-size: 1.1rem; }

    /* Buy Now */
    .btn-buy {
      position: absolute;
      left: -30px;
      bottom: 10px;
      z-index: 3;
      background: var(--orange);
      color: var(--white);
      border: none;
      border-radius: 50px;
      padding: 12px 26px;
      font-weight: 700;
      font-size: .9rem;
      display: flex; align-items: center; gap: 8px;
      transition: background .2s;
    }
    .btn-buy:hover { background: #cf531f; }
    .btn-buy .arrow {
      width: 26px; height: 26px;
      background: rgba(255,255,255,.25);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem;
    }

    /* Product cards */
    .plant-card {
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 14px;
      padding: 12px 14px;
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }
    .plant-card img {
      width: 56px; height: 56px;
      object-fit: contain;
      flex-shrink: 0;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,.3));
    }
    .plant-card-title {
      color: var(--white);
      font-weight: 700;
      font-size: .9rem;
      margin-bottom: 2px;
    }
    .plant-card-desc {
      color: rgba(255,255,255,.6);
      font-size: .72rem;
      margin-bottom: 4px;
    }
    .plant-card-price {
      color: var(--white);
      font-size: .78rem;
      font-weight: 600;
    }

    /* placeholder plant images via emoji/css */
    .plant-emoji {
      font-size: 2.2rem;
      width: 56px; height: 56px;
      display: flex; align-items: center; justify-content: center;
    }
  </style>
</head>
<body>

<div class="browser-wrap">

  <!-- Browser bar
  <div class="browser-bar">
    <div class="dot dot-r"></div>
    <div class="dot dot-y"></div>
    <div class="dot dot-g"></div>
  </div> -->

  <!-- Landing page -->
  <div class="landing">

    <!-- ── Navbar ── -->
    <nav class="d-flex align-items-center justify-content-between mb-5">
      <div class="nav-logo">
        <div class="icon">🌱</div>
        Blooming
      </div>
      <div class="d-flex gap-4 align-items-center">
        <a href="#" class="nav-link-custom">Plants</a>
        <a href="#" class="nav-link-custom">Shop</a>
        <a href="#" class="nav-link-custom active">Sale</a>
        <a href="#" class="nav-link-custom">Video</a>
        <a href="#" class="nav-link-custom">About</a>
      </div>
      <button class="btn-contact">Contact</button>
    </nav>

    <!-- ── Hero Row ── -->
    <div class="row align-items-end g-0">

      <!-- Left: headline + side plant -->
      <div class="col-4">
        <div class="text-center mb-3">
          <div style="font-size:3.5rem;">🪴</div>
        </div>
        <p class="side-plant text-center">Celebrate The Love In<br>Your Life With A Gift<br>That Grows On.</p>
      </div>

      <!-- Center: headline + oval plant -->
      <div class="col-4">
        <h1 class="hero-title text-center mb-4">
          Trees Are The<br>
          Lungs
          <span class="toggle-pill">
            <span class="toggle-dot"></span>
            <span class="toggle-arrow">→</span>
          </span>
          of The<br>
          World
        </h1>

        <div class="oval-wrap" style="height: 320px;">
          <div class="oval-bg"></div>
          <!-- Price bubble -->
          <div class="price-bubble">
            Price<br><span>$40</span>
          </div>
          <!-- Center plant (large emoji stand-in) -->
          <div style="position:relative;z-index:2;font-size:9rem;line-height:1;margin-bottom:-10px;">🌿</div>
          <!-- Buy Now -->
          <a href="add_product.php"><button class="btn-buy">
            Buy Now
            <span class="arrow">›</span>
          </button></a>
        </div>
      </div>

      <!-- Right: product cards -->
      <div class="col-4 ps-4">
        <div class="plant-card">
          <div class="plant-emoji">🌴</div>
          <div>
            <div class="plant-card-title">Bamboo Palm</div>
            <div class="plant-card-desc">Bamboo Palms Are The Perfect Tropical</div>
            <div class="plant-card-price">Price: <strong>$40</strong></div>
          </div>
        </div>
        <div class="plant-card">
          <div class="plant-emoji">☘️</div>
          <div>
            <div class="plant-card-title">Money Plant</div>
            <div class="plant-card-desc">Bamboo Palms Are The Perfect Tropical</div>
            <div class="plant-card-price">Price: <strong>$50</strong></div>
          </div>
        </div>
      </div>

    </div><!-- /row -->
  </div><!-- /landing -->
</div><!-- /browser-wrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>