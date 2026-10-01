<?php
    require_once("bootstrap.php");


    if(isset($_POST['action'])){
        $sql = "SELECT * FROM prodotto WHERE catP !='' AND catS!=''";
        if(isset($_POST['category'])){
            $category = implode("','", $_POST['category']);
            $sql .= "AND catP IN('".$category."')";
        }

        if(isset($_POST['franchise'])){
            $franchise = implode("','", $_POST['franchise']);
            $sql .= "AND catS IN('".$franchise."')";
        }

        $result = $conn->query($sql);
        $output = '';

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){

                $output .= '
                    <div class="col-md-3 mb-2">
                        <div class="card-deck h-100">
                            <div class="card border-secondary">
                                <img src="upload/Prodotti'.$row["6"].'" class="card-img-top p-2" alt="...">
                                <!-- lui ha messo il nome del prodotto in card-img-overlay -->
                                <h6 class="text-light bg-info text-center rounded m-3 p-1">'.$row["4"].'</h6>
                                <div class="card-body">
                                    <h4 class="card-title">'.$row["1"].'</h4>
                                    <p>Descrizione Prodotto</p>
                                    <button><a href="#">Add to Cart</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            $output = "<h3>No Products Found!</h3>";
        }
        echo $output;
    }
?>