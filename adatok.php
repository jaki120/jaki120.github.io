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
              
                <a href="adatbmain.php"><b>Fő oldal</b></a>


            </div>
            <nav>
              <ul id="menu">
              <li><a onmousedown="eger.play()" href="#">Regisztralt felhasznalok</a></li>
              <li><a onmousedown="eger.play()" href="munkaltato.php">Munkaltatóink</a></li>
              <li><a onmousedown="eger.play()" href="iskola.php">Iskolak</a></li>
              
              <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                <!--<li><button  onmousedown="eger.play()" onclick="document.location='regi.php'">Regisztráció</button></li>
              
                <li><button   onmousedown="eger.play()" onclick="document.location='logi.php'"><strong>Bejelentkezés</strong></button></li>
                <?php else:?> 
                    <li><button  onclick="document.location='profile.php'"><strong>Profilom</strong></button></li>
                    <li><button  onclick="document.location='kijelentkezes.php'"><strong>Kijelentkezés</strong></button></li>
                <?php endif;?>  -->

            </ul>
            </nav>



        </div>



      </header>
      <div class="banner-area">
        

      </div>
      <div class="content-area">
        <h1>Regisztrált felhasználók</h1>
        <?php
            $conn=oci_connect('ASD', 'ASD' , 'localhost/XE');

            if(!$conn){
                $e=oci_error();
                trigger_error(htmlentities($e['nemtudom'], ENT_QUOTES), E_USER_ERROR);
                }

                $stid=oci_parse($conn, 'SELECT NEV, TELSZAM, EMAIL FROM FELHASZNALO');
                if(!$stid){
                    $e=oci_error($conn);
                    trigger_error(htmlentities($e['nemtudom'], ENT_QUOTES), E_USER_ERROR);
                }

                $r=oci_execute($stid);
                if(!$r){
                    $e=oci_error($stid);
                    trigger_error(htmlentities($e['nemtudom'], ENT_QUOTES), E_USER_ERROR);
                }
                print "<table id='table3'>\n";
                echo '<th >Felhasznalo neve: </th>';
                echo '<th >Telefonszama:</th>';
                echo '<th >Emailcime: </th>';
                        
                
                while($row=oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
                  
                    print "<tr>\n";
                    
                    foreach ($row as $item){
                        //print "<td>" . $item . "</td>\n";
                        print "<td>" . ($item !==null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        
                    }
                    print "</tr\n";
                    
                }
                

                print "</table\n";

                oci_free_statement($stid);
                oci_close($conn);

            ?>
        
        <div class="wrapper">
          

        </div>
            

        
        <!--<footer id="footer">
          
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
      </div>-->



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