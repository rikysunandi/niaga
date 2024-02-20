<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengecekan Foto KCT</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    table th {
        background-color: #f2f2f2;
    }
    img {
        max-width: 300px;
        max-height: 300px;
        display: block;
        margin: 0 auto;
    }
    /* Warna berbeda untuk baris ganjil dan genap */
    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
        height: 350px;
    }
    table tbody tr:nth-child(odd) {
        background-color: #fff;
        height: 350px;
    }
    .pagination {
        margin-top: 20px;
    }
    .export-button, .update-button, .rotate-button, .browse-button, .ambil-button {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 5px;
        /*margin-top: 5px;
        margin-right: 10px;
        float: right;*/
    }

    .compact-pagination button {
        margin: 0 5px;
    }

    .stats-widget {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 600px;
        text-align: center;
        margin: 10px 0px;
    }
    .stat-item {
        padding: 10px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }
    .stat-value {
        font-size: 24px;
        font-weight: bold;
    }
    .stat-label {
        font-size: 14px;
        color: #666;
    }

</style>
</head>
<body>
<h2>Data Foto KCT</h2>
<!-- <button class="browse-button" onclick="browseFile()">Browse</button> -->
<select id="sel_unit">
	<option value='53551'>53BDG-53551: BANDUNG SELATAN</option>
	<option value='53555'>53BDG-53555: BANDUNG BARAT</option>
	<option value='53559'>53BDG-53559: BANDUNG UTARA</option>
	<option value='53563'>53BDG-53563: BANDUNG TIMUR</option>
	<option value='53567'>53BDG-53567: CIJAWURA</option>
	<option value='53571'>53BDG-53571: UJUNGBERUNG</option>
	<option value='53575'>53BDG-53575: KOPO</option>
	<option value='53577'>53BDG-53577: PRIANGAN (TT/TM)</option>
	<option value='53811'>53BGR-53811: CIPAYUNG</option>
	<option value='53821'>53BGR-53821: BOGOR TIMUR</option>
	<option value='53825'>53BGR-53825: PRIMA PAKUAN (TT/TM)</option>
	<option value='53831'>53BGR-53831: BOGOR KOTA</option>
	<option value='53841'>53BGR-53841: BOGOR BARAT</option>
	<option value='53851'>53BGR-53851: LEUWILIANG</option>
	<option value='53853'>53BGR-53853: JASINGA</option>
	<option value='53711'>53BKS-53711: BEKASI KOTA</option>
	<option value='53731'>53BKS-53731: MEDAN SATRIA</option>
	<option value='53732'>53BKS-53732: BABELAN</option>
	<option value='53741'>53BKS-53741: BANTARGEBANG</option>
	<option value='53742'>53BKS-53742: MUSTIKA JAYA</option>
	<option value='53771'>53BKS-53771: PRIMA BEKASI (TT/TM)</option>
	<option value='53661'>53CJR-53661: CIANJUR KOTA</option>
	<option value='53671'>53CJR-53671: CIPANAS</option>
	<option value='53681'>53CJR-53681: MANDE</option>
	<option value='53691'>53CJR-53691: TANGGEUNG</option>
	<option value='53695'>53CJR-53695: SUKANAGARA</option>
	<option value='53701'>53CKG-53701: TAMBUN</option>
	<option value='53702'>53CKG-53702: CIBITUNG</option>
	<option value='53703'>53CKG-53703: CIKARANG KOTA</option>
	<option value='53704'>53CKG-53704: LEMAHABANG</option>
	<option value='53581'>53CMI-53581: CIMAHI KOTA</option>
	<option value='53585'>53CMI-53585: PADALARANG</option>
	<option value='53589'>53CMI-53589: LEMBANG</option>
	<option value='53592'>53CMI-53592: CILILIN</option>
	<option value='53595'>53CMI-53595: RAJAMANDALA</option>
	<option value='53598'>53CMI-53598: PRIMA CIBABAT</option>
	<option value='53599'>53CMI-53599: CIMAHI SELATAN</option>
	<option value='53311'>53CRB-53311: CIREBON KOTA</option>
	<option value='53321'>53CRB-53321: KUNINGAN</option>
	<option value='53331'>53CRB-53331: SUMBER</option>
	<option value='53351'>53CRB-53351: CILEDUG</option>
	<option value='53371'>53CRB-53371: CILIMUS</option>
	<option value='53871'>53DPK-53871: DEPOK KOTA</option>
	<option value='53872'>53DPK-53872: CIBINONG</option>
	<option value='53873'>53DPK-53873: SAWANGAN</option>
	<option value='53874'>53DPK-53874: CIMANGGIS</option>
	<option value='53875'>53DPK-53875: BOJONGGEDE</option>
	<option value='53861'>53GPI-53861: CITEUREUP</option>
	<option value='53865'>53GPI-53865: CILEUNGSI</option>
	<option value='53867'>53GPI-53867: JONGGOL</option>
	<option value='53271'>53GRT-53271: GARUT KOTA</option>
	<option value='53276'>53GRT-53276: CIKAJANG</option>
	<option value='53277'>53GRT-53277: PAMEUNGPEUK</option>
	<option value='53286'>53GRT-53286: CIBATU</option>
	<option value='53293'>53GRT-53293: LELES</option>
	<option value='53401'>53IDM-53401: JATIBARANG</option>
	<option value='53402'>53IDM-53402: HAURGEULIS</option>
	<option value='53403'>53IDM-53403: INDRAMAYU KOTA</option>
	<option value='53404'>53IDM-53404: CIKEDUNG</option>
	<option value='53461'>53KRW-53461: CIKAMPEK</option>
	<option value='53468'>53KRW-53468: KOSAMBI</option>
	<option value='53475'>53KRW-53475: KARAWANG KOTA</option>
	<option value='53476'>53KRW-53476: PRIMA KARAWANG (TT/TM)</option>
	<option value='53482'>53KRW-53482: RENGASDENGKLOK</option>
	<option value='53531'>53MJA-53531: MAJALAYA</option>
	<option value='53532'>53MJA-53532: SOREANG</option>
	<option value='53533'>53MJA-53533: RANCAEKEK</option>
	<option value='53534'>53MJA-53534: BANJARAN</option>
	<option value='53535'>53MJA-53535: BALEENDAH</option>
	<option value='53536'>53MJA-53536: PRIMA MAJALAYA (TT/TM)</option>
	<option value='53411'>53PWK-53411: PAMANUKAN</option>
	<option value='53421'>53PWK-53421: PAGADEN</option>
	<option value='53425'>53PWK-53425: SUBANG</option>
	<option value='53431'>53PWK-53431: PLERED</option>
	<option value='53444'>53PWK-53444: PURWAKARTA KOTA</option>
	<option value='53611'>53SKI-53611: SUKABUMI KOTA</option>
	<option value='53621'>53SKI-53621: CIBADAK</option>
	<option value='53631'>53SKI-53631: PELABUHAN RATU</option>
	<option value='53641'>53SKI-53641: CIKEMBAR</option>
	<option value='53651'>53SKI-53651: SUKARAJA</option>
	<option value='53659'>53SKI-53659: CICURUG</option>
	<option value='53511'>53SMD-53511: SUMEDANG KOTA</option>
	<option value='53517'>53SMD-53517: TANJUNG SARI</option>
	<option value='53521'>53SMD-53521: MAJALENGKA</option>
	<option value='53527'>53SMD-53527: JATIWANGI</option>
	<option value='53211'>53TSK-53211: PANGANDARAN</option>
	<option value='53221'>53TSK-53221: BANJAR</option>
	<option value='53231'>53TSK-53231: CIAMIS</option>
	<option value='53241'>53TSK-53241: TASIKMALAYA KOTA</option>
	<option value='53251'>53TSK-53251: RAJAPOLAH</option>
	<option value='53261'>53TSK-53261: SINGAPARNA</option>
	<option value='53265'>53TSK-53265: KARANGNUNGGAL</option>
