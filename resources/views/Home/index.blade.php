<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
  direction: rtl;
}

/* Add a gray background color with some padding */
body {
  font-family: Arial;
  padding: 20px;
  background: #f1f1f1;
}

/* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {
  float: right;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: right;
  width: 25%;
  padding-right: 20px;
}

/* Fake image */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  /* padding: 20px; */
}

/* Add a card effect for articles */
.card {
   background-color: white;
   padding: 20px;
   margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {
    width: 100%;
    padding: 0;
  }
}
</style>
</head>
<body>

<div class="header">
  <h2>بلاگ</h2>
</div>

<div class="row">

      @foreach ($blogs as $blog)
      <div class="leftcolumn">
      <div class="card">
        <h2>{{ $blog->title }}</h2>
        <h5>{{ $blog->title_description }}</h5>
        <div class="fakeimg"  style="height:200px;">
            <img src="{{ asset($blog->image) }}" height="200px" width="100%" alt="">
        </div>
        <p>{{ $blog->some_text }}</p>
        <p>{{ $blog->text }}</p>
      </div>
    </div>
      @endforeach

  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
      <div class="fakeimg" style="height:100px;">Image</div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
    <div class="card">
      <h3>Popular Post</h3>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div>
    </div>
    <div class="card">
      <h3>Follow Me</h3>
      <p>Some text..</p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
