<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - PrimeLearn</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    header {
      background-color: #0d213f;
      padding: 20px 60px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .menu {
      display: flex;
      gap: 40px;
    }
    .menu a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 20px;
    }
    .menu .active {
      background-color: #4f688a;
    }
    .container {
      display: flex;
      gap: 40px;
      padding: 40px 60px;
    }
    .visi-section {
      width: 65%;
      background: url('https://images.pexels.com/photos/3182781/pexels-photo-3182781.jpeg') no-repeat center/cover;
      border-radius: 20px;
      padding: 30px;
      color: white;
      position: relative;
      height: 430px;
    }
    .visi-box {
      background-color: rgba(0, 0, 0, 0.5);
      position: absolute;
      bottom: 0;
      left: 0;
      padding: 25px;
      border-radius: 0 0 20px 20px;
    }
    .title-btn {
      background: #3ac4cd;
      display: inline-block;
      padding: 8px 18px;
      border-radius: 20px;
      margin-bottom: 15px;
      font-weight: bold;
    }
    .team-section {
      width: 35%;
    }
    .team-title {
      background: #0d213f;
      height: 14px;
      margin-bottom: 20px;
      border-radius: 4px;
      width: 60%;
    }
    .team-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .team-card {
      text-align: center;
    }
    .photo {
      width: 100%;
      height: 120px;
      background: #bfbaba;
      border-radius: 8px;
    }
    .name {
      margin-top: 8px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    <h2>LOGO</h2>
    <div class="menu">
      <a href="#">HOME</a>
      <a class="active" href="#">ABOUT US</a>
      <a href="#">FAQ</a>
    </div>
    <div style="font-size:28px;">≡</div>
  </header>

  <div class="container">
    <div class="visi-section">
      <div class="visi-box">
        <div class="title-btn">Visi & Misi Kami</div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
          et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat.
        </p>
      </div>
    </div>

    <div class="team-section">
      <div><strong>Tim Kami</strong></div>
      <div class="team-title"></div>
      <div class="team-grid">
        <div class="team-card"><div class="photo"></div><div class="name">Mas Heri</div></div>
        <div class="team-card"><div class="photo"></div><div class="name">William</div></div>
        <div class="team-card"><div class="photo"></div><div class="name">Dinda Dev</div></div>
        <div class="team-card"><div class="photo"></div><div class="name">Yasa</div></div>
        <div class="team-card" style="grid-column: span 2; width:50%; margin:auto;"><div class="photo"></div><div class="name">Ananda</div></div>
      </div>
    </div>
  </div>
</body>
</html>
