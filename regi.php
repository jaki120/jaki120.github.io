
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
        <h1 class="a"><i>Regisztráljon hogy tudjon állást keresni!</i></h1>
        <div id="reg">
            <form action="regi.php" method="POST" enctype="multipart/form-data">
               <h1>Regisztráció </h1>
               <fieldset>
                 <legend>Személyes adatok</legend>
                 <br/>
                 <label  for="nev">Név</label>
                 <br/>
                 <input required type="text" id="nev" name="nev" tabindex="1"/>
                 <br/>
                 <br/>
                 <br/>
                 <label  for="pw">Jelszo</label>
                 <br/>
                 <input required type="password" id="pw" name="pw" tabindex="3"/>
                 <br/>
                 <br/>
                 <label for="pwa">Jelszo mégegyszer</label>
                 <br/>
                 <input required type="password" id="pwa" name="pwa" tabindex="4"/>
                 <br/>
                 <br/>
                 <label for="tel">Telefonszám</label>
                 <br/>
                 <input type="tel" id="tel" name="tel" tabindex="5" placeholder="0630 / +3630..."/>
                 <br/>
                 <br/>
                 <label for="email">Emailcim</label>
                 <br/>
                 <input required type="email" id="email" name="email" tabindex="6" placeholder="pelda@valami.com"/>
                 <br/>
                 <br><br>
                 <label for="tanulmany">Válaszd ki hol/mit tanultál</label><br>
                 <select name="list" id="list">
                 <option value="2">SZTE Programtervező informatika</option>
                 <option value="3">SZTE Mérnök informatikus</option>
                 <option value="4">SZTE Jogász</option>
                 <option value="5">SZTE Bölcsész</option>
                 <option value="6">OKJ Targoncavezető</option>
                 <option value="7">SZTE Üzemmérnök</option>
                 </select>
                 <br><br>
                 <br/>

                </fieldset>
                
                <input type="checkbox" name="elfogad" id="elfogad"><label for="elfogad"> Elolvastam és elfogadom az adatkezelési metódust</label>
                <br/>
                <br/>
                <br/>
                <br/>
                <input type="submit" name="reg" value="Regisztráció">
                <br/>
                <br/>
                <input type="reset">
            </form>
            <?php

                      $conn=oci_connect('jakiproba', 'avatar' , 'localhost/XE');

                      if(!$conn){
                          $e=oci_error();
                          trigger_error(htmlentities($e['Nem sikerült csatlakozni az adatbázishoz'], ENT_QUOTES), E_USER_ERROR);

                      }
                      if (isset($_POST["reg"])) {
                        $nev=$_POST["nev"];
                        $iskolaid = $_POST["list"];
                        $pw=$_POST["pw"];
                        $pwa=$_POST["pwa"];
                        $tel=$_POST["tel"];
                        $email=$_POST["email"];
                        $rand = rand(50, 400);
                        



                      $s=oci_parse($conn,
                                    "insert into FELHASZNALO values('$rand','$nev', '$pw', '$iskolaid','$email','$tel')");
                     $r=oci_execute($s);
                     oci_rollback($conn);
                     echo "Sikeres regisztráció\n";        
                    }     





            ?>
        
        <!-- <div class="wrapper">
          

        </div> -->
            

        
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