
<!DOCTYPE html>

<html lang="hu">
<head>
<script>
  var eger = new Audio();
  eger.src = "hang/hang.wav";
</script>

	<meta charset="UTF-8">
	<title>DreamJob</title>
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
              <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                <li><button  onmousedown="eger.play()" onclick="document.location='regi.php'">Regisztráció</button></li>
              
                <li><button   onmousedown="eger.play()" onclick="document.location='logi.php'"><strong>Bejelentkezés</strong></button></li>
                <?php else:?> 
                    <li><button  onclick="document.location='profile.php'"><strong>Profilom</strong></button></li>
                    <li><button  onclick="document.location='kijelentkezes.php'"><strong>Kijelentkezés</strong></button></li>
                <?php endif;?>  

            </ul>
            </nav>



        </div>



      </header>
      <div class="banner-area">
        

      </div>
      <div class="content-area">
      <div id="profil">
          <h1>Bejelentkezés</h1>
          <p><u>A profil megtekintéséhez jelentkezzen be!</u></p>
          <form id="Bejelentkezés" action="logi.php" method="POST">
            <fieldset id="log">
              <legend><em>Bejelntkezés</em></legend>
              <br/>
              <br/>
              <label for="fnevbej">E-mail cím</label>
              <br/>
              <input required type="text" id="fnevbej" name="fnevbej" tabindex="1"/>
              <br/>
              <br/>
              <label for="jelszobej">Jelszo</label>
              <br/>
              <input  type="text" id="jelszobej" name="jelszobej" tabindex="2"/>
              <br/>
              <br/>
              <input type="submit" value="Bejelentkezes" name="bej"/>
              <p>Nincs még fiókja?<a href="regi.php"> Hozzon létre egyet!</a></p>





            </fieldset>





          </form>
          <?php
            $conn=oci_connect('jakiproba', 'avatar' , 'localhost/XE');

            if(!$conn){
                $e=oci_error();
                trigger_error(htmlentities($e['Nem sikerült csatlakozni az adatbázishoz'], ENT_QUOTES), E_USER_ERROR);

            }


            if (isset($_POST["bej"])){
                $user=$_POST['fnevbej'];
                $pass=$_POST['jelszobej'];

               session_start();
               $query = "SELECT USERID  FROM FELHASZNALO WHERE EMAIL =
                :email and PW=:pwd"; 
                //query is sent to the db to fetch row id.
                $stid = oci_parse($conn, $query);
                /*oci_parse fuction prepares the db to execute the statement.
                requires two parameters resource($con)and sql string.*/
                
                
                oci_bind_by_name($stid, ':email', $user);
                oci_bind_by_name($stid, ':pwd', $pass);
                /*oci_bind_by_name function tells php which variable to use.
                They are references of the original variables.*/
                oci_execute($stid);
                $row = oci_fetch_array($stid, OCI_ASSOC);
                //oci_fetch_array returns a row from the db.

                if ($row) {
                $_SESSION['email']=$_POST['fnevbej'];
                
                echo"log in successful";
                  }
                else {
                echo("A felhasznalo " . $user . " nem talalhato .
                Kerlek prolad ujra");
                
                exit;
                }
                header('Location: prof.php');
                $ID = $row['ID']; 
                oci_free_statement($stid);
                oci_close($conn);
              
               
               
        

                      }


          ?>
                
        
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
  
	
<!--<ul class="menu">
    <div class="logo">
    <a href="#"></a>
    <img src="SZTENET2.png" alt="Logo">
      
    </div>
    
    <li><button><a href="#"></a>Internet</li></button>
    <li><a href="#"></a>Telefon</li>
    <li><a href="#"></a>Tévé</li>
    <li><a href="#"></a>Ügyfélszolgálat</li>
    <li><a href="#"></a>Regisztráció</li>

</ul>-->


	



</body>






















</html>