
 <?php 
    foreach($result as $key=>$value)
    {
        ?>
        <tr>
            <td><?php  echo ($key+1); ?></td>
            <td><?php  echo $value['category_name']; ?></td>
            <td>Edinburgh</td>
            <td>61</td>
        </tr>
        <?php
    }
?>

  