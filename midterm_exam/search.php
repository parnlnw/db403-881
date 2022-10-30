<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search product by category</title>
</head>
<body>
  <header>
    <form action="product.php" method="get">
      <label for="category">
        <select name="category" id="category">
        <p>
            <fieldset>
                <legend>CategoryName : </legend>
              action="search.php">
                <input type="checkbox" name="CategoryName" value="Beverages">
                <input type="checkbox" name="CategoryName" value="Condiments">
                <input type="checkbox" name="CategoryName" value="Confections">
                <input type="checkbox" name="CategoryName" value="Dairy Products">
                <input type="checkbox" name="CategoryName" value="Grains/Cereals">
                <input type="checkbox" name="CategoryName" value="Meat/Poultry">
                <input type="checkbox" name="CategoryName" value="Produce">
                <input type="checkbox" name="CategoryName" value="Seafood">
            </fieldset>
        </p>
          <!-- add options hear ex.
          <option value="1">Beverages</option>
          -->
        </select>
      </label>
      <input type="submit" value="Search" name="submit">
    </form>

  </header>
</body>
</html>