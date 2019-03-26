<?php

$this_dir = dirname(__FILE__);
print_r($this_dir);
echo '<br>';
//$parent_dir = realpath($this_dir . '/upfiles');

 $uploadfile = $this_dir.'/'.basename($_FILES['fexcel']['name']);
 
           if (move_uploaded_file($_FILES['fexcel']['tmp_name'], $uploadfile)) 
           {
               echo "File Uploaded Successfully!!\n";
              // shell_exec('./priya');
            
           } 
           else
           {
               echo "Something went wrong in uploading.\n";
               
               
           }
           
$connect = mysqli_connect("localhost", "root", "123456" );
if($connect)
{
    echo '<br>Connected to database sucessfully! <br>';
}
 else {
    echo 'fail<br>';    
}

 $extension = end(explode(".", $_FILES["fexcel"]["name"]));       // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); 
 //allowed extension
 
// $workbook = new COM("EasyXLS.ExcelDocument");
 if(in_array($extension, $allowed_extension))                 //check selected file extension is present in allowed extension array
 {
//  $inputFileName = $_FILES["fexcel"]["tmp_name"];
//  print_r($inputFileName."</br>");
  $file1 = $_FILES["fexcel"]["name"]; 
  echo $file1."</br>";
    // getting temporary source of excel file
 $inputFileName = '/var/www/html/hostelproject/data.csv';
// $h = "hello";
// echo $h;
 include 'PHPExcel/IOFactory.php';

//$inputFileName = './sampleData/example1.xls';

//  Read your Excel workbook
try {
    
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        echo "loaded";

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(1); 
echo "</br>echo";
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    //  Insert row data array into your database of choice here
    echo $rowData;
}


 
 
// try{
//     echo '</br>hello';
//     include  'PHPExcel/IOFactory.php';               //Add PHPExcel Library in this code
//  
//    $objPHPExcel = PHPExcel_IOFactory::load($file1);  // create object of PHPExcel library by using load() method and in load method define path of selected file
//    echo $objPHPExcel;
//  
// } catch (Exception $e){
//     echo $e;
// }
 
 //$s=$parent_dir.'/'.$file;
 // print_r($s);
  echo '<br>'; 
  //'PHPExcel/IOFactory.php'; 
  
//  $objPHPExcel = PHPExcel_IOFactory::load($file1);  // create object of PHPExcel library by using load() method and in load method define path of selected file
  print_r($objPHPExcel);
 
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
      
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    
    $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $query = "INSERT INTO girlsdata(roll_no, full_name) VALUES ('$name', '$email')";
    mysqli_query($connect, $query);
    
   }
  } 
  
 }
 
?>

           
           
           
           
           
           
        