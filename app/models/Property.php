<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Property extends Eloquent {

    protected $table = 'property';

    protected $guarded = [ 'id' ];

    protected $fillable = [
        'listing_id', 'county', 'country', 'post_town', 'description', 'details_url',
        'displayable_address', 'image_url', 'thumbnail_url', 'latitude',
        'longitude', 'num_bedrooms' , 'num_bathrooms' , 'price',
        'property_type' , 'status'
    ];

}