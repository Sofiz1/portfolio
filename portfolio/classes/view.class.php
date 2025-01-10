<?php

class View extends Controler{
    public function pData(){
       $data = $this->PController();
       echo '<div class="container">';
       while($row = $data->fetch_assoc()){
        $id = $row['id'];
        $image = $row['image'];
        $title = $row['title'];
        $price = $row['price'];
        echo '<div class="item">
                    <img src="',$image,'" alt="">
                    <h1>',$title,'</h1>
                    <h2>',$price,'</h2>
                    <button><a href="detail.php?id=',$id,'">Details</a></button>
                </div>';
       }
            
       echo' </div>';

    }
    
    public function pAdmin(){
        $data = $this->PController();
        
        echo '
        <table>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>update</th>
                <th>Delete</th>
                
            </tr>';
        while($row = $data->fetch_assoc()){
            $id = $row['id'];
            $img = $row['image'];
            $title = $row['title'];
            $price = $row['price'];
        echo '
        <tr>
            <td>',$id,'</td>
            <td>',$img,'</td>
            <td>',$title,'</td>
            <td>',$price,'</td>
            <td><a href="">Update</a></td>
            <td><a href="<?php echo DelProducts(',$id,');?>">Delete</a></td>
        </tr>
        
        ';
        }
            

        echo'
            
        </table>
        
        ';
    }
    public function DelProducts($id){
       $data= $this->DelP(',$id,');
       return $data;
    }
}

?>

