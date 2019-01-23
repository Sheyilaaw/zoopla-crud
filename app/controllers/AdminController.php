<?php

class AdminController extends Controller {

    private $errors;

    public function index() {
        $propertyListings = Property::all();
        $this->render('admin/index', [
            'listings' => $propertyListings
        ]);
    }

    public function create() {
        $this->render('admin/create');
    }

    public function save() {
        $this->errors = [];
        $imageUrl = $this->uploadImage($_FILES['image_url']);
        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $data = $_POST;
        $data['listing_id'] = time();
        $data['image_url'] = $imageUrl;
        Property::create($data);
        $_SESSION['success'] = 'Listing added successfully';
        header('Location: ../admin/index');
        exit;
    }

    public function edit($id=''){
        $propertyListings = Property::find($id);
        $this->render('admin/edit',$propertyListings);
    }

    public function update() {
        $this->errors = [];
        if($_FILES['image_url']['name']){
            $imageUrl = $this->uploadImage($_FILES['image_url']);
        }

        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $listing = $_POST;

        $listing['image_url'] = $imageUrl;
        $listingId = $listing['listing_id'];


        unset($listing['listing_id']);
        unset($listing['prev_image_url']);

        Property::where('listing_id',$listingId)->update($listing);
        $_SESSION['success'] = 'Listing updated successfully';
        header('Location: ../admin/index');
        exit;
    }

    private function uploadImage($image) {
        $fileTmpPath = $image['tmp_name'];
        $fileName = $image['name'];
        //$fileSize = $image['size'];
        //$fileType = $image['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = sha1(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (!in_array($fileExtension, $allowedfileExtensions)) {
            $this->errors[] = 'Image format not supported';
            return;
        }

        // directory in which the uploaded file will be moved
        $uploadFileDir = './public/listing_images/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return $newFileName;
        } else {
            $this->errors[] = 'There was some error moving the file to upload directory.';
        }
        return null;
    }

    public function show ($id = '') {
        $propertyListings = Property::find($id);
        $this->render('admin/show',$propertyListings);
    }

    public function delete ($id = '') {
        Property::destroy($id);
        $_SESSION['success'] = 'Listing deleted successfully';
        header('Location: ../admin/index');
        exit;
    }

    public function imageResize($imageResourceId,$width,$height) {
        $targetWidth =250;$targetHeight =250;
        $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
        return $targetLayer;
    }

}

?>
