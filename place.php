<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Traveller's Diary</title>
    
    
    <!-- Editible Grid CSS -->
    <link rel="stylesheet" href="css/grid_style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="css/font-awesome-4.1.0/css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <li>
                        <a href="#">Requests</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Toursit Places 
                    <small>Add/Update Places</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                <a href="agency.php">
                    <img class="img-responsive" src="img/p1.jpg" alt="">
                </a>
                </div>
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="img/p3.jpg" alt="">
                </a>
                </div>
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="img/p2.jpg" alt="">
                </a>
                </div>
        </div>
        <!-- /.row -->
        
         <div id="wrap">
		
			<!-- Feedback message zone -->
			<div id="message"></div>
        
        <div id="toolbar">
              <input type="text" id="filter" name="filter" placeholder="Filter :type any text here"  />
              <a id="showaddformbutton" class="button">Add new row</a>
            </div>
			<!-- Grid contents -->
			<div id="tablecontent"></div>
		
			<!-- Paginator control -->
			<div id="paginator"></div>
		</div>  

        <script src="js/editablegrid-2.1.0-b13.js"></script>   
	<script src="js/jquery-1.11.1.min.js" ></script>
        <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script src="js/place.js" ></script>
        <script type="text/javascript">
		
            var datagrid = new DatabaseGrid();
			window.onload = function() { 

                // key typed in the filter field
                $("#filter").keyup(function() {
                    datagrid.editableGrid.filter( $(this).val());

                    // To filter on some columns, you can set an array of column index 
                    //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
                  });

                $("#showaddformbutton").click( function()  {
                  showAddForm();
                });
                $("#cancelbutton").click( function() {
                  showAddForm();
                });

                $("#addbutton").click(function() {
                  datagrid.addRow();
                });

        
			}; 
		</script>

        <!-- simple form, used to add a new row -->
        <div id="addform">

            <div class="row">
                <input type="text" id="place_name" name= "place_name" placeholder="Place Name" />
            </div>

            <div class="row">
                <input type="text" id="division" name= "division"  placeholder="Division" />
            </div>

            <div class="row">
                <input type="text" id="weather" name= "weather"  placeholder="Weather" />
            </div>
            
           
            
            <div class="row tright">
              <a id="addbutton" class="button">Apply</a>
              <a id="cancelbutton" class="button">Cancel</a>
            </div>
        </div>


        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p ><center>Copyright &copy; Traveller's Diary 2014</center></p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
