<?php include '../view/header.php'; ?>
<main>
    <h1>Add Ticket</h1>
    <form action="index.php" method="post" id="add_ticket_form">
        <input type="hidden" name="action" value="add_ticket">

        <!--Remember to change the values here to correspond with the database's -->

        <label>Code:</label>
        <input type="text" name="code" />
        <br>

        <label>Name:</label>
        <input type="text" name="name" />
        <br>

        <label>List Price:</label>
        <input type="text" name="price" />
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Ticket" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_flights">View Ticket List</a>
    </p>

</main>
<?php // include '../view/footer.php'; ?>