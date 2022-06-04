<!DOCTYPE html>
<html lang="jp">

  <head>
    <title>アーリーリタイアシミュレーター(ver0.2)</title>
    <meta charset="utf-8"/>
    <!-- スタイルシートはここから -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Big+Shoulders+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <?php
  if(isset($_GET['year'])){
    $year  = htmlspecialchars($_GET['year']);
    $month = htmlspecialchars($_GET['month']);
    $day   = htmlspecialchars($_GET['day']);
    $savings = htmlspecialchars($_GET['savings'] * 10000);
    $cost = htmlspecialchars($_GET['cost'] * 10000);
    $investment = htmlspecialchars($_GET['investment']);
    $yield = htmlspecialchars($_GET['yield']);
    $nenkin = htmlspecialchars($_GET['nenkin']);

    $principal = htmlspecialchars($_GET['principal']);
    $interest = htmlspecialchars($_GET['interest']);
    $periods = htmlspecialchars($_GET['periods']);
  }
  else{
    $year = 1972;
    $month = 6;
    $day = 16;
    $savings = 30000000;
    $cost = 200000;
    $investment = 80;
    $yield = 5;
    $nenkin = 12;

    $principal = 33400000;
    $interest = 0.00447;
    $periods = 30;
  }

  $tmp = pow(1 + $interest, $periods);
  $pay_by_year = -$principal * $interest * $tmp / ($tmp - 1);
  ?>

  <body id="top">
    <header class="container py-3">
      <h1 class="text-center">
	<a href="index.php">アーリーリタイアシミュレーター(ver0.2)</a>
      </h1>
    </header>

    <div class="container py-4">
      <h3 class="font-weight-bold d-inline-block border-bottom border-secondary w-100 mt-1 pl-4 pb-4">
	基礎データ
      </h3> 

      <div class="row">
	<div class="col-md-8 mt-4">
	  <div class="container border p-5">
	    <form action="" method="get">

	      <div class="row form-group">
		<label for="name" class="col-md-3">誕生日</label>
		<div class="col-md-4">
		  <select name="year" class="form-control">
		    <?php
		    for($ii = 1960; $ii <= 2020; $ii++){
		      $selected = ($ii == $year) ? " selected" : "";
		      printf("<option value=\"%s\"%s>%s年</option>\n", $ii, $selected, $ii);
		    }
		    ?>
		  </select>
		</div>年

		<div class="col-md-2">
		  <select name="month" class="form-control">
		    <?php
		    for($ii = 1; $ii <= 12; $ii++){
		      $selected = ($ii == $month) ? " selected" : "";
		      printf("<option value=\"%s\"%s>%s</option>\n", $ii, $selected, $ii);
		    }
		    ?>
		  </select>
		</div>月

		<div class="col-md-2">
		  <select name="day" class="form-control">
		    <?php
		    for($ii = 1; $ii <= 31; $ii++){
		      $selected = ($ii == $day) ? " selected" : "";
		      printf("<option value=\"%s\"%s>%s</option>\n", $ii, $selected, $ii);
		    }
		    ?>
		  </select>
		</div>日
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">貯金</label>
		<div class="col-md-4">
		  <input type="number" name="savings" value="<? echo $savings/10000;?>" class="form-control">
		</div>万円
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">生活費</label>
		<div class="col-md-4">
		  <input type="number" name="cost" value="<? echo $cost/10000;?>" class="form-control">
		</div>万円/月
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">投資割合</label>
		<div class="col-md-4">
		  <input type="number" name="investment" value="<? echo $investment;?>" class="form-control">
		</div>%
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">利回り</label>
		<div class="col-md-4">
		  <input type="number" name="yield" value="<? echo $yield;?>" class="form-control">
		</div>%
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">年金</label>
		<div class="col-md-4">
		  <input type="number" name="nenkin" value="<? echo $nenkin;?>" class="form-control">
		</div>万円
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">住宅ローン</label>
		<div class="col-md-4">
		  <input type="number" name="principal" value="<? echo $principal;?>" class="form-control">
		</div>万円
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">金利</label>
		<div class="col-md-4">
		  <input type="number" name="interest" value="<? echo $interest;?>" class="form-control">
		</div>%
	      </div>

	      <div class="row form-group">
		<label for="name" class="col-md-3">回数</label>
		<div class="col-md-4">
		  <input type="number" name="periods" value="<? echo $periods;?>" class="form-control">
		</div>年
	      </div>

              <div class="row form-group justify-content-center mb-4">
		<div class="col-md-4 p-0">	
		  <input type="submit" value="　送信　" class="btn btn-secondary">
		  <input type="reset" value="リセット" class="btn btn-secondary">
		</div>
	      </div>

	    </form>
	  </div>
	</div>

	<!-- right column -->
	<div class="col-md-4 mt-4">
          <div class="container border p-5">
	    <a class="twitter-timeline" data-height="400" href="https://twitter.com/yatchie?ref_src=twsrc%5Etfw">Tweets by yatchie</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
	  </div>
	</div>
      </div>
    </div>
      
    <div class="container py-4">
      <h3 class="font-weight-bold d-inline-block border-bottom border-secondary w-100 mt-1 pl-4 pb-4">

	<?php
	$date = new DateTime('now');
	$birthday = new DateTime();
	$birthday->setDate($year, $month, $day);

	$keika = 0;

	$chart_data = '';
	$success = 0;
	$table_html = '';
	do {
	  $age = (int)(($date->format('Ymd') - $birthday->format('Ymd')) / 10000);
	  if($savings > 0)
	    $haitou = $savings * $investment / 100 * $yield / 100;
	  else{
	    $haitou = 0;
	    if($success == 0)
	      $success = $keika;
	  }

	  $seikatsuhi = -$cost * 12;
	  $nenkin_plus = $age >= 65 ? $nenkin * 12 * 10000 : 0;

	  $zankin = $principal * (1- pow(1 + $interest, $keika - $periods)) / (1 - pow(1 + $interest, - $periods));
	  if($zankin <= 0){
	    $zankin = 0;
	    $pay_by_year = 0;
	  }

	  $table_html .= sprintf("<tr>\n");

	  $table_html .= sprintf("<td align='center'>%s</td>\n", $date->format('Y'));
	  $table_html .= sprintf("<td align='center'>%s</td>\n", $age);
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($haitou));
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($nenkin_plus));
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($seikatsuhi));
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($pay_by_year));
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($zankin));
	  $table_html .= sprintf("<td align='right'>%s</td>\n", number_format($savings));
	  $table_html .= sprintf("</tr>\n");

	  $chart_data .= sprintf(",\n\t['%s', %s, %s, %s]", $date->format('Y'), $savings, $zankin, $haitou);

	  $date->modify('+1 year');
	  $savings += $haitou + $seikatsuhi + $nenkin_plus + $pay_by_year;

	} while ($keika++ < 100 and $age < 90);

	printf("判定日: %s\n", $date->format('Y年m月d日 H時i分s秒'));
	?>

      </h3>
      <div class="row">
	<div class="col-md-10 mt-4">
	  <div class="container border p-5">
	    <?php
	    if($success == 0){
	      printf("アーリーリタイア可能です。");
	    }
	    else{
	      printf("%s年後、貯金が底をつきます。", $success);
	    }
	    ?>

	    <div id="curve_chart" style="width: 100%; height: 400px"></div>

	    <table class="table table-bordered">
	      <thead class="thead-light">
		<tr>
		  <th class="text-center">年</th>
		  <th class="text-center">年齢</th>
		  <th class="text-center">配当</th>
		  <th class="text-center">年金</th>
		  <th class="text-center">生活費</th>
		  <th class="text-center">返済</th>
		  <th class="text-center">ローン残高</th>
		  <th class="text-center">貯金</th>
		</tr>
	      </thead>

	      <tbody>
		<?php echo $table_html ?>
	      </tbody>
	    </table>
	  </div>
	</div>
      </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var data = google.visualization.arrayToDataTable([
         ['年', '貯金', 'ローン残高', '配当']<? echo $chart_data ?>

       ]);

       var options = {
         title: '貯金推移',
         curveType: 'function',
         legend: { position: 'right' },
         seriesType: 'line',
	 series: {2: {type: 'bars'}}
       };

       var chart = new google.visualization.ComboChart(document.getElementById('curve_chart'));

       chart.draw(data, options);
     }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-4910672-9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-4910672-9');
    </script>
  </body>
</html>
