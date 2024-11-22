<?php include '../view/header.php'; ?>
<main>
    <h1>Flight List</h1>

    <section>
        <table>     <!-- Change this so it works with the database -->
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <!-- The commented code should create a good looking table once its changed to work with the database -->
             <!--
            <?php foreach ($products as $product) :?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td class="right"><?php echo $product['listPrice']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_product">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $product['categoryID']; ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form></td>
                <td><form action = "." method = "post">
                    <input type = "hidden" name = "action" value = "edit_product">
                    <input type = "hidden" name = "product_id" value = "<?php echo $product['productID']; ?>">
                    <input type = "hidden" name = "category_id" value = "<?php echo $product['categoryID']; ?>">
                    <input type = "submit" value = "Edit">
                </form> </td>
                
            </tr>
            <?php endforeach; ?>
            -->

        </table>
        <!-- To be honest, I don't know what this does. We should keep it until the table is made just in case
        <p class="last_paragraph">
            <a href="?action=show_add_form">Add Product</a>
        </p> 
        -->
    </section>
</main>
<?php //include '../view/footer.php';   Kept in case we want a footer?>