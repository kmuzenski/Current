<nav class="navbar navbar-default navbar-fixed-top">
        
    <div class="container">
        <div class="navbar-header">
          
        <button type="button" class="navbar-toggle btn-custom" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="assets/imgages/wave.png" width="50"></a>     

        </div>
         
     <div id="navbar" class="collapse navbar-collapse">
            
        <ul class="nav navbar-nav">
        
        <li><a  href="index.php">Home</a></li>                                    
                            
    
        <?php
          if ($loggedin) {
            echo '<li>';
            echo '<a href="blog.php">';
            echo "Blog";
            echo '</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="profile.php">';
            echo "Profile";
            echo '</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="logout.php">';
            echo "Logout";
            echo '</a>';
            echo '</li>';
             
           } else {
            echo '<li>';
            echo '<a href="loginpage.php">';
            echo "Login";
            echo '</a>';
            echo '</li>';
            echo '<li>';
            echo '<a href="register.php">';
            echo "Register";
            echo '</a>';
            echo '</li>';
        } 
        ?>

 </nav>