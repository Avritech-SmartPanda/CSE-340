<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <title>Delete review|PHP Motors</title>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="/phpmotors/css/main.css">
</head>

<body>
       <div id="wrapper">
              <?php require_once '../snippets/header.php'; ?>
              <nav><?php echo $navList; ?></nav>
              <main>
                     <h1>Delete Review</h1>
                     <?php
                     if (isset($message)) {
                            echo $message;
                     }
                     ?>
                     <p>Are you sure? This action cannot be undone!</p>
                     <form method="post" action="/phpmotors/reviews/index.php" class="stacked-form">
                            <label for="reviewText">Review Content</label>
                            <textarea cols="50" id="reviewText" name="reviewText" autofocus required rows="5" disabled><?php echo $review['reviewText']; ?></textarea>
                            <br>

                            <input class="button" id="formButton" name="submit" type="submit" value="Delete">
                            <input name="action" type="hidden" value="delete">
                            <input name="reviewId" type="hidden" value="<?php echo $review['reviewId']; ?>">
                            <input name="clientId" type="hidden" value="<?php echo $review['clientId']; ?>">
                            <input name="invId" type="hidden" value=<?php echo "$review[invId]" ?>>
                     </form>

              </main>

              <?php include_once  "../snippets/footer.php"; ?>

       </div>
</body>

</html>