<?php 

    $counter = $_POST['counter'];

    echo $counter;
    $p_name = $_POST['part_name0'];
    for ($i = 1; $i < $counter+1; $i++) {
        $perem = "part_name".$i;
        $$perem = $_POST['part_name'.$i];
        $p_name = $p_name."|".$$perem;
    };
    $massive = explode("|", $p_name);
    print_r($massive);
    
    
    
    // $first = "value".$counter;
    // $$first = "хуй соси губой тряси";
    // echo $$first;

    
    
?>