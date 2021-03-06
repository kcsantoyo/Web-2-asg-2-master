<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">

        <link rel="stylesheet" href="resources/css/styles.css"></body>

        <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>

        <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    </HEAD>

<?php include 'resources/includes/connect.php'; 

                    function generatetableRow($title, $data)
                    {
                         $markup = "<tr>
                                    <td class='mdl-data-table__cell--non-numeric'><strong>".$title."</strong></td>
                                    <td class='mdl-data-table__cell--non-numeric'>".$data."</td> 
                                    </tr>";
                        return $markup;
                    }

?>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
  
    <?php include 'resources/includes/header.php'; ?>
    <?php include 'resources/includes/nav.php'; ?>

<main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            
            <div class="mdl-grid">
                
                <div class="mdl-cell mdl-cell--1-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title  mdl-color--orange">
                        <h2 class='mdl-card__title-text'>Authors</h2>
                        </div>
                        <ul class='demo-list-item mdl-list'>
                            
                        <?php
                            $sql = "select * from
                                    Authors as a
                                    JOIN BookAuthors as ba on a.AuthorID=ba.AuthorID
                                    JOIN Books as b ON ba.BookID=b.BookID
                                    WHERE b.ISBN10 LIKE '".$_GET['ISBN10']."';";
                                    
                            foreach ($pdo->query($sql) as $row) {
                                echo "<li>  ".$row['FirstName']." ".$row['LastName']."</li>";
                            }
                        ?>    
                            
                        </ul>
                    
                    
                </div>
            
            
               <div class="mdl-cell mdl-cell--1-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title  mdl-color--orange">
                        <h2 class='mdl-card__title-text'>Universities</h2>
                    </div>
                        <ul class='demo-list-item mdl-list'>
                            
                            <?php
                            $sql = "select * from
                                    Universities as u
                                    JOIN Adoptions as a ON u.UniversityID=a.UniversityID
                                    JOIN AdoptionBooks as d ON a.AdoptionID=d.AdoptionID
                                    JOIN Books as b ON d.BookID=b.BookID
                                    WHERE b.ISBN10 LIKE '".$_GET['ISBN10']."';";
                                    
                            foreach ($pdo->query($sql) as $row) {
                                echo "<li>  ".$row['Name']."</li>";
                            }
                        ?>    
                            
                        </ul>
                </div>
                
                
               <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title  mdl-color--orange">
                    
                    <?php
                    $sql = "select * 
                                from Books as b 
                                JOIN Subcategories as s ON b.SubcategoryID=s.SubcategoryID 
                                JOIN Imprints as i ON b.ImprintID=i.ImprintID
                                JOIN Statuses as p ON b.ProductionStatusID=p.StatusID
                                JOIN BindingTypes as t ON b.BindingTypeID=t.BindingTypeID
                                JOIN BookAuthors as n ON b.BookID=n.BookID
                                JOIN Authors as a ON n.AuthorID=a.AuthorID
                                WHERE b.ISBN10 LIKE '".$_GET['ISBN10']."';";
                                
                                
                                foreach($pdo->query($sql) as $row);
                                echo "<h2 class='mdl-card__title-text'>".$row["Title"]."</h2></div>";
                                echo "<div class='.mdl-card__actions'>
                                
                                <center><img src='book-images/medium/".$row["ISBN10"].".jpg'/></center>
                                
                                <table class='mdl-data-table mdl-js-data-table full-width'>";
                                echo generatetableRow("ISBN10", $row["ISBN10"]);
                                echo generatetableRow("ISBN13", $row["ISBN13"]);
                                echo generatetableRow("Copyright Year", $row["CopyrightYear"]);
                                echo generatetableRow("Subcategory", $row["SubcategoryName"]);
                                echo generatetableRow("Imprint", $row["Imprint"]);
                                echo generatetableRow("Production Status", $row["Status"]);
                                echo generatetableRow("Binding Type", $row["BindingType"]);
                                echo generatetableRow("Trim Size", $row["TrimSize"]);
                                echo generatetableRow("Page Count", $row["PageCountsEditorialEst"]);
                                echo generatetableRow("Description", $row["Description"]);
                                echo "</table>
                                </div>";
                    ?>
                    
                    </div>
                </div>
                
    
            
                
</div>

</section>            
</main>     
</div>