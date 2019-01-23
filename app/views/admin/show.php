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
            <a class="navbar-brand" href="../../">Zoopla Crud</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../fetch">Fetch Listings</a></li>
                <li><a href="../../admin/index">Show Listings</a></li>
                <li><a href="../../admin/create">Add Listings</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row">
        <div class="text-center">
            <h2> Show Listing </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            Image
            <img
                width="400"
                height="400"
                class="img-responsive" alt="listing image"
                src="<?php echo filter_var($data['thumbnail_url'], FILTER_VALIDATE_URL)
                    ? $data['thumbnail_url'] : "../../public/listing_images_thumb/{$data['thumbnail_url']}"  ?>" >
        </div>

        <div class="col-md-8 col-md-offset-4">
            Thumbnail
            <img
                width="150"
                height="150"
                class="img-responsive"
                alt="listing image"
                src="<?php echo filter_var($data['thumbnail_url'], FILTER_VALIDATE_URL)
                    ? $data['thumbnail_url'] : "../../public/listing_images_thumb/{$data['thumbnail_url']}"  ?>"
                >
        </div>

        <br>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                <div class="form-group">
                    <label for="county">County</label>
                    <input type="text" class="form-control" name="county" id="county" placeholder="County" value="<?php echo $data->county ?>">
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $data->country ?>">
                </div>

                <div class="form-group">
                    <label for="country">Town</label>
                    <input type="text" class="form-control" name="post_town" placeholder="Town" value="<?php echo $data->post_town ?>">
                </div>

                <div class="form-group">
                    <label for="outcode">Post Code</label>
                    <input type="text" class="form-control" name="out_code" id="out_code" placeholder="OX1" value="<?php echo $data->out_code ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="15" cols="5"><?php echo $data->description?></textarea>
                </div>

                <div class="form-group">
                    <label for="displayable_address">Displayable Address</label>
                    <input type="text" class="form-control" id="displayable_address" name="displayable_address" value="<?php echo $data->displayable_address ?>" >
                </div>

                <div class="form-group">
                    <label for="num_bedrooms">Number of bedrooms</label>
                    <select name="num_bedrooms" id="num_bedrooms" class="form-control">
                        <option value="" disabled selected>Choose number of bedrooms</option>
                        <?php for ($index=1 ; $index<16; $index++):  ?>
                            <option
                                value="<?php echo $index; ?>"
                                <?php echo $index == $data->num_bedrooms ? ' selected' : '' ?>
                            >
                                <?php echo $index; ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="num_bathrooms">Number of bathrooms</label>
                    <select name="num_bathrooms" id="num_bathrooms" class="form-control">
                        <option value="" disabled selected>Choose number of bathrooms</option>
                        <?php for ($index=1 ; $index<16; $index++):  ?>
                            <option
                                value="<?php echo $index; ?>"
                                <?php echo $index == $data->num_bathrooms ? ' selected' : '' ?>
                            >
                                <?php echo $index; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $data->price; ?>">
                </div>

                <div class="form-group">
                    <label for="property_type">Property Type</label>
                    <select name="property_type" id="property_type" class="form-control">
                        <option value="" disabled selected>Choose property type </option>
                        <?php $propertyTypes = ["Detached house", "End terrace house", "Semi-detached house"] ; ?>
                        <?php foreach ($propertyTypes as $propertyType):  ?>
                            <option
                                value="<?php echo $propertyType; ?>"
                                <?php echo $propertyType == $data->property_type ? ' selected' : '' ?>
                            >
                                <?php echo $propertyType; ?>

                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="radio">
                    <label for="status">Select one status:</label>
                    <label>
                        <input type="radio" name="status" value="for_sale"
                            <?php echo $data->status == 'for_sale' ? ' checked' : '' ?> >
                        For Sale
                    </label>
                    <label>
                        <input type="radio" name="status" value="for_rent"
                            <?php echo $data->status == 'for_rent' ? ' checked' : '' ?> >
                        For Rent
                    </label>
                </div>

                <p>Created At : <?php echo date('l, F dS, Y H:i:s', strtotime($data->created_at)); ?> </p>
                <p>Updated At : <?php echo date('l, F dS, Y H:i:s', strtotime($data->updated_at)) ?> </p>

                <br><br>

        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>


