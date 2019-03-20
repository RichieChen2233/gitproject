<?php require_once('Connections/db_conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_db_conn, $db_conn);
$query_Recordset1 = "SELECT * FROM myimg ORDER BY ID DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $db_conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
    	.timeline-section{
    		position: relative;
    	}
    	.timeline-section:after{
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
			width: 3px;
			background-color: #bbb;
			left: 50%;
			transform: translateX(-50%);
    	}
    	.timeline-pointer-section{
			position: relative;
    	}
    	.timeline-pointer-section:after{
    		position: absolute;
    		content: "";
    		left: 50%;
    		transform: translateX(-50%);
    		width: 15px;
    		height: 15px;
    		background-color: #fff;
    		z-index: 1;
    		border-radius: 50%;
    		border: 4px solid #c99;
    	}
    	@media (max-width: 576px){
    		.timeline-section:after, .timeline-pointer-section:after{
    			display: none;
    		}
    	}
    </style>
  </head>
<body>
  	<div class="timeline-section">
	    <div class="container">
        
        
        
        
        
        
        
	    	<?php do { ?>
    	    <div class="row timeline-pointer-section
            <?php
			
				if($row_Recordset1['ID']%2 == 0){
					echo "flex-row-reverse";
				}
			
			?>
            
            
            ">
	    	    <div class="col-sm-6">
	    	      <div class="text">
	    	        <h3><?php echo $row_Recordset1['Title']; ?></h3>
	    	        <p><?php echo $row_Recordset1['Content']; ?></p>
	    	        </div>
	    	      </div>
	    	    <div class="col-sm-6">
	    	      <div class="pimg">
	    	        <img src="<?php echo $row_Recordset1['Url']; ?>" class="img-fluid" alt="">
	    	        </div>
	    	      </div>
    	      </div>
	    	  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
            
            
            
            
	    </div>  		
  	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
