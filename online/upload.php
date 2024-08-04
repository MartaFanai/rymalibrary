<?php require_once 'connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
<style>
.loading .dot {
    animation: dots 1s infinite;
    display: inline-block;
}

@keyframes dots {
    0%, 20% {
        color: rgba(0, 0, 0, 0);
        text-shadow:
            .25em 0 0 rgba(0, 0, 0, 0),
            .5em 0 0 rgba(0, 0, 0, 0);
    }
    40% {
        color: #000;
        text-shadow:
            .25em 0 0 rgba(0, 0, 0, 0),
            .5em 0 0 rgba(0, 0, 0, 0);
    }
    60% {
        text-shadow:
            .25em 0 0 #000,
            .5em 0 0 rgba(0, 0, 0, 0);
    }
    80%, 100% {
        text-shadow:
            .25em 0 0 #000,
            .5em 0 0 #000;
    }
}

input[type=file]::file-selector-button {
  margin-right: 10px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}
</style>
    <title>CSV Upload</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        input[type=file] {
            display: block;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #3e8e41;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
    // Construct the query to select the latest updated_at value from the books table
    $sql = "SELECT MAX(updated_at) AS latest_update FROM books";
    $sql1 = "SELECT MAX(updated_at) AS latest_update FROM online_books";

    // Execute the query and get the result
    $result = mysqli_query($con, $sql);
    $result1 = mysqli_query($con, $sql1);

    // Check if the query was successful
    if ($result) {
        // Fetch the row from the result set
        $row = mysqli_fetch_assoc($result);
        
        // Get the latest updated_at value
        $latest_update_books = $row['latest_update'];
        
    }if($result1){
        // Fetch the row from the result set
        $row1 = mysqli_fetch_assoc($result1);
        
        // Get the latest updated_at value
        $latest_update_onlinebooks = $row1['latest_update'];
        
    } else {
        // Print an error message if the query failed
        echo "Error: " . mysqli_error($con);
    }
?>
    <div class="container">
        <h1>CSV Upload For Sync of Offline and Online Data</h1><br>
       
        <form method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="file" onchange="showLoadingText()" onclick="show()">
            <div class="loading" id="before" style="display:none">Loading please wait<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span><br></div>
            <div id="after" style="display:none">Please Click Import button to Import CSV file<br></div><br>
            <button type="submit" class="btn" id="importBtn" name="submit" style="display:none"> Import </button>
        </form>

    </div>

<?php 

if($latest_update_books < $latest_update_onlinebooks){ ?>
    <div class="container">
        <h3>There is an update you can sync with the latest data of CSV provided</h3>
        <form method="post" >
            <button type="submit" class="btn" name="sync"> Sync Data Now </button>
        </form>
    </div>
<?php } ?>

<script>
  function showLoadingText() {
    document.getElementById("after").style.display = "inline";
    document.getElementById("importBtn").style.display = "inline";
    document.getElementById("before").style.display = "none";
    
}

function show(){
    document.getElementById("before").style.display = "inline";
    document.getElementById("importBtn").style.display = "none";
    document.getElementById("after").style.display = "none";
}
</script>
   
    
</body>
<script type="text/javascript">
        function uploadFile(input) {
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var formData = new FormData();
                formData.append('file', file);
                var xhr = new XMLHttpRequest();
                var progressBar = document.querySelector('.progress-bar');
                var progressVal = document.querySelector('.progress-val');
                xhr.open('POST', 'upload.php', true);
                xhr.upload.addEventListener("progress", function (e) {
                    var percent = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percent + '%';
                    progressVal.innerHTML = percent + '%';
                }, false);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        progressBar.style.width = '0%';
                        progressVal.innerHTML = '0%';
                        alert(xhr.responseText);
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
</html>


<?php

if (isset($_POST['sync'])) {


// To count number of rows to be deleted
function deletecount($con) {
    $query = "SELECT COUNT(*) AS count FROM online_books WHERE del = 1";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $num_rows = $row['count'];
    }
    else {
        $num_rows = 0;
    }
    return $num_rows;
}

function deletebook($con){
    // Check for books to delete
    $delete_query = "SELECT bookid FROM online_books WHERE del = 1";
    $result = mysqli_query($con, $delete_query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bookid = $row['bookid'];
                
            // Delete the record from books table where id matches bookid of online_books
            $delete_book_query = "DELETE FROM books WHERE id = '$bookid'";
            mysqli_query($con, $delete_book_query);
        }
    }  
}

function newcount($con){
    
    $update_query = "SELECT * FROM online_books";
    $result = mysqli_query($con, $update_query);

    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookid = $row['bookid'];
        $title = $row['title'];
        $author = $row['author'];
        $edition = $row['edition'];
        $year = $row['year'];
        $publisher = $row['publisher'];
        $pages = $row['pages'];
        $accessionno = $row['accessionno'];
        $classificationno = $row['classificationno'];
        $subject = $row['subject'];
        $bookno = $row['bookno'];
        $description = $row['description'];
        $price = $row['price'];
        $location = $row['location'];
        $qty = $row['qty'];
        $member_id = $row['member_id'];
        $issuer = $row['issuer'];
        $created_at = $row['created_at'];
        $updated_at = $row['updated_at'];
        
        // Check if the online_books bookid exists in the books table id
        $check_query = "SELECT * FROM books WHERE id = '$bookid'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Update the corresponding fields in books table
            $update_book_query = "UPDATE books SET title = '$title', author = '$author', edition = '$edition', year = '$year', publisher = '$publisher', pages = '$pages', accessionno = '$accessionno', classificationno = '$classificationno', subject = '$subject', bookno = '$bookno', description = '$description', price = '$price', location = '$location', qty = '$qty', member_id = '$member_id', issuer = '$issuer', updated_at = '$updated_at' WHERE id = '$bookid'";
            mysqli_query($con, $update_book_query);
        } else {
            // Step 3: Insert new rows
            $insert_book_query = "INSERT INTO books (id, title, author, edition, year, publisher, pages, accessionno, classificationno, subject, bookno, description, price, location, qty, member_id, issuer, created_at, updated_at) VALUES ('$bookid','$title', '$author', '$edition', '$year', '$publisher', '$pages', '$accessionno', '$classificationno', '$subject', '$bookno', '$description', '$price', '$location', '$qty', '$member_id', '$issuer', '$created_at', '$updated_at')";
            mysqli_query($con, $insert_book_query);
        }
    }

}
    

}


