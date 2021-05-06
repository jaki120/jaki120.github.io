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
            


            <table>
                <caption style="caption-side:top; font-weight: bold">Profil adatok</caption>

                <tbody>
                <tr>
            <th colspan="2">
               
            </th>
          </tr>
                    <tr>
                        <th>Email:</th>
                        <form action="ceg_prof.php" method="POST">
                        
                        <td><?=$_SESSION['email']?></td>
                        <td><input type="text" placeholder="Új név" id="name" name="name"></td>
                        <td><button type="submit" name="edit">Modosit</button></td>
                        <td><button type="submit" name="delete">Torles</button></td>
                        </form>
                    </tr>
                   <?php
                   
                   $conn = oci_connect('jakiproba', 'avatar', 'localhost/XE');
                   if(!$conn){
                    $e=oci_error();
                    trigger_error(htmlentities($e['Nem sikerült csatlakozni az adatbázishoz'], ENT_QUOTES), E_USER_ERROR);

                }
                $emailID = $_SESSION["email"];
                
                if(isset($_POST["edit"])){
                  
                  $ujnev = $_POST["name"];
                  $s2 = oci_parse($conn, "UPDATE FELHASZNALO SET nev = '" . $_POST['name'] . "' WHERE email = '$emailID'");
                $r=oci_execute($s2);
                oci_rollback($conn);
                }

                /*if(isset($_POST["delete"])){
                  
                  $s3 = oci_parse($conn, "DELETE FROM FELHASZNALO WHERE email = '$emailID'");
                  oci_execute($s3);
                  oci_rollback($conn);
                  session_destroy();
                  header("Location: logi.php");
                  exit();

                }*/
                /*
                if($r)  
                {  
                  oci_commit($conn);
                  echo "Data Updated Successfully !";
                }
                else{
                  echo "Error.";
                }*/
                

                

                
                /*$query = "SELECT * FROM felhasznalo WHERE 'email' = '$emailID'";
                $s = oci_parse($conn, $query);
                oci_execute($s);
                while(($row = oci_fetch_array($s, OCI_BOTH)) != false){
                  echo $row['nev'];
                  echo $row['email'];
                  echo $row['pw'];
                  echo $row['telszam'];
                }
                oci_free_statement($s);*/
                
                
                   ?>
                    
                    
                </tdoby>
            </table>
           
          <!--<h1>Bejelentkezés</h1>
          <p><u>A profil megtekintéséhez jelentkezzen be!</u></p>
          <form id="Bejelentkezés">
            <fieldset id="log">
              <legend><em>Bejelntkezés</em></legend>
              <br/>
              <br/>
              <label for="fnevbej">Felhasználónév</label>
              <br/>
              <input required type="text" id="fnevbej" name="fnevbej" tabindex="1"/>
              <br/>
              <br/>
              <label for="jelszobej">Jelszo</label>
              <br/>
              <input required type="text" id="jelszobej" name="jelszobej" tabindex="2"/>
              <br/>
              <br/>
              <input type="submit" value="Bejelentkezes" name="bej"/>
              <p>Nincs még fiókja?<a href="Regisztráció.html"> Hozzon létre egyet!</a></p>





            </fieldset>





          </form>-->

        </div>

        <div>
        <form action="uj_hirdetes.php" method="POST">
        <?=$_SESSION['email']?>
        <button>Új állás felvitele</button>
        </form>
        
        </div>
        <!--<div class="wrapper">
          <h2>BEJELENTKEZÉS</h2>
          <p>Kérem adja meg a Felhasználónevét és a Jelszavát!</p>
          
            <form>
              <table id="table3">
               <tr>
                <td>Felhasználónév:</td>
                <td><input type="text"></td>
               </tr>
               <tr>
                <td>Jelszó:</td>
                <td><input type="password"></td>
               </tr>
               <tr>
                <td><input type="submit" value="Bejelentkezés"></td>
               </tr>
              </table>
             </form>-->
            
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