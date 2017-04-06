<?php
require ('auth.php');
$title = 'Upload LOGO';

require('db.php');

// inserting the header
require_once('header.php'); ?>
    <div class="col-sm-offset-2">
        <form action="save-upload.php" method="post" enctype="multipart/form-data" class="form-group">
            <div class="form-group">
							  <label for="anyFile">Choose any File: </label>
                <input name="anyFile" id="anyFile" type="file" />
                <button class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>

<?php

require_once('footer.php');
?>
