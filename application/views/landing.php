<style type="text/css">
	#member-sub-menu { display:none; }

	#container { background: transparent url("<?= base_url('/images/landing/bg.jpg?v=1') ?>") no-repeat; }

	#content { background:none !important; top:0px !important; }

	#box { top:72px !important; left: 572px !important; }

	#footer { display:none !important; }
</style>
<script type="text/javascript" src="<?= base_url('/js/lib/jcountdown/jquery.jcountdown.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('/js/lib/jcountdown/jcountdown.css') ?>" />
<style type="text/css">
.jCountdown .group .label{
	position:relative;
	left:50%;
	padding:0px;
	margin:0px 0px 0px -40px;
	width:80px;
}
div#box{ padding:11px;}
</style>
<?php
	$finish_date = new DateTime('2013-10-20');
	$now_date = new DateTime();

	$tz = date_offset_get($now_date) / 3600;

	$diff = intval($finish_date->format('U')) - intval($now_date->format('U'));
?>
<script type="text/javascript">
$(function(){
	var countdownBox = $("#countdown-box");
	countdownBox.jCountdown({
		timeText : '<?= $finish_date->format('Y/m/d H:i:s') ?>',
		timeZone : <?= $tz ?>,
		style : "crystal",
		color : "black",
		width : 0,
		textGroupSpace : 15,
		textSpace : 0,
		reflection : false,
		reflectionOpacity : 10,
		reflectionBlur : 0,
		dayTextNumber : 2,
		displayDay : true,
		displayHour : true,
		displayMinute : true,
		displaySecond : true,
		displayLabel : true,
		onFinish : function() {}
	});
	// fix ie7 bug
	if($.browser.msie && $.browser.version<=7){
		var intervalLebel = setInterval(function(){
			if(countdownBox.find('.label').length>0){
				$('.label').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
				clearInterval(intervalLebel);
			}
		}, 200);
	}
});
</script>
</script>
<div id="content-body" class="page-home">

	<div id="content">
		<div id="box">
			<object width="355" height="292">
		            <param name="movie" value="http://www.youtube.com/v/_-xEV9f1xE0?version=3&amp;hl=en_US&amp;rel=0">
		            </param>
		            <param name="allowFullScreen" value="true">
		            </param>
		            <param name="allowscriptaccess" value="always">
		            </param>
		            <param name="wmode" value="transparent">
		            </param>
		            <embed width="355" height="292" src="http://www.youtube.com/v/_-xEV9f1xE0?version=3&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent">
		            </embed>
	            </object>
		</div>
		<div id="countdown-box" style="position:absolute; width:300px; height:75px; left:232px; top:577px;">
		</div>
	</div>
	<a href="https://www.facebook.com/boostplus?hc_location=stream" target="_blank" style="position:absolute; bottom:40px; right:10px; width:100px; height:30px;"></a>
</div>
