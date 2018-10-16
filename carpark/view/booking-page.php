<?php
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <title>CM Parking - Booking - Page</title>

    <style>
        body{
            margin: 10px 10px 10px 10px;
        }
    </style>

    <script>
        $(document).ready(function(){
            jQuery( "#frm" ).submit(function( event ) {
                var params = jQuery(this).serialize();
                console.log(params);
                return false;
            });
        });
    </script>
  </head>
  <body>
    <h1>แบบฟอร์ม CM Parking</h1>
    <form id="frm">
    <div class="from-group row">
        <label for="email_text" class="col-sm-2 col-form-label">อีเมล์</label>
        <div class="form-group col-sm-10">
            <input type="email" class="form-control is-invalid" id="email_text" placeholder="อีเมล์" required>
        </div>
        <div class="invalid-feedback">
            โปรดระบุอีเมล์
        </div>
    </div>
    <div class="from-group row">
        <label for="name_text" class="col-sm-2 col-form-label">ชื่อผู้เดินทาง</label>
        <div class="form-group col-sm-10">
            <input type="text" class="form-control" id="name_text" placeholder="ชื่อผู้เดินทาง" required>
        </div>
    </div>
    <div class="from-group row">
        <label for="nickname_text" class="col-sm-2 col-form-label">ชื่อเล่น</label>
        <div class="form-group col-sm-10">
            <input type="text" class="form-control" id="nickname_text" placeholder="ชื่อเล่น" required>
        </div>
        </div>
    <div class="from-group row">
        <label for="phone_text" class="col-sm-2 col-form-label">เบอร์มือถือ</label>
        <div class="form-group col-sm-10">
            <input type="tel" class="form-control" id="phone_text" placeholder="เบอร์มือถือ" required>
        </div>
        </div>
    <div class="form-group row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-primary">บันทึการจอง</button>
        </div>
    </div>
    </form>
</body>
</html>