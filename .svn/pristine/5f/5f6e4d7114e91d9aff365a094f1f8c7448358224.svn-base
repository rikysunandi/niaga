<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAALi4uALGxsQDIyMgANhn3AK6urgC1dC0Aq6urAEpJTQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAESARIAAAAAAREBEQAAAAABEQERAAAAAAAMzMwAAAAAAAzMzAAAAAAADMzMAAAAAAAZmZgAAAABDNjM2M0AAAEM2MzYzQAAAQyZTNjNAAABDdoiGM0AAAEM2g4YzQAAAAAMTEwAAAAAAAzMzAAAAAAADMzMAAAAAAAAAAAAAD4jwAA+I8AAPiPAAD8HwAA/B8AAPwfAAD8HwAA4AMAAOADAADgAwAA4AMAAOADAAD8HwAA/B8AAPwfAAD//wAA" rel="icon" type="image/x-icon" />

    <title>REVERSE GEOCODE</title>
  </head>
  <body class="bg-body">
  	 <div id="main-wrapper">

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-4">
                        <h2>Reverse Geocode</h2>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="card setting">
                            <div class="card-header bg-danger">
                            	<h4 class="text-white">SETTING SUMBER KOORDINAT</h4>
                            </div>
                            <div class="card-body">
                                <form class="row">
                                    <div class="col-12">
                                        <div class="form-group row align-items-center mb-2">
                                            <label class="col-sm-4 col-form-label text-label">Nama File</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="nama_file" aria-describedby="nama_file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row align-items-center mb-2">
                                            <label class="col-sm-4 col-form-label text-label">Mulai Baris Ke</label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="start" aria-describedby="start">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                            	<span>sampai</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="end" aria-describedby="end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                            	<div class="clearfix">
	                                <button type="button" id="btn_proses" class="btn btn-danger float-end">
	                                	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
										  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
										  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
										</svg> Proses</button>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header bg-danger">
                            	<h4 class="text-white">PROGRESS UPDATE</h4>
                            </div>
                            <div class="card-body">

                                <div class="progress-upload mt-2 d-none">
                                    <div class="d-flex justify-content-between progress-label">
                                        <span class="msg">Mohon menunggu, sedang proses membaca data...</span>
                                    </div>
                                    <div class="progress progress--large">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="console text-success">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.1/papaparse.min.js" integrity="sha512-EbdJQSugx0nVWrtyK3JdQQ/03mS3Q1UiAhRtErbwl1YL/+e2hZdlIcSURxxh7WXHTzn83sjlh2rysACoJGfb6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    	(function($) {
		    "use strict"

		    var processing=false;

		    $('#btn_proses').click(function(){

		    	$('.setting').block({message:'<h4 class="mb-2">Memproses... <img src="https://cdnjs.cloudflare.com/ajax/libs/vegas/1.3.5/images/loading.gif" /> </h4>'});

		    	var start = parseInt($('#start').val());
		    	var end = parseInt($('#end').val());
		    	var count = (end - start) +1;

			    $('input[type=file]').parse({
					config: {
						skipEmptyLines: true,
						complete: function(results)
						{
							//console.log(results);
							var datas = results.data;

							var startTime = new Date().getTime();
							$('.progress-upload').removeClass('d-none');

							var i=0;
							var csv='';
							csv = csv+'IDPEL\tLAT\tLONG\tSTATE\tCITY\tSUBURB\tSUBDISTRICT\tVILLAGE\tROAD\tPOSTCODE\r\n';
							function revGeocode(i, data, ke){

								var valeur = Math.round((parseInt(ke-1)/parseInt(count))*100);

								if(parseInt(ke) <= parseInt(count)){

								    $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);
								    $('.progress-upload .d-flex span.msg').html('Reverse Geocode Idpel '+data[2]+' ('+data[3]+','+data[4]+')...');

								    $.get('https://nominatim.openstreetmap.org/reverse?lat='+data[3]+'&lon='+data[4]+'&zoom=18&addressdetails=1&format=json', function(res){

								    	$('div.console').html('<b>Idpel '+data[2]+':</b> <br/>'+
								    		'Country: '+res.address.country+' <br/> '+
								    		'State: '+res.address.state+' <br/> '+
								    		'City: '+res.address.city+' <br/> '+
								    		'Suburb: '+res.address.suburb+' <br/> '+
								    		'Subdistrict: '+res.address.subdistrict+' <br/> '+
								    		'Village: '+res.address.village+' <br/> '+
								    		'Road: '+res.address.road+' <br/> '+
								    		'Postcode: '+res.address.postcode);

										csv = csv+data[2]+'\t'+data[3]+'\t'+data[4]+'\t'+
												res.address.state+'\t'+
												res.address.city+'\t'+
												res.address.suburb+'\t'+
												res.address.subdistrict+'\t'+
												res.address.village+'\t'+
												res.address.road+'\t'+
												res.address.postcode+'\r\n';

								    	i = i+1;
								    	ke = ke+1;

								    	setTimeout(
								    		revGeocode(i, datas[i], ke),
								    		200);
								    });
								}else{

								    $('.progress-bar').css('width', valeur+'%').text(valeur + " %").attr('aria-valuenow', valeur);
								    $('.progress-upload .d-flex span.msg').html('Proses Selesai...');
								    $('div.console').html('');

								    $('.setting').unblock();

								    csv.replace('undefined','');
								    let link = document.createElement('a')
									link.id = 'download-csv'
									link.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv));
									link.setAttribute('download', 'RESULT_'+$('input[type=file]').val().replace(/C:\\fakepath\\/i, '')+'_'+start+'_'+end+'.csv');
									document.body.appendChild(link)
									document.querySelector('#download-csv').click()
								}

							};

							revGeocode(start, datas[start], 1);

						}
					}
				});

		    });

		})(jQuery);
    </script>
  </body>
</html>