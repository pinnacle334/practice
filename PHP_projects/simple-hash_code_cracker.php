<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Michael Emmanuel Ekanem MD5 Cracker</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['md5'])) {
        // Retrieve form data
        check($_GET['md5']);
    }
    ?>
    
    <?php
    function check($data) {
        //VARIABLES TO BE USED
        $start_time = microtime(true);
        $isFound = false;
        $total_number = array();
        $min_num = 0; $max_num = 9;
        //LOOP TO DETERMINE ALL THE POSSIBLE COMBINATION OF A FOUR-NUMERIC NUMBER
        for ($i = $min_num; $i <= $max_num; $i++) {
            for ($j = $min_num; $j <= $max_num; $j++) {
                for ($k = $min_num; $k <= $max_num; $k++) {
                    for ($l = $min_num; $l <= $max_num; $l++) {
                        $total_number[] = "$i$j$k$l";
                        //CHECKING IF THE HASH CODE OF EACH COMBINATIONS MATCHES WITH THE HASH CODE OF THE USER
                        if ((hash('MD5', "$i$j$k$l")) == $data) {
                            $isFound = true;
                            $message = "PIN: $i$j$k$l";
                            break;
                        }  
                    }
                }
            }
        } 
        //PRINTING THE FIRST FIFTEEN HASH CODE OF THE COMBINATIONS
        for ($m = 0; $m < 15; $m++) {
            echo hash('MD5', '$total_number[$m]') . "  $total_number[$m]<br>";
        }
        echo "Total checks: " . count($total_number);
        echo "<br>";
        //CALCULATING THE TOTAL TIME USED
        $end_time = microtime(true);
        $elapsed_time = $end_time - $start_time;
        echo "<br>Elapsed Time: " . number_format($elapsed_time, 4) . " seconds.";
        echo "<br><br>";
        if ($isFound == true) {
            echo "<strong>$message</strong>";
        }
        else {
            echo "<strong>PIN: Not found</strong>";
        }
    }
    ?>
    <h1>MD5 cracker</h1>
    <p>This application takes an MD5 hash
    of a four digit pin and check all 10,000 possible 
    four digit PINs to determine the PIN.</p>
    <!-- <pre>
    Debug Output:
    </pre>
    Use the very short syntax and call htmlentities()
    <p>Original Text: Not found</p> -->
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="GET">
        <input type="text" name="md5" size="60" />
        <input type="submit" value="Crack MD5"/>
    </form>
    <ul>
        <li><a href="index.php">Reset</a></li>
    </ul>
    
</body>
</html>