</select>
<button class="ambil-button" onclick="ambilData()">Ambil Data</button>
<button class="export-button" onclick="exportData()">Export</button>
<!-- <button class="update-button" onclick="updateData()">Update</button> -->
<hr/>
<div class="stats-widget">
    <div class="stat-item">
        <div id="jml_suspect" class="stat-value">XX</div>
        <div class="stat-label">Total Suspect</div>
    </div>
    <div class="stat-item">
        <div id="foto_tidak_ada" class="stat-value">XX</div>
        <div class="stat-label">Tidak Ada Foto</div>
    </div>
    <div class="stat-item">
        <div id="foto_sesuai" class="stat-value">XX</div>
        <div class="stat-label">Foto Sesuai</div>
    </div>
    <div class="stat-item">
        <div id="foto_tidak_sesuai" class="stat-value">XX</div>
        <div class="stat-label">Foto Tidak Sesuai</div>
    </div>
</div>
<table id="dataTable">
    <thead>
        <tr>
            <th>Idpel</th>
            <th>No Meter</th>
            <th>Merk Meter</th>
            <th>Petugas</th>
            <th>Tgl Baca</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Baris data akan diisi melalui JavaScript -->
    </tbody>
</table>
<div class="pagination compact-pagination" id="pagination"></div>
<!-- <div class="pagination" id="pagination"></div> -->

