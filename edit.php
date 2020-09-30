<?php
	session_start();
	function redirect($url){
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}
	// if($_SESSION['login']!="yogesh"){
	// 	redirect("../index.php");
	// }
?>
<?php
	require 'sql_data.php';
	$link = mysqli_connect($servername, $username, $password, $dbname);
	 
	// Check connection
	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1c1c1c">
    <link rel="icon" sizes="192x192" href="icon.png">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
	<title>Edit</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');
		body{
			background-color: #1c1c1c;
		}
		table{
			color: white;
			font-family: montserrat;
			border-color: white;
		}
		th{
			border: solid 1.5px #ffffff;
			padding: 10px 22px;
			border-radius: 50px;
        }
        thead{
            color: #f00;
        }
		td{
			text-align: center;
			border: solid 1.5px #ffffff;
			padding: 10px 15px;
			border-radius: 50px;
		}
		.tf{
			background-color: transparent;
			border: none;
			color: white;
			font-family: montserrat;
			width: 100px;
		}
		#sub{
			background-color: transparent;
			border: none;
			font-family: montserrat;
			font-size: 20px;
			color: inherit;
			margin: -12px -30px;
			padding: 12px 30px;
            width: 107%;            
		}
		#sub:focus{
			outline: none;
        }
        #save{
            color: #fff;
            font-weight: bolder;
            transition-duration: 0.4s;
        }
        #save:hover{
            color:#1c1c1c;
            background: white;
        }
		#result{
			margin-top: 250px;
			color: white;
			font-family: montserrat;
			font-size: 15px;
		}
		#clr{
			width: 50px;
		}
		.srn{
			width: 20px;
			text-align: center;
		}
		.op{
			color: white;
			background-color: #1c1c1c;
			border: none;
			outline: none;
		}
		.slct{
			background: transparent;
			border: solid 1.5px white;
			border-radius: 50px;
			padding: 5px 14px;
			font-size: 15px;
			color: white;
			font-family: montserrat;
        }
        #search{
            width: 950px;
            padding: 8px 16px;
            margin: 10px 0 20px 0;
        }
        #search:focus{
            outline: none;
        }
        .ro:focus{
            outline:none;
        }
        input[type="password"]:hover{
            cursor: pointer;
        }
        .num{
            text-align: center;
        }
        .no_result{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            font-size: 25px;
			color: white;
			font-family: montserrat;
        }
        #back{
            padding: 7px 15px;
            color: white;
			font-family: montserrat;
            border: 1.5px solid #fff;
            border-radius: 50px;
            margin: 10px 0 20px 0;
            display: inline-block;
            cursor: pointer;
        }
        #back:hover{
            color: #1c1c1c;
            background: #fff;
        }
	</style>
