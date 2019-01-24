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
        global $easyCSRF;
        $token = $easyCSRF->generate('my_token');
        $this->render('admin/create',[
            'token' => $token
        ]);
    }

    public function save() {
        global $easyCSRF;
        try {
            $easyCSRF->check('my_token', $_POST['token']);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        unset($_POST['token']);
        $this->errors = [];
        $imageUrl = $this->uploadImage($_FILES['image_url']);
        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $thumbUrl = $this->make_thumb(
            "./public/listing_images/{$imageUrl}",
            './public/listing_images_thumb/'
        );
        $data = $_POST;
        $data['listing_id'] = time();
        $data['image_url'] = $imageUrl;
        $data['thumbnail_url'] =$thumbUrl;
        Property::create($data);
        $_SESSION['success'] = 'Listing added successfully';
        header('Location: ../admin/index');
        exit;
    }

    public function edit($id=''){
        if(is_numeric($id)){
            global $easyCSRF;
            $token = $easyCSRF->generate('my_token');
            $propertyListings = Property::find($id);
            $this->render('admin/edit',[
                'token' => $token,
                'listing' => $propertyListings
            ]);
        }else {
            header('Location: ../index');
            exit;
        }
    }

    public function update() {
        global $easyCSRF;
        try {
            $easyCSRF->check('my_token', $_POST['token']);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        unset($_POST['token']);
        $this->errors = [];
        $imageUrl = null;
        $thumbUrl = null;
        if($_FILES['image_url']['name']){
            $imageUrl = $this->uploadImage($_FILES['image_url']);
        }
        if (count($this->errors) > 0) {
            $_SESSION['errors'] = $this->errors;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $thumbUrl = $this->make_thumb(
            "./public/listing_images/{$imageUrl}",
            './public/listing_images_thumb/'
        );
        $listing = $_POST;

        if(!is_null($imageUrl)){
            $listing['image_url'] = $imageUrl;
            $listing['thumbnail_url'] = $thumbUrl;
        }

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
        if(is_numeric($id)){
            $propertyListings = Property::find($id);
            $this->render('admin/show',$propertyListings);
        } else {
            header('Location: ../index');
            exit;
        }
    }

    public function delete ($id = '') {
        if(is_numeric($id)){
            Property::destroy($id);
            $_SESSION['success'] = 'Listing deleted successfully';
        }
        header('Location: ../index');
        exit;

    }

    private function make_thumb($image, $savePath) {
        $what = getimagesize($image);
        $file_name = basename($image);
        $ext   = pathinfo($file_name, PATHINFO_EXTENSION);

        $file_name = basename($file_name, ".$ext") . '_thumb.' . $ext;

        switch(strtolower($what['mime'])) {
            case 'image/png':
                $img = imagecreatefrompng($image);
                $new = imagecreatetruecolor($what[0],$what[1]);
                imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
                break;
            case 'image/jpeg':
                $img = imagecreatefromjpeg($image);
                $new = imagecreatetruecolor($what[0],$what[1]);
                imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($image);
                $new = imagecreatetruecolor($what[0],$what[1]);
                imagecopy($new,$img,0,0,0,0,$what[0],$what[1]);
                break;
            default: die();
        }
        imagejpeg($new,$savePath.$file_name);
        imagedestroy($new);
        return $file_name;
    }

}

?>
