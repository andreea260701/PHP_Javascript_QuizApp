<?php
// Include fișierul de conectare
include 'connect.php';
global $conn;?>



<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>QuizGame</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/poza.png" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.php">Vechiu Andreea</a></h1>
          <p class="text-center text-light">Founder of this QuizGameApplication</p>

      </div>
        <style>
            body {
                background-color: #f8f9fa;
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            #questionContainer {
                display: none;
                background-color: #ffffff;
                border-radius: 10px;
                padding: 20px;
                margin: 20px auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 600px;
            }

            form {
                margin-top: 20px;
            }

            label {
                display: block;
                margin-bottom: 10px;
            }

            button {
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            #result {
                margin-top: 10px;
                font-weight: bold;
            }

            #resultContainer {
                text-align: center;
                margin-top: 20px;
            }
        </style>
      <nav id="navbar" class="nav-menu navbar">

          <?php
          if (!isset($_SESSION['username'])) {
              echo "<a class='nav-link nav-item active' href='register.php'>Register</a>";
              echo "<a class='nav-link nav-item active' href='login.php'>Welcome Guest</a>";
              echo "<a class='nav-link nav-item active' href='login.php'>Login</a>";
          } else {
              echo "<a class='nav-link nav-item active' href='#'>Welcome " . $_SESSION['username'] . "</a>";
              echo "<a class='nav-link nav-item active' href='logout.php'>Logout</a>";

              // Adaugă condiția pentru a afișa link-ul pentru utilizatorii cu drepturi de "admin"
              if (isset($_SESSION['status'])) {
                  if ($_SESSION['status'] === "admin") {
                      echo "<a class='nav-link nav-item active' href='quizform.php'>Admin Quiz Form</a>";
                      echo "<a class='nav-link nav-item active' href='register_admin.php'>Register Admin</a>";
                  }
              }
          }
          ?>



      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1>Vechiu Andreea</h1>
      <p>"I'm a <span class="typed" data-typed-items="Student, Developer, BookLover"></span></p>
        <p >Scroll down for Quiz Game</p>
    </div>
  </section><!-- End Hero -->

  <main id="main" >

      <h1>Quiz Game</h1>
      <button class="m-lg-5" id="nextButton" onclick="getNextQuestion()">First question</button>
      <div id="questionContainer"></div>
      <div id="resultContainer"></div>

      <script>
          var resultContainer = document.getElementById('resultContainer');
          var correctCount = 0;
          var totalQuestions = 0;
          var questions = [];

          function getQuestions() {
              $.ajax({
                  url: 'get_questions.php',
                  type: 'GET',
                  dataType: 'json',
                  success: function (data) {
                      questions = data;
                      console.log(questions);
                  },
                  error: function (error) {
                      console.error('Eroare la obținerea întrebărilor: ', error);
                  }
              });
          }

          function getRandomQuestion() {
              if (questions.length === 0) {
                  console.log('Toate întrebările au fost răspunse.');
                  return null;
              }

              var randomIndex = Math.floor(Math.random() * questions.length);
              var randomQuestion = questions[randomIndex];
              questions.splice(randomIndex, 1);

              return randomQuestion;
          }

          function shuffleArray(array) {
              for (let i = array.length - 1; i > 0; i--) {
                  const j = Math.floor(Math.random() * (i + 1));
                  [array[i], array[j]] = [array[j], array[i]];
              }
          }

          function displayQuestion(question) {
              var questionContainer = document.getElementById('questionContainer');

              // Creează o listă cu toate opțiunile, inclusiv răspunsul corect
              var allChoices = Object.keys(question)
                  .filter(key => key.startsWith('choice'))
                  .map(key => question[key]);

              // Adaugă răspunsul corect la listă
              allChoices.push(question.correct_answer);

              // Amestecă opțiunile, astfel încât răspunsul corect să fie într-o poziție aleatoare
              shuffleArray(allChoices);

              questionContainer.innerHTML = `
        <p>${question.question_text}</p>
        <form id="answerForm">
            ${allChoices.map((choice, index) => `
                <div>
                    <input type="checkbox" id="choice${index}" name="choices" value="${choice}">
                    <label for="choice${index}">${choice}</label>
                </div>
            `).join('')}
            <button type="button" onclick="checkAnswer()">Verifică răspunsul</button>
            <p id="result"></p>
        </form>`;

              // Setează stilul pentru a face containerul vizibil
              questionContainer.style.display = 'block';

              // Funcția pentru a verifica răspunsul ales
              window.checkAnswer = function () {
                  var selectedAnswers = document.querySelectorAll('input[name="choices"]:checked');
                  var selectedChoices = Array.from(selectedAnswers).map(answer => answer.value);

                  // Verifică dacă răspunsurile alese sunt corecte
                  var correctChoices = allChoices.filter(choice => choice === question.correct_answer);
                  var isCorrect = selectedChoices.length === correctChoices.length && selectedChoices.every(choice => correctChoices.includes(choice));

                  // Dacă răspunsul este corect, actualizează contorul
                  if (isCorrect) {
                      correctCount++;
                      document.getElementById('result').innerText = "Răspuns corect!";
                  } else {
                      document.getElementById('result').innerText = "Răspuns greșit. Răspunsul corect era: " + question.correct_answer;
                  }

                  // Actualizează numărul total de întrebări
                  totalQuestions++;

                  // Treci la următoarea întrebare indiferent de corectitudinea răspunsului
                  getNextQuestion();
              };
          }

          var isFirstClick = true;
          function getNextQuestion() {
              var randomQuestion = getRandomQuestion();
              if (randomQuestion !== null) {
                  displayQuestion(randomQuestion);

                  // Ascunde butonul "Next Question" după prima apăsare
                  if (isFirstClick) {
                      document.getElementById('nextButton').style.display = 'none';
                      isFirstClick = false; // Setează variabila la false după prima apăsare
                  }
              } else {
                  // Toate întrebările au fost răspunse
                  resultContainer.innerHTML = `
            <p>Număr total de întrebări: ${totalQuestions}</p>
            <p>Număr de raspunsuri corecte: ${correctCount}</p>`;

                  // Ascunde containerul cu întrebarea după ce toate întrebările au fost răspunse
                  document.getElementById('questionContainer').style.display = 'none';

                  // Salvează scorul în baza de date
                  saveScore(correctCount);
              }
          }

          function saveScore(score) {
              $.ajax({
                  url: 'save_score.php',
                  type: 'POST',
                  data: { score: score },
                  success: function (response) {
                      console.log(response);
                  },
                  error: function (error) {
                      console.error('Eroare la salvarea scorului: ', error);
                  }
              });
          }

          $(document).ready(function () {
              getQuestions();
          });
      </script>

      <!-- ======= Scoreboard Section ======= -->

      <?php
      // Configurarea conexiunii la baza de date
      $servername = 'localhost';
      $username = 'root';
      $password = '';
      $database = "quizdb";

      // Crearea conexiunii
      $conn = new mysqli($servername, $username, $password, $database);

      // Verificați conexiunea
      if ($conn->connect_error) {
          die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
      }

      // Operație de citire (Read) - obțineți utilizatorii din baza de date
      $sql = "SELECT * FROM users ORDER BY score DESC";
      $result = $conn->query($sql);
      ?>

      <section>
          <h1>Scoreboard</h1>
          <div class="container">
              <table class="table">
                  <thead>
                  <tr>
                      <th>Nume</th>
                      <th>Score</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $row['nume'] . "</td>";
                          echo "<td>" . $row['score'] . "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='12'>Nu există utilizatori în baza de date.</td></tr>";
                  }
                  ?>
                  </tbody>
              </table>
          </div>
      </section>

      <!-- End Scoreboard Section -->




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>VFA</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
        Designed by <a href="#">Vechiu Andreea</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>


