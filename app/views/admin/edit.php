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
            <h2> Admin Edit Listing </h2>
        </div>
    </div>

    <?php if(isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li> <?php echo $error; ?> </li>
                <?php endforeach; ?>

                <?php unset($_SESSION['errors']); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <?php $listing = $data['listing']; ?>

            <form enctype="multipart/form-data" action="../../admin/update" method="post" id="form-edit">

                <div class="form-group">
                    <label for="county">County</label>
                    <input type="text" class="form-control" name="county" id="county" placeholder="County" value="<?php echo htmlspecialchars($listing->county,ENT_QUOTES,'UTF-8'); ?>">
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo htmlspecialchars($listing->country,ENT_QUOTES,'UTF-8'); ?>">
                </div>

                <div class="form-group">
                    <label for="country">Town</label>
                    <input type="text" class="form-control" name="post_town" placeholder="Town" value="<?php echo htmlspecialchars($listing->post_town,ENT_QUOTES,'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label for="outcode">Post Code</label>
                    <input type="text" class="form-control" name="out_code" id="out_code" placeholder="OX1" value="<?php echo htmlspecialchars($listing->out_code,ENT_QUOTES,'UTF-8'); ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="15" cols="5"><?php echo htmlspecialchars($listing->description,ENT_QUOTES,'UTF-8'); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="displayable_address">Displayable Address</label>
                    <input type="text" class="form-control" id="displayable_address" name="displayable_address" value="<?php echo htmlspecialchars($listing->displayable_address,ENT_QUOTES,'UTF-8'); ?>" >
                </div>

                <div class="form-group">
                    <label for="image_url">Image</label>
                    <input type="hidden" id="prev_image_url" name="prev_image_url" value="<?php echo htmlspecialchars($listing->image_url,ENT_QUOTES,'UTF-8'); ?>">
                    <input type="file" id="image_url" name="image_url" class="form-control">
                </div>

                <div class="form-group">
                    <label for="num_bedrooms">Number of bedrooms</label>
                    <select name="num_bedrooms" id="num_bedrooms" class="form-control">
                        <option value="" disabled selected>Choose number of bedrooms</option>
                        <?php for ($index=1 ; $index<16; $index++):  ?>
                            <option
                                value="<?php echo $index; ?>"
                                <?php echo $index == htmlspecialchars($listing->num_bedrooms,ENT_QUOTES,'UTF-8') ? ' selected' : '' ?>
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
                                <?php echo $index == htmlspecialchars($listing->num_bathrooms,ENT_QUOTES,'UTF-8') ? ' selected' : '' ?>
                            >
                                <?php echo $index; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($listing->price,ENT_QUOTES,'UTF-8'); ?>">
                </div>

                <div class="form-group">
                    <label for="property_type">Property Type</label>
                    <select name="property_type" id="property_type" class="form-control">
                        <option value="" disabled selected>Choose property type </option>
                        <?php $propertyTypes = ["Detached house", "End terrace house", "Semi-detached house"] ; ?>
                        <?php foreach ($propertyTypes as $propertyType):  ?>
                            <option
                                value="<?php echo $propertyType; ?>"
                                <?php echo $propertyType == htmlspecialchars($listing->property_type,ENT_QUOTES,'UTF-8') ? ' selected' : '' ?>
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
                            <?php echo htmlspecialchars($listing->status,ENT_QUOTES,'UTF-8') == 'for_sale' ? ' checked' : '' ?> >
                        For Sale
                    </label>
                    <label>
                        <input type="radio" name="status" value="for_rent"
                            <?php echo htmlspecialchars($listing->status,ENT_QUOTES,'UTF-8') == 'for_rent' ? ' checked' : '' ?> >
                        For Rent
                    </label>
                </div>

                <input type="hidden" name="listing_id" value="<?php echo $listing->listing_id ?>">
                <input type="hidden" name="token" value="<?php echo $data['token'] ?>">

                <button type="submit" class="btn btn-default">Submit</button>

            </form>
            <br><br>

        </div>
    </div>

</div>

<script
    src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
    crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<script type="application/javascript">
    // Wait for the DOM to be ready
    $(function() {
        $("form[id='form-edit']").validate({
            // Specify validation rules
            rules: {
                county: "required",
                country: "required",
                post_town: "required",
                outcode: "required",
                description: "required",
                displayable_address: "required",
                num_bedrooms: "required",
                num_bathrooms: "required",
                price: {
                    required: true,
                    digits: true
                },
                property_type: "required",
                status: "required"
            },
            // Specify validation error messages
            messages: {
                county: "County is required",
                country: "Country is required",
                post_town: "Town is required",
                outcode: "Post Code is required",
                description: "Description is required",
                displayable_address: "Address is  required",
                num_bedrooms: "Number of bedrooms is required",
                num_bathrooms: "Number of bathrooms is required",
                price: {
                    required: "Price is required",
                    digits: "Price must be digit"
                },
                property_type: "Property type is required",
                status: "Status is required"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

</body>
</html>


