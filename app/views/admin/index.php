<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Zoopla Crud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../">Zoopla Crud</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../fetch">Fetch Listings</a></li>
                <li><a href="../admin/index">Show Listings</a></li>
                <li><a href="../admin/create">Add Listings</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>


<div class="container">

    <div class="row">
        <div class="text-center">
            <h2> All Property Listings </h2>
        </div>
    </div>

    <?php $listings = $data['listings']; ?>

    <?php if(count($listings) > 0): ?>
        <div class="row">
            <?php foreach ($listings as $listing ): ?>
                <div class="col-md-6">

                    <div class="jumbotron">

                        <h4>Listing Id :<?php echo($listing->listing_id) ?></h4>

                        <h4>County :<?php echo($listing->county) ?></h4>

                        <h4>Town :<?php echo($listing->post_town) ?></h4>

                        <a class="btn btn-success btn-lg" href="./show/<?php echo $listing->id; ?>" role="button">Details</a>

                        <a class="btn btn-primary btn-lg" href="./edit/<?php echo $listing->id; ?>" role="button">Edit</a>

                        <a class="btn btn-danger btn-lg" href="./delete/<?php echo $listing->id; ?>" role="button">Delete</a>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>


