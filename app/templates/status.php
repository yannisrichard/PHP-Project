<?php
    $status = $parameters['status'];
?>
<!DOCTYPE html>
<html>
<head><?php include 'header.php'; ?></head>
<body>
    <div class="page-header" >
        <h1>You are reading the tweet number <?= $status->getId() ?> </h1>
       </div>

    <div class="container">
        <p>
        <p>It has been writen by <?= $status->getOwner()->getName() ?></p>
        <p>It has been published on the <?= date_format($status->getDate(), 'd/m/Y g:i A') ?></p>
        <blockquote><?= $status->getText() ?></blockquote>
        </p>
        <?php if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated']
            && $_SESSION['user_id'] === $status->getOwner()->getId()) {
            echo "<form action='/statuses/".$status->getId()."' method='POST'>";
            echo "	<input type='hidden' name='_method' value='DELETE'>";
            echo "  <input type='hidden' name='_method' value='DELETE'>";
            echo "  <input type='submit' value='Delete'>";
            echo "</form>";
        }?>
        <a href="/statuses">Go back to statuses list</a>
    </div>
</body>
</html>