</head>
<body>    
	<center>
        <span id="back" onclick="window.location.href='Muse/stations.html'">BACK</span>
		<?php
			require 'sql_data.php';

			$link = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if($link === false){
			    die("ERROR: Could not connect. " . mysqli_connect_error());
			}
			
			// Attempt select query execution
			$sql = "SELECT * FROM admin";
			if($result = mysqli_query($link, $sql)){
			    if(mysqli_num_rows($result) > 0){
                    echo "<input type=\"text\" name=\"search\" id=\"search\" placeholder=\"Search\" class=\"slct\"></input>";
                    echo "<form method=\"post\" action=\"edit_validate.php\" onsubmit=\"return confirm('Do you really want to save the changes?');\">";
			        echo "<table border=0 cellspacing=5 cellpadding=0 id=\"stations_table\">\n";
                    echo "\t<tr>";                    
	                echo "<thead><th>Sr No</th>";
	                echo "<th>Station Name</th>";
	                echo "<th>Station ID</th>";
	                echo "<th>Password</th>";
	                echo "<th>Items</th>";
	                echo "<th>Location</th>";
	                echo "<th>Admin</th>";
	                echo "<th onclick=\"verify()\">Delete</th>";
		            echo "</tr></thead><tbody>\n";
			        $ids=array();
			        while($row = mysqli_fetch_array($result)){
			        	$count=$row['sr_no'];
			            echo "\t<tr id=\"row".$count."\" class=\"rows\">\n";
			            array_push($ids,$count);
		                echo "\t\t<td><input type=\"text\" name=\"sr_no".$count."\" value=\"" .$row['sr_no'] . "\" class=\"tf ro num srn\"  readonly></input></td>\n";
		                echo "\t\t<td><input type=\"text\" name=\"sname".$count."\" value=\"" . $row['station_name'] . "\" class=\"tf\"></input></td>\n";
		                echo "\t\t<td><input type=\"text\" name=\"sid".$count."\" value=\"" . $row['station_id'] . "\" class=\"tf ro\" readonly></input></td>\n";
		                echo "\t\t<td><input type=\"password\" name=\"password".$count."\" value=\"" . $row['password'] . "\" class=\"tf\"></input></td>\n";
		                echo "\t\t<td><input type=\"text\" name=\"items".$count."\" value=\"" . $row['items'] . "\" class=\"tf ro num\" readonly></input></td>\n";
		                echo "\t\t<td><input type=\"text\" name=\"location".$count."\" value=\"" . $row['location'] . "\" class=\"tf\"></input></td>\n";
		                echo "\t\t<td><input type=\"text\" name=\"admin".$count."\" value=\"" . $row['admin'] . "\" class=\"tf\"></input></td>\n";
		                echo "\t\t<td class=\"cbox\"><input type=\"checkbox\" name=\"delete".$count."\" value=\"yes\" class=\"cb\" onclick=\"verify()\"></td>\n";
			        }
			        // Free result set
                    mysqli_free_result($result);
                    $_SESSION["ids"]=$ids;
                    echo "</tbody>
                    <tr id=\"save\">
                        <th colspan=\"8\"><input type=\"submit\" value=\"SAVE\" id=\"sub\"></td>
                    </tr>
                    </table>
                    </form>";
			    } else{
			        echo "<span class=\"no_result\">Seems like there's no station data to show!</span>";
			    }
			} else{
			    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
			// Close connection
			mysqli_close($link);			
        ?>
    </center>
    <span class="no_result" id="nr2"></span>
    <script type="text/javascript">
		var v=0;
		var submit = document.getElementById("sub");
		var checkboxes = document.getElementsByClassName("cb");
		for(var i=0;i<checkboxes.length;i++){
			checkboxes[i].disabled=true;
		}
		function verify(){
			if(v==0){
                var ans = prompt("Do you really want to enable delete options?\nType \"YES\" to continue");
                if(ans){
                    if(ans.toLowerCase().trim()=="yes"){
                        for(var i=0;i<checkboxes.length;i++){
                            checkboxes[i].disabled=false;
                        }
                        v=1;
                    }else{
                        alert("Invalid Input!");
                    }
                }
				
			}
        }
        $('.cbox').click(function(){
            verify();
        });
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $('.rows').hide();            
            var found = 0;
            $("#stations_table tr td input").filter(function(){
                $(this).parent().css("border-color","#fff");
                $(this).css("color","#fff");
                if($(this).parent().attr("class")!="cbox"){
                    if($(this).val().toLowerCase().indexOf(value) > -1){
                        if($('#search').val().length != 0){
                            $(this).parent().css("border-color","#0f0");
                            $(this).css("color","#0f0");
                        }
                        var rid = $(this).parent().parent().attr('id');
                        $('#'+rid).show();
                        found++;
                    }else{
                        $(this).parent().css("border-color","#fff");
                        $(this).css("color","#fff");
                    }
                }
            });            
            if(found==0){
                $('#stations_table').hide();
                $('#nr2').html('No result found!');
            }else{
                $('#stations_table').show();
                $('#nr2').html('');
            }
        });
        $('input[type="password"]').click(function(){
            if(($(this).attr("type")=="password")){
                if(confirm("Show password?"))
                    $(this).attr("type","text");
            }else{
                if(confirm("Hide password?"))
                $(this).attr("type","password");
            }
        });
	</script>
</body>
</html>