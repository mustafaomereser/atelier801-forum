<?php
include("config.php");
$gun = 86400;
?>
     <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Login & Register</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Weekly</a></li>
                                </ul>
                            </div>

                            <div class="widget-content">
                                <div class="tabs tab-content">
                                    <div id="content_1" class="tabcontent"> 
                                        <div id="revenueMonthly"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Daily (Login & Register)</h5>
                            </div>
                            <div class="widget-content">
                                <div id="chart-2" class=""></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Onlines</h5>
                            </div>
                            <div class="widget-content">
                                <div id="chart-3" class=""></div>
                            </div>
                        </div>
                    </div>

                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Login Log (Day) Show 10 last</h5>
                            </div>

                            <div class="widget-content">
							<?php	
							$loginlog = $db->query("SELECT * FROM loginlog where Timestamp>='".(time()-$gun)."' order by Timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);
							$other = 0; $staff = 0; $user = 0; $dfg=0;
							foreach($loginlog as $row){
	
								$usr = $db->query("SELECT PlayerID,PrivLevel,Username,Tag,Avatar FROM users where Username = '".$row['username']."'")->fetch(PDO::FETCH_ASSOC);
							
							
							$yetkisi = max(explode(",",$usr['PrivLevel']));
	
							if($yetkisi>=8){
								$staff++;
							}elseif($yetkisi<=7 && $yetkisi>=2){
								$other++;
							}else{
								$user++;
							}
														$dfg++;
								if($dfg<=10){
							?>
							
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
												<?php
												if(!empty($usr['Avatar'])){
												?>
									<img id="img_<?=$usr['PlayerID']?>" onerror='imgError(this);' src="<?=$site?>/img/avatars/<?=getavatar($usr)?>" width="50px" style="border-radius: 50%;" class="circle" alt="avatar">
												<?php
												}
												?>
												</div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?=isim($usr['Username'].$usr['Tag'],"o")?></h4>
                                                <p class="meta-date"><?=strtok($row['yazi'],"-")?></p>
                                            </div>

                                        </div>
                                       
										
                                    </div>
                                </div>
							<?php
							}
							}
							?>

                            </div>
                        </div>
                    </div>

              
			                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Register Log (Day)</h5>
                            </div>

                            <div class="widget-content">
							<?php
							$reglog = $db->query("SELECT * FROM users where RegDate>='".(time()-$gun)."' order by RegDate DESC")->fetchAll(PDO::FETCH_ASSOC);
							$register = 0;
							foreach($reglog as $row){
								$register++;
							?>
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
												<?php
												if(!empty($row['Avatar'])){
												?>
									<img src="<?=$site?>/img/avatars/<?=getavatar($row)?>" id="img_<?=$row['PlayerID']?>" onerror='imgError(this);' width="50px" style="border-radius: 50%;" class="circle" alt="avatar">
												<?php
												}
												?>
												</div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?=isim($row['Username'].$row['Tag'],"o")?></h4>
                                                <p class="meta-date">Registered</p>
                                            </div>

                                        </div>
                                       
										
                                    </div>
                                </div>
							<?php
							}
							?>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
			<?php
			
			
			
eval(socket("onlines",1));
			
		
$lognn= $db->query("SELECT Timestamp FROM loginlog where Timestamp>='".(time()-604800)."'")->fetchAll(PDO::FETCH_ASSOC);
$regnn = $db->query("SELECT RegDate FROM users where RegDate>='".(time()-604800)."'")->fetchAll(PDO::FETCH_ASSOC);

$lggun1=0;$lggun2=0;$lggun3=0;$lggun4=0;$lggun5=0;$lggun6=0;$lggun7=0;
foreach($lognn as $log){

if($log['Timestamp'] >= (time()-$gun) ){
	$lggun1++;
}
if($log['Timestamp'] >= (time()-($gun*2)) ){
	$lggun2++;
}
if($log['Timestamp'] >= (time()-($gun*3)) ){
	$lggun3++;
}
if($log['Timestamp'] >= (time()-($gun*4)) ){
	$lggun4++;
}
if($log['Timestamp'] >= (time()-($gun*5)) ){
	$lggun5++;
}
if($log['Timestamp'] >= (time()-($gun*6)) ){
	$lggun6++;
}
if($log['Timestamp'] >= (time()-($gun*7)) ){
	$lggun7++;
}

}

$reggun1=0;$reggun2=0;$reggun3=0;$reggun4=0;$reggun5=0;$reggun6=0;$reggun7=0;

foreach($regnn as $log){

if($log['RegDate'] >= (time()-$gun) ){
	$reggun1++;
}
if($log['RegDate'] >= (time()-($gun*2)) ){
	$reggun2++;
}
if($log['RegDate'] >= (time()-($gun*3)) ){
	$reggun3++;
}
if($log['RegDate'] >= (time()-($gun*4)) ){
	$reggun4++;
}
if($log['RegDate'] >= (time()-($gun*5)) ){
	$reggun5++;
}
if($log['RegDate'] >= (time()-($gun*6)) ){
	$reggun6++;
}
if($log['RegDate'] >= (time()-($gun*7)) ){
	$reggun7++;
}


}





			?>
			

			
		<script>
				
var options1 = {
  chart: {
    fontFamily: 'Nunito, sans-serif',
    height: 365,
    type: 'area',
    zoom: {
        enabled: false
    },
    dropShadow: {
      enabled: true,
      opacity: 0.3,
      blur: 5,
      left: -7,
      top: 22
    },
    toolbar: {
      show: false
    },
    events: {
      mounted: function(ctx, config) {
        const highest1 = ctx.getHighestValueInSeries(0);
        const highest2 = ctx.getHighestValueInSeries(1);

        ctx.addPointAnnotation({
          x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
          y: highest1,
          label: {
            style: {
              cssClass: 'd-none'
            }
          },
          customSVG: {
              SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
              cssClass: undefined,
              offsetX: -8,
              offsetY: 5
          }
        })

        ctx.addPointAnnotation({
          x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
          y: highest2,
          label: {
            style: {
              cssClass: 'd-none'
            }
          },
          customSVG: {
              SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
              cssClass: undefined,
              offsetX: -8,
              offsetY: 5
          }
        })
      },
    }
  },
  colors: ['#1b55e2', '#e7515a'],
  dataLabels: {
      enabled: false
  },
  markers: {
    discrete: [{
    seriesIndex: 0,
    dataPointIndex: 7,
    fillColor: '#000',
    strokeColor: '#000',
    size: 5
  }, {
    seriesIndex: 2,
    dataPointIndex: 11,
    fillColor: '#000',
    strokeColor: '#000',
    size: 4
  }]
  },
  subtitle: {
    text: '',
    align: 'left',
    margin: 0,
    offsetX: -10,
    offsetY: 35,
    floating: false,
    style: {
      fontSize: '14px',
      color:  '#888ea8'
    }
  },
  title: {
    text: '',
    align: 'left',
    margin: 0,
    offsetX: -10,
    offsetY: 0,
    floating: false,
    style: {
      fontSize: '25px',
      color:  '#bfc9d4'
    },
  },
  stroke: {
      show: true,
      curve: 'smooth',
      width: 2,
      lineCap: 'square'
  },
  series: [{
      name: 'Register',
      data: [<?=$reggun1?>,<?=$reggun2?>,<?=$reggun3?>,<?=$reggun4?>,<?=$reggun5?>,<?=$reggun6?>,<?=$reggun7?>]
  }, {
      name: 'Login',
      data: [<?=$lggun1?>,<?=$lggun2?>,<?=$lggun3?>,<?=$lggun4?>,<?=$lggun5?>,<?=$lggun6?>,<?=$lggun7?>]
  }],
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
  xaxis: {
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    },
    crosshairs: {
      show: true
    },
    labels: {
      offsetX: 0,
      offsetY: 5,
      style: {
          fontSize: '12px',
          fontFamily: 'Nunito, sans-serif',
          cssClass: 'apexcharts-xaxis-title',
      },
    }
  },
  yaxis: {
    labels: {
      formatter: function(value, index) {
        return value
      },
      offsetX: -22,
      offsetY: 0,
      style: {
          fontSize: '12px',
          fontFamily: 'Nunito, sans-serif',
          cssClass: 'apexcharts-yaxis-title',
      },
    }
  },
  grid: {
    borderColor: '#191e3a',
    strokeDashArray: 5,
    xaxis: {
        lines: {
            show: true
        }
    },   
    yaxis: {
        lines: {
            show: false,
        }
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: -10
    }, 
  }, 
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    offsetY: -50,
    fontSize: '16px',
    fontFamily: 'Nunito, sans-serif',
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: '#fff',
      fillColors: undefined,
      radius: 12,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },    
    itemMargin: {
      horizontal: 0,
      vertical: 20
    }
  },
  tooltip: {
    theme: 'dark',
    marker: {
      show: true,
    },
    x: {
      show: false,
    }
  },
  fill: {
      type:"gradient",
      gradient: {
          type: "vertical",
          shadeIntensity: 1,
          inverseColors: !1,
          opacityFrom: .28,
          opacityTo: .05,
          stops: [45, 100]
      }
  },
  responsive: [{
    breakpoint: 575,
    options: {
      legend: {
          offsetY: -30,
      },
    },
  }]
}
		
		
		var options = {
    chart: {
        type: 'donut',
        width: 380
    },
    colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
    dataLabels: {
      enabled: false
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'center',
        fontSize: '14px',
        markers: {
          width: 10,
          height: 10,
        },
        itemMargin: {
          horizontal: 0,
          vertical: 8
        }
    },
    plotOptions: {
      pie: {
        donut: {
          size: '65%',
          background: 'transparent',
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: '29px',
              fontFamily: 'Nunito, sans-serif',
              color: undefined,
              offsetY: -10
            },
            value: {
              show: true,
              fontSize: '26px',
              fontFamily: 'Nunito, sans-serif',
              color: '#bfc9d4',
              offsetY: 16,
              formatter: function (val) {
                return val
              }
            },
            total: {
              show: true,
              showAlways: true,
              label: 'Total',
              color: '#888ea8',
              formatter: function (w) {
                return w.globals.seriesTotals.reduce( function(a, b) {
                  return a + b
                }, 0)
              }
            }
          }
        }
      }
    },
    stroke: {
      show: true,
      width: 25,
      colors: '#0e1726'
    },
    series: [<?=$other?>, <?=$user?>, <?=$staff?>,<?=$register?>],
    labels: ['Other', 'User', 'Staff','Registered'],
    responsive: [{
        breakpoint: 1599,
        options: {
            chart: {
                width: '350px',
                height: '400px'
            },
            legend: {
                position: 'bottom'
            }
        },

        breakpoint: 1439,
        options: {
            chart: {
                width: '250px',
                height: '390px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
              pie: {
                donut: {
                  size: '65%',
                }
              }
            }
        },
    }]
}







