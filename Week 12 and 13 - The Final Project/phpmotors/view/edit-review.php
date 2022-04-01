<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <title>Update review|PHP Motors</title>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="/phpmotors/css/main.css">
</head>

<body>
       <div id="wrapper">
              <?php require_once '../snippets/header.php'; ?>
              <nav><?php echo $navList; ?></nav>
              <main>
                     <h1>Update Review</h1>
                     <?php
                     if (isset($message)) {
                            echo $message;
                     }
                     ?>
                     <p>Reviewed by <?php
                                          if (isset($_COOKIE['firstname'])) {
                                                 $first = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
                                                 $last = $_SESSION['clientData']['clientLastname'];
                                                 $screenName = $first . ' ' . $last;
                                                 echo $screenName;
                                          }



                                          ?> on <?php echo $date ?> </p>
                     <form method="post" action="/phpmotors/reviews/index.php" class="stacked-form">
                            <label for="reviewText">Review Content</label>
                            <textarea cols="50" id="reviewText" name="reviewText" autofocus required rows="5"><?php echo $review['reviewText']; ?></textarea>
                            <br>

                            <input class="button" id="formButton" name="submit" type="submit" value="Save">
                            <input name="action" type="hidden" value="edit">
                            <input name="reviewId" type="hidden" value="<?php echo $review['reviewId']; ?>">
                            <input name="clientId" type="hidden" value="<?php echo $review['clientId']; ?>">
                            <input name="invId" type="hidden" value=<?php echo "$review[invId]" ?>>
                     </form>

              </main>

              <?php include_once  "../snippets/footer.php"; ?>

       </div>
</body>

</html>