//Manipulation of code for delete request.
$del = deletecount($con);

    if($del > 0){
        deletebook($con);
    }

$insrt = newcount($con);
    
echo "<script>alert('All the data are up-to-date... :)');</script>";

}




if (isset($_POST["submit"])) {
    $file = $_FILES["file"]["tmp_name"];
    $file_name = $_FILES["file"]["name"];

    // Check if file exists
    if (!file_exists($file)) {
        die("File not found");
    }

    // Check if a file was uploaded
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {

            // Get the file extension of the uploaded file
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            // Check if the file extension is valid
            if ($extension != 'csv') {
                echo "<script>alert('The file is not CSV format');</script>";
                die();
            }
        }

    $file_name = $_FILES["file"]["name"]; // get the name of the uploaded file
    $date_part = explode('_', pathinfo($file_name, PATHINFO_FILENAME))[0]; // extract the date part from the file name
    $date = date('Y-m-d', strtotime($date_part)); // convert the extracted date to the format 'Y-m-d'


    // Read CSV file
    $csv = array_map('str_getcsv', file($file));

    // Remove header row
    // array_shift($csv);

    // Get the latest creation date from the online table
    $latest_data_date = mysqli_query($con, "SELECT MAX(updated_at) as latest_data_date FROM online_books");
    $latest_data_date = mysqli_fetch_assoc($latest_data_date)['latest_data_date'];

    if(empty($latest_data_date))
    {
        $latest_data_date = 0;
    }

    if (strtotime($date) > strtotime($latest_data_date)) {
                
        // Truncate the online table
        mysqli_query($con, "TRUNCATE TABLE online_books");

        // Parse CSV data and insert into online table
$books = array(); // create a new array to hold all the books data

foreach ($csv as $row) {
    $book = array(
        'id' => $row[0],
        'bookid' => $row[1],
        'title' => $row[2],
        'author' => $row[3],
        'edition' => $row[4],
        'year' => $row[5],
        'publisher' => $row[6],
        'pages' => $row[7],
        'accessionno' => $row[8],
        'classificationno' => $row[9],
        'subject' => $row[10],
        'bookno' => $row[11],
        'description' => $row[12],
        'price' => $row[13],
        'location' => $row[14],
        'qty' => $row[15],
        'member_id' => $row[16],
        'issuer' => $row[17],
        'del' => $row[18]
    );

    // Add the created_at and updated_at columns to the array with the current date and time
    $book['created_at'] = $date.' 00:00:00';
    $book['updated_at'] = $date.' 00:00:00';

    $books[] = $book; // add the book to the $books array


}

// Insert all books into the online table
foreach ($books as $book) {
    $values = "'" . implode("', '", $book) . "'";
    $query = "INSERT INTO online_books (id, bookid, title, author, edition, year, publisher, pages, accessionno, classificationno, subject, bookno, description, price, location, qty, member_id, issuer, del, created_at, updated_at) VALUES ($values)";
    mysqli_query($con, $query);
}

$msg = "CSV imported successfully!";
}

    else 
    {
        $msg = "CSV data older than the content! Your CSV is created on ".$date.".";
    }
   echo "<script>alert('$msg');</script>";
    
}
?>

