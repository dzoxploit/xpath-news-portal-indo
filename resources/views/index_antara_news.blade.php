<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Xpath antara news</title>

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
<h2>Article Antara News</h2>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <table summary="This table shows how to create responsive tables using Tablesaw's functionality" class="table table-bordered table-hover tablesaw tablesaw-stack" data-tablesaw-mode="stack">
        <caption class="text-center">An example of a responsive table based on <a href="https://github.com/filamentgroup/tablesaw" target="_blank"> Tablesaw</a>:</caption>
        <thead>
          <tr>
            <th>Title</th>
            <th>Url</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($article as $a)
          <tr>
            <td>{{ $a['title'] }}</td>
            <td>{{ $a['url'] }}</td>
            <td>{{ $a['date'] }}</td>
            <td><a href="/detail-antara-news?url={{ $a['url'] }}&&title={{ $a['title'] }}&&date={{ $a['date'] }}">Detail</a></td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5">Data retrieved from <a href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a> and <a href="http://www.worldometers.info/world-population/population-by-country/" target="_blank">worldometers</a>.</td>
          </tr>
        </tfoot>
      </table>
    </div>
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
