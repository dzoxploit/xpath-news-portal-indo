<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Xpath news Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/tablesaw.stackonly.css" rel="stylesheet"/>
        <!-- Styles -->
        <style>
           h2 {
  text-align: center;
  padding-top: 20px 0;
}

.table-bordered {
  border: 1px solid #ddd !important;
}

table caption {
	padding: .5em 0;
}

table tfoot tr td {
  text-align: center !important;
}

@media (max-width: 39.9375em) {
  .tablesaw-stack tbody tr:not(:last-child) {
    border-bottom: 2px solid #0B0B0D;
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}
        </style>
    </head>
<body>
<h2>Article News Portal</h2>

<div class="container">
  <div class="row">
  <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-3">Title : {{ $article->title }}</h3>
    <h4 class="display-3">Url : {{ $article->url }}</h4>
    <h4 class="display-3">Summary : {{ $article->summary }}</h4>
    <h4 class="display-3">Url : {{ $article->url }}</h4>
    <h4 class="display-3">PubDate : {{ $article->published_date }}</h4>
    <h4 class="display-3">Content</h4>
    <p>{{ $article->content }}</p>
  </div>
</div>

<p class="p">Didin Nur Yahya. <a href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target="_blank">See article</a>.</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/tablesaw.stackonly.js"></script>
<script type="text/javascript">
$(window).on('load resize', function () {
  if ($(this).width() < 640) {
    $('table tfoot').hide();
  } else {
    $('table tfoot').show();
  }
});

// See:
// http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions

</script>
</body>
</html>
