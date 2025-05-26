<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Product</title>
    <link rel="stylesheet" href="css/AdminStyle.css">
</head>
<body>

<?php
	
	// Connect to the database
	$conn = mysqli_connect('localhost', 'root', '', 'shop_DB');

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    // Get form data
	    $category = $_POST['category'];
	    $name = $_POST['name'];
	    $price = $_POST['price'];
	    $stock_quantity = $_POST['stock_quantity']; // Adding stock quantity input

	    // Validate and sanitize data
	    $category = htmlspecialchars($category);
	    $name = htmlspecialchars($name);
	    $price = floatval($price);
	    $stock_quantity = intval($stock_quantity);

	    // Handle image upload
	    $targetDirectory = "uploads/"; // Change this to the directory where you want to store the images
	    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

	    // Check if the image file is an actual image or fake image
	    $check = getimagesize($_FILES["image"]["tmp_name"]);
	    if ($check === false) {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }

	    // Check file size
	    if ($_FILES["image"]["size"] > 500000) {
	        echo "Sorry, your file is too large.";
	        $uploadOk = 0;
	    }

	    // Allow certain file formats
	    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	        $uploadOk = 0;
	    }

	    if ($uploadOk == 0) {
	        echo "Sorry, your file was not uploaded.";
	    } else {
	        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
	            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
	        } else {
	            echo "Sorry, there was an error uploading your file.";
	        }
	    }

	    // Insert into the database if the image upload was successful
	    if ($uploadOk) {
	        // Insert into the database
	        $imagePath = $targetFile; // Save the image path in the database

	        $sql = "INSERT INTO products (category_id, name, price, stock_quantity, image_path) VALUES ('$category', '$name', $price, $stock_quantity, '$imagePath')";

	        if ($conn->query($sql) === TRUE) {
	            echo "Product added successfully!";
	        } else {
	            echo "Error: " . $sql . "<br>" . $conn->error;
	        }

	        $conn->close();
	    }
	}
?>

<div class="admin-container">
    <h2>Add New Product</h2>
    <form action="add_item.php" method="post" enctype="multipart/form-data">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="1">Sneakers</option>
            <option value="2">Boots</option>
            <option value="3">Sandals</option>
            <option value="4">Formal Shoes</option>
        </select>

        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Product Price (LKR):</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="stock_quantity">Stock Quantity:</label>
        <input type="number" name="stock_quantity" id="stock_quantity" required>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit">Add Product</button>
    </form>
</div>

</body>
</html>
