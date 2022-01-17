<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
  direction: rtl;
}
h2,p{
    text-align: center;
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: right;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: right;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<div class="container">
  <form action="/admin/CreatePost" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="row">
    <div class="col-25">
      <label for="fname">عنوان:</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="title" placeholder="">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">شرح عنوان:</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="title_description" placeholder="">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">متن کوچک:</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="some_text" placeholder="">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">متن:</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="text" placeholder="" style="height:200px"></textarea>
    </div>
  </div>
  <br>
  <div class="row">
      <input type="file" id="lname" name="image">
  </div>
  <br>
  <br>
  <div class="row">
        <input type="submit" value="ارسال">
  </div>
  </form>
</div>

</body>
</html>


