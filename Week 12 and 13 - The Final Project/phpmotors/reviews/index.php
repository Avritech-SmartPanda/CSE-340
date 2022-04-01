<?php
// ===========================================================
// REVIEWS CONTROLLER
// =========================================================== 
session_start();

// import required php files into scope
require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList  = createNavList();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
$clientId = $_SESSION['clientData']['clientId'];
// Switch on the action
switch ($action) {
    case 'add-review':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientIssdd = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewText) || empty($invId) || empty($clientId)) {
            $message = '<p class="error">All fields are required</p>';
            setcookie('reviewFormMessage', $message, strtotime('+1 year'), '/');

            header("Location: /phpmotors/vehicles/index.php?action=details&invId=$invId");
            exit;
        }

        // save review
        $saveResult = addReview($reviewText, $invId, $clientId);

        //Check and report the result
        if ($saveResult === 1) {
            $reviewFormMessage = "<p class='server-message'>Review added!</p>";
            setcookie('reviewFormMessage', $reviewFormMessage, strtotime('+1 year'), '/');

            setcookie('reviewFormMessage', '', strtotime('-1 year'), '/');
            header("Location: /phpmotors/vehicles/index.php?action=details&invId=$invId");
        } else {
            $reviewFormMessage = '<p class="error">Failed to  add review. Please try again.</p>';
            setcookie('reviewFormMessage', $reviewFormMessage, strtotime('+1 year'), '/');
            header("Location: /phpmotors/vehicles/index.php?action=details&invId=$invId");
        }
        exit;
        break;

        //============================================================================
    case 'edit-review':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $review = getReviewById($reviewId);
        $client = $_SESSION['clientData']['clientLevel'];
        $date = date("F jS, Y", strtotime($review['reviewDate']));
        include '../view/edit-review.php';
        break;
        //============================================================================
    case 'delete-review':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $review = getReviewById($reviewId);
        $client = $_SESSION['clientData']['clientLevel'];
        include '../view/delete-review.php';
        break;
    case 'delete':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);

        if ($deleteResult) {
            $message = "<p class='server-message'>Review deleted!</p>";
            $_SESSION['message'] = $message;
            header('location: ../reviews/');
            exit;
        } else {
            $message = "<p class='error'>Oops, review was not deleted. Try again.</p>";
            $_SESSION['message'] = $message;
            include '../view/delete-review.php';
            exit;
        }
        break;
    case 'edit':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewText) || empty($clientId) || empty($invId) || empty($reviewId)) {
            $message = '<p class="error">All fields are required.</p>';
            include  '../view/edit-review.php';
            exit;
        }

        $editedReviewResult = updateReview($reviewText, $clientId, $invId, $reviewId);

        if ($editedReviewResult) {
            $editMessage = "<p class='server-message'>Review updated!</p>";
            $_SESSION['message'] = $editMessage;
            header('location: ../reviews/');
            exit;
        } else {
            $message = "<p class='form-error'>Oops, couldn't update review. Please try again.</p>";
            include  '../view/edit-review.php';
            exit;
        }
        break;


    default:
        $clientId = $_SESSION['clientData']['clientId'];
        $reviewList = getClientReviews($clientId);

        if (count($reviewList) > 0) {
            $reviewsDisplay = adminReviewDisplay($reviewList);
        } else {
            $message = '<p class="error">No reviews found.</p>';
        }
        include  '../view/admin.php';
        break;
}
