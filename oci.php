<?php
$conn=oci_connect('ASD', 'ASD' , 'localhost/XE');

if(!$conn){
    $e=oci_error();
    trigger_error(htmlentities($e['nemtudom'], ENT_QOUTES), E_USER_ERROR);
}

$stid=oci_parse($conn, 'SELECT * FROM ALLAS');
if(!$stid){
    $e=oci_error($conn);
    trigger_error(htmlentities($e['nemtudom'], ENT_QOUTES), E_USER_ERROR);
}

$r=oci_execute($stid);
if(!$r){
    $e=oci_error($stid);
    trigger_error(htmlentities($e['nemtudom'], ENT_QOUTES), E_USER_ERROR);
}
print "<table>\n";
while($row=oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
    print "<tr>\n";
    foreach ($row as $item){
        print "<td>" . $item . "</td>\n";
        //print "<td>" . ($item !==null ? htmlentities($item, ENT_QOUTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr\n";
}

print "</table\n";

oci_free_statement($stid);
oci_close($conn);

?>