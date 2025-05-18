<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="3;url=../pets/login/login.php"> <!-- Redirect setelah 3 detik -->
  <title>Redirecting...</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      /* Mengatur tinggi body untuk mengisi viewport */
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .loading-container {
      text-align: center;
      /* Memastikan teks berada di tengah */
    }

    .percentage {
      font-size: 48px;
      /* Ukuran font untuk persentase */
      color: #3498db;
      /* Warna untuk persentase */
    }
  </style>
</head>

<body>
  <div class="loading-container">
    <div class="percentage">0%</div>
    <div class="message">Anda sedang diarahkan ke halaman login...</div>
  </div>

  <script>
    let percentage = 0;
    const percentageElement = document.querySelector('.percentage');
    const redirectUrl = '../pets/login/login.php';
    const intervalTime = 10; // Interval waktu dalam milidetik
    const totalTime = 1000; // Total waktu redirect dalam milidetik

    const interval = setInterval(() => {
      percentage += (100 / (totalTime / intervalTime));
      percentageElement.textContent = Math.round(percentage) + '%';

      if (percentage >= 100) {
        clearInterval(interval);
        window.location.href = redirectUrl; // Redirect ke halaman login
      }
    }, intervalTime);
  </script>
</body>

</html>