var options2 = {
    chart: {
        type: 'donut',
        width: 380
    },
    colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
    dataLabels: {
      enabled: false
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'center',
        fontSize: '14px',
        markers: {
          width: 10,
          height: 10,
        },
        itemMargin: {
          horizontal: 0,
          vertical: 8
        }
    },
    plotOptions: {
      pie: {
        donut: {
          size: '65%',
          background: 'transparent',
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: '29px',
              fontFamily: 'Nunito, sans-serif',
              color: undefined,
              offsetY: -10
            },
            value: {
              show: true,
              fontSize: '26px',
              fontFamily: 'Nunito, sans-serif',
              color: '#bfc9d4',
              offsetY: 16,
              formatter: function (val) {
                return val
              }
            },
            total: {
              show: true,
              showAlways: true,
              label: 'Total',
              color: '#888ea8',
              formatter: function (w) {
                return w.globals.seriesTotals.reduce( function(a, b) {
                  return a + b
                }, 0)
              }
            }
          }
        }
      }
    },
    stroke: {
      show: true,
      width: 25,
      colors: '#0e1726'
    },
	
	
    series: [<?=$onlines['users'] ?? 0 ?>, <?=$onlines['staff'] ?? 0 ?>, <?=$onlines['hide'] ?? 0 ?>],
    labels: ['Users', 'Staff', 'Hidden'],
    responsive: [{
        breakpoint: 1599,
        options: {
            chart: {
                width: '350px',
                height: '400px'
            },
            legend: {
                position: 'bottom'
            }
        },

        breakpoint: 1439,
        options: {
            chart: {
                width: '250px',
                height: '390px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
              pie: {
                donut: {
                  size: '65%',
                }
              }
            }
        },
    }]
}


</script>
			
						
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
<?php
include("footer.php");
?>