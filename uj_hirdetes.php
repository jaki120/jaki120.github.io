<?php
session_start();




if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){

    header("Location: ceg_logi.php");
    exit();


    
}

?>
<!DOCTYPE html>

<html lang="hu">
<head>
  <script>
    var eger = new Audio();
    eger.src = "hang/hang.wav";
  </script>

	<meta charset="UTF-8">
	<title>Internet szolgáltató</title>
	<link rel="stylesheet"  href="style.css">
</head>
<body>
  <div class="box">
      <header>
        <div class="wrapper">
            <div class="logo">
              
                <a href="adatbmain.php"><b>Dream Job</b></a>


            </div>
            <nav>
              <ul id="menu">
              <li><a onmousedown="eger.play()" href="allasok.php">Állás keresés</a></li>
              <li><a onmousedown="eger.play()" href="#">Hirdetés feladása</a></li>
            
              <li><a onmousedown="eger.play()" href="#">Ügyfélszolgálat</a></li>
              <?php if(!isset($_SESSION["email"]) || empty($_SESSION["email"])): ?>
                <li><button  onmousedown="eger.play()" onclick="document.location='ceg_regi.php'">Regisztráció</button></li>
              
                <li><button   onmousedown="eger.play()" onclick="document.location='ceg_logi.php'"><strong>Bejelentkezés</strong></button></li>
                <?php else:?> 
                    <li><button id="aktiv" onclick="document.location='prof.php'"><strong>Profilom</strong></button></li>
                    <li><button  onclick="document.location='logout.php'"><strong>Kijelentkezés</strong></button></li>
                <?php endif;?>        
            </ul>
            </nav>
            



        </div>



      </header>
      <div class="banner-area">
        

      </div>
      <div class="content-area">


        <div id="profil">
            


            

        <div>
        <form action="uj_hirdetes.php" method="POST">
        <label for="pozicio">Pozíció megadása</label>
        <br>
        <input type="text" name="pozicio" id="pozicio">
        <br>
        <br>

        <label for="elvaras">Min. Elvárás (végzettséggel kapcsolatban)</label>
        <br>
        <input type="text" name="elvaras" id="elvaras">
        <br>
        <br>

        <label for="fizetes">Fizetés megadása</label>
        <br>
        <input type="number" name="fizetes" id="fizetes">Ft
        <br>
        <br>
        <label for="egyeb">Egyéb munkával kapcsolatos információ</label>
        <br>
        <input type="textarea" name="egyeb" id="egyeb">

        
        <?=$_SESSION['email']?>
        <br>
        <input type="submit" name="felvitel" value="Felvitel">
        </form>


        <?php
         $conn=oci_connect('jakiproba', 'avatar' , 'localhost/XE');

         if(!$conn){
             $e=oci_error();
             trigger_error(htmlentities($e['Nem sikerült csatlakozni az adatbázishoz'], ENT_QUOTES), E_USER_ERROR);

         }

         $emailID = $_SESSION["email"];

            if(isset($_POST['felvitel'])){
                $pozicio = $_POST['pozicio'];
                $elvaras = $_POST['elvaras'];
                $fizetes = $_POST['fizetes'];
                $egyeb = $_POST['egyeb'];
                $Hirdet_ID = rand(1, 500);
                $rand_allas_ID = rand(1, 500);

                $munkaltato = oci_parse($conn, "SELECT munkaltatoid FROM MUNKALTATO WHERE email = '$emailID'" );
                oci_execute($munkaltato);

                /*while(($row = oci_fetch_assoc($munkaltato)) != false){
                  echo $row['MUNKALTATOID'];
                }*/
                $row = oci_fetch_assoc($munkaltato);
                $munkaltatoID = $row['MUNKALTATOID'];
                echo $munkaltatoID;
                

                $stmt = oci_parse($conn, "INSERT INTO ALLAS VALUES('$rand_allas_ID', '$pozicio', '$elvaras', '$fizetes', '$egyeb')");
                oci_execute($stmt);
                oci_free_statement($stmt);
                $stmt2 = oci_parse($conn, "INSERT INTO HIRDET VALUES ('$Hirdet_ID', '$munkaltatoID', '$rand_allas_ID')");
                oci_execute($stmt2);
                oci_free_statement($stmt2);
                oci_free_statement($munkaltato);
            }




        ?>
        
        </div>
        
            
             <footer id="footer">
          
              <table id="lablec" >
          
                <tr>
          
                  <th>Elérhetőségek</th>
                </tr>
               
                <tr>
                  <td > Panaszbejelentés:+36303335053 | <b> 1-es menüpont</b></td>
                </tr>
                <tr>
                  <td >Ügyfélszolgálat:+36303335053 |<b> 2-es menüpont</b></td>
                </tr>
                <tr>
                  <td > Hibabejelentő: +36303335053 | <b>3-as menüpont</b></td>
                </tr>
                <tr>
                  <td ><button id="nyomt" onclick="window.print()">Oldal nyomtatása</button></td>
                </tr>
              
              
            </table>
             
    
    
            </footer>
        

      </div>



  </div>

</body>






















</html>