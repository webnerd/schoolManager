<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 1/5/14
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<table>
    <thead>
        <th>BookId</th>
        <th>Book Name</th>
        <th>ISBN</th>
        <th>Rack Number</th>
        <th>Row Number</th>
    </thead>
    <tbody>
    <?php $i=0;foreach($booksInLibrary as $book){ ?>
        <tr>
            <td><?php echo $book['id'];?></td>
            <td><?php echo $book['name'];?></td>
            <td><?php echo $book['isbn'];?></td>
            <td><?php echo $book['rack_number'];?></td>
            <td><?php echo $book['row_number'];?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

