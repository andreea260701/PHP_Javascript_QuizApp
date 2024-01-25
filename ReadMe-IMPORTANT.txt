Pentru crearea acestui proiect s-a folosit xampp, PHPMyAdmin. Pentru a deschide proiectul cu baza de date in regula, se va pune folderul QuizApp in Folderul unde este instalat xampp in folderul htdocs.
Se va crea in phpmyadmin o baza de date fara nici un tabel numita quizdb si se va importa fisierul quizdb.sql.
Dupa ce baza de date este importata, se va aprinde xampp si se va activa MySQL si apache.
Aprindem un browser pe link-ul http://localhost/QuizApp/index.php.

Decat sa fac o aplicatie simpla, am facut o aplicatie completa cu sistem de login, register, admin, quizgame-ul, bestscore pentru fiecare utilizator care este afisat sub quizgame sub forma unui Scoreboard.
Se poate folosi quizgame-ul si fara a te autentifica, dar scorul nu va fi stocat in baza de date, implicit in scoreboard. 

De MENTIONAT: contul admin este andreea.vechiu26@gmail.com si parola 1234 . Ca si utilizator simplu ne putem crea cont doar ca si utilizator. Daca se logheaza pe contul admin, apar 2 functii noi in meniu. Acelasi
formular de register, doar ca in dropdown nu mai este doar utilizator ci si administrator. Pe langa inregistrarea adminului mai avem si formularul de adaugat intrebari, wrongchoice si correctchoice.
S-a folosit php pentru a crea aplicatia completa. Scriptul de javascript pentru realizarea quizgame-ului se afla in fisierul index.php.

Dupa ce orice utilizator sau admin s-a conectat in aplicatie si incepe sa joace, numarul de intrebari la care a raspuns corect este afisat pe ecran, implicit in scoreboard daca dam refresh la pagina.
Daca spre exemplu dupa ce am terminat intrebarile am obtinut un scor de 15 raspunsuri corecte, acest 15 se va afisa in scoreboard, daca urmatoarea data cand joc obtin un scor de 13, in scoreboard va ramane 15, dar daca obtin
peste 15, scorul nou va fi afisat. Nici o intrebare nu se repeta pana la final, intotdeauna ordinea intrebarilor este schimbata cat si ordinea raspunsurilor. Totul este random.

Toate intrebarile sunt stocate in baza de date in felul urmator: Un camp pentru intrebare, 4 campuri pentru raspunsuri gresite si un camp pentru raspunsul corect. Pentru interfata s-a folosit un template de boostrap.