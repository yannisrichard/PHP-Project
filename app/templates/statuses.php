<!DOCTYPE html>
<html>
<head><?php include 'header.php'; ?></head>
<body>
<div>
    <div class="page-header">
        <div class="form-group" style="display:inline-block;">
            <h1>
                <label>Welcome to the Tweeter made by Yannis</label>
            </h1>
        </div>
        <div class="pull-right" style="display:inline-block;">
            <?php
            if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated'])
                echo "<a href='/logout'><input type='button' class='btn btn-default' value=Disconnect></a>";
            else {
                echo "<a href='/login'><input type='button' class='btn btn-default' value='Connect'></a></br>";
                echo "<a href='/register'><input type='button' class='btn btn-default' value='Register'></a>";
            }
            ?>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-6">
            <h4>
                <label>
                    <?php
                    if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated']) {
                        echo "Hello ".$_SESSION['user_name'] . " , </br>";
                        echo "<a href='/statuses?user=".$_SESSION['user_id']."'>View my Tweets</a>";
                    } else
                        echo "Hello Anonymous";
                    ?>
                    </br><a href="/statuses?orderBy=status_date$desc&limit=0$5" >View the 5 last Tweets</a>
                </label>
            </h4>
            <h2>Post a new status : </h2>
            <form action="/statuses" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="message" class="col-sm-2 control-label sr-only" >Message:</label>
                <div class="col-sm-12">
                    <textarea name="message" placeholder="Let's tweet!" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <input type="submit" value="Tweet!" class="btn btn-primary">
            </form>
        </div>

        <div class="list-group col-sm-6">
            <blockquote>
            <ul>
               <?php foreach($parameters['array'] as $status) : ?>
                    <a href="/statuses/<?= $status->getId() ?>" class="list-group-item">
                        <p class="list-group-item-text"><?= $status->getText() ?></p>
                        <h4 class="list-group-item-footing">
                            <small><?= "by ". $status->getOwner()->getName() . " (".$status->getDate()->format('Y-m-d H:i:s') . ") "?></small>
                        </h4>
                    </a>
                <?php endforeach; ?>
            </ul>
        </blockquote>
    </div>
</div>
</body>
</html>
