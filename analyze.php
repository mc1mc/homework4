<!DOCTYPE html>
<html style="text-align:center;">
<head>Text Analysis/ File management</head>
<body>
<br>
<?php

$inputFile=fopen("input.txt","r+");
$fileContentString= fread($inputFile,filesize("input.txt")) or die("Cannot find input file.");
$wordArray= explode (",", $fileContentString);
$misspelledWords=fopen("misspelled.txt", "w");
/*foreach ($wordArray as $key => $word) {
  echo $word;
}*/
$wordAssArray=array();
$count=0;

$mutators=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$misspelledArray=array();

foreach ($wordArray as $word){
  $count+=1;
  

  if (array_key_exists("$word",$wordAssArray)){
    $wordAssArray["$word"]+= 1;
  }else{
    $wordAssArray["$word"] = 1;
  }
  }
  
foreach ($wordArray as $word){
    $misspellCheck = str_split($word);
    $newBatch = array();
  foreach ($misspellCheck as $char){
    $chance = rand(1,100);
    $mutationChance = rand(0,25);
    if ($chance <= 10){
        array_push($newBatch,$mutators[$mutationChance]);
    } else {
        array_push($newBatch, $char);
    }
  
  }
    $newBatchString = implode($newBatch);
    array_push($misspelledArray, $newBatchString);
}



  
ksort($wordAssArray);
echo '<div style="float:left;">';
foreach ($wordAssArray as $word => $freq) {
    echo  $word, " : ", $freq," : ", number_format((($freq/sizeof($wordAssArray))*100),2),"%", "<br>" ;
}
echo '</div>';

sort($misspelledArray);
echo '<div style="float:right;"><table><tr><th>Typos</th></tr>';
foreach($misspelledArray as $word){
    echo '<tr><td>'.$word.'</td></tr>';
    fwrite($misspelledWords, $word);
}
echo '</table></div>';
?>
</body>
</html>