<script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
<script>
    // Variabel untuk menyimpan data pelanggan
    var data = [];
    // Variabel untuk menyimpan jumlah halaman
    var totalPages = 0;
    // Variabel untuk menyimpan data yang ditampilkan per halaman
    var pageSize = 100;
    // Variabel untuk menyimpan halaman yang sedang aktif
    var currentPage = 1;

    // Fungsi untuk memuat data dari sumber CSV
    function loadDataFromCSV2() {
        $.ajax({
            url: 'data_pelanggan.csv', // Ganti dengan URL file CSV yang sesuai
            dataType: 'text',
            success: function(response) {
                var lines = response.split('\n');
                lines.forEach(function(line) {
                    var items = line.split(',');

        			//console.log(items[0], items[3]);
                    if (items.length === 4) { // Pastikan format data sesuai dengan kolom yang diharapkan
                        data.push({
                            idpel: items[0],
                            nomor_meter: items[1],
                            merk_meter: items[2],
                            petugasbaca: items[3],
                            tglstatus: items[4],
                            fotourl: items[5],
                            st_foto: items[6],
                            rotation: 0 // Tambahkan properti untuk menyimpan rotasi gambar
                        });
                    }
                });
                totalPages = Math.ceil(data.length / pageSize);
                createPagination(totalPages);
                loadData(currentPage);
            }
        });
    }

    // Fungsi untuk memuat data dari sumber CSV
    function loadDataFromCSV(fileContent) {
    	console.log('loadDataFromCSV');
        var lines = fileContent.split('\n');
        data = [];
        lines.forEach(function(line) {
            var items = line.split(',');
            console.log(items.length);
            if (items.length === 7) { // Pastikan format data sesuai dengan kolom yang diharapkan
                data.push({
                    idpel: items[0],
                    nomor_meter: items[1],
                    merk_meter: items[2],
                    petugasbaca: items[3],
                    tglstatus: items[4],
                    fotourl: items[5],
                    st_foto: items[6],
                    rotation: 0 // Tambahkan properti untuk menyimpan rotasi gambar
                });
            }
        });
        totalPages = Math.ceil(data.length / pageSize);
        createPagination(totalPages);
        loadData(currentPage);
    }

    // Fungsi untuk memuat data pada halaman tertentu
    function loadData(page) {
        currentPage = page;
        var start = (page - 1) * pageSize;
        var end = start + pageSize;
        var tableBody = $('#dataTable tbody');
        tableBody.empty();
        for (var i = start; i < Math.min(end, data.length); i++) {
        	//console.log(data[i].idpel, data[i].st_foto);
            var row = '<tr>' +
                '<td>' + data[i].idpel + '</td>' +
                '<td>' + data[i].nomor_meter + '</td>' +
                '<td>' + data[i].merk_meter + '</td>' +
                '<td>' + data[i].petugasbaca + '</td>' +
                '<td>' + data[i].tglstatus + '</td>' +
                '<td><img id="img' + i + '" src="' + data[i].fotourl + '" alt="Foto KCT Tidak ada">' +                
                '&nbsp;<button class="rotate-button" onclick="rotateImage(' + i + ')">Rotate</button>' +
                '</td>' +
                '<td>' +
                '<select onchange="updateAction(this, ' + i + ')">' +
                '<option value=""' + (data[i].st_foto === '' ? ' selected' : '') + '>Mohon diisi</option>' +
                '<option value="Foto Tidak Sesuai"' + (data[i].st_foto === 'Foto Tidak Sesuai' ? ' selected' : '') + '>Foto Tidak Sesuai</option>' +
                '<option value="Foto Sesuai"' + (data[i].st_foto === 'Foto Sesuai' ? ' selected' : '') + '>Foto Sesuai</option>' +
                '</select>' +
                '</td>' +
                '</tr>';
            tableBody.append(row);
        }
    }

    // Fungsi untuk membuat tombol paging
    function createPagination2(totalPages) {
        var pagination = $('#pagination');
        pagination.empty();
        for (var i = 1; i <= totalPages; i++) {
            var button = $('<button></button>').text(i);
            button.click(function() {
                loadData(parseInt($(this).text()));
            });
            pagination.append(button);
        }
    }

    // Fungsi untuk membuat tombol paging
    function createPagination(totalPages) {
        var pagination = $('#pagination');
        pagination.empty();
        if (totalPages > 1) {
            var prevButton = $('<button></button>').text('Prev');
            prevButton.click(function() {
                if (currentPage > 1) {
                    loadData(currentPage - 1);
                }
            });
            pagination.append(prevButton);

            for (var i = 1; i <= totalPages; i++) {
                var button = $('<button></button>').text(i);
                button.click(function() {
                    loadData(parseInt($(this).text()));
                });
                if (i === currentPage) {
                    button.addClass('active');
                }
                pagination.append(button);
            }

            var nextButton = $('<button></button>').text('Next');
            nextButton.click(function() {
                if (currentPage < totalPages) {
                    loadData(currentPage + 1);
                }
            });
            pagination.append(nextButton);
        }
    }

    // Fungsi untuk mengupdate st_foto pada data yang dipilih
    function updateAction(selectElement, index) {
    	console.log(index, selectElement);
    	console.log(index, $(selectElement).val());
        data[index].st_foto = selectElement.value;

    	$(selectElement).parent().block({ message: 'Menyimpan...' });
        $.post('../controller/kct/updateSTFotoKCT.php', {idpel: data[index].idpel, st_foto: $(selectElement).val() }, function(data){
            console.log(data);
            updateJmlFoto();
            $(selectElement).parent().unblock();
        }, 'json' );
    }

    // Fungsi untuk merotasi gambar
    function rotateImage(index) {
    	console.log('rotateImage');
        var img = document.getElementById('img' + index);
        // Perbarui rotasi gambar
        data[index].rotation += 90;
        // Terapkan transformasi CSS
        img.style.transform = 'rotate(' + data[index].rotation + 'deg)';
    }

    // Fungsi untuk mengekspor data ke dalam format CSV
    function exportData() {
        var csvContent = "data:text/csv;charset=utf-8,";
        //csvContent += "IDPEL,tglstatus,Gambar,st_foto\n";
        data.forEach(function(item) {
            csvContent += item.idpel + "," + item.nomor_meter + "," + item.merk_meter + "," + item.petugasbaca + "," + item.tglstatus + "," + item.gambar + "," + item.st_foto + "\n";
        });
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "data_pelanggan.csv");
        document.body.appendChild(link);
        link.click();
    }

    // Fungsi untuk memuat data dari file yang dipilih
    function browseFile() {
    	console.log('browse');
        var input = document.createElement('input');
        input.type = 'file';
        input.accept = '.csv';
        input.onchange = function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var fileContent = event.target.result;
                loadDataFromCSV(fileContent);
            };
            reader.readAsText(file);
        };
        input.click();
    }

    // Fungsi untuk mengupdate data ke file CSV
    function updateData() {
        var csvContent = "IDPEL,tglstatus,Gambar,st_foto\n";
        data.forEach(function(item) {
            csvContent += item.idpel + "," + item.nomor_meter + "," + item.merk_meter + "," + item.petugasbaca + "," + item.tglstatus + "," + item.gambar + "," + item.st_foto + "\n";
        });
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "data_pelanggan.csv");
        document.body.appendChild(link);
        link.click();
    }

    // Fungsi untuk mengupdate data ke file CSV
    function ambilData() {
        
        data = [];
    	$('table').block({ message: 'Mengambil data...' });
	    $.getJSON('../controller/getFotoKCT.php?unitup='+$('#sel_unit').val(), function(res){

	    	$('#jml_suspect').html(res.jml_suspect);
	    	$('#foto_tidak_ada').html(res.foto_tidak_ada);
	    	$('#foto_sesuai').html(res.foto_sesuai);
	    	$('#foto_tidak_sesuai').html(res.foto_tidak_sesuai);
	    	data = res.rows;
	    	totalPages = Math.ceil(data.length / pageSize);
            createPagination(totalPages);
            loadData(currentPage);
	        $('table').unblock();

	    });
    }    

    function updateJmlFoto(){
    	var foto_sesuai=0;
    	var foto_tidak_sesuai=0;
    	$.each(data, function(i,v){
    		if(v.st_foto==='Foto Sesuai')
    			foto_sesuai++;
    		else if(v.st_foto==='Foto Tidak Sesuai')
    			foto_tidak_sesuai++;
    	});

    	$('#foto_sesuai').html(foto_sesuai);
    	$('#foto_tidak_sesuai').html(foto_tidak_sesuai);
    }

    // Memuat data saat halaman dimuat
    $(document).ready(function() {
        //loadDataFromCSV();
    });
</script>

</body>
</html>
