<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Backoffice Niaga</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../../assets/plugins/dropify/dist/css/dropify.min.css">
    <link href="../../assets/plugins/dropzone/css/dropzone.min.css" rel="stylesheet">

    <link href="../css/style.css?time=<?php echo time() ?>" rel="stylesheet">
    <link href="../css/custom.css?time=<?php echo time() ?>" rel="stylesheet">
    <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 20px;
            width: auto;
            margin: 50px auto;
            padding: 20px;
        }

        #drop-area.highlight {
            border-color: purple;
        }

        p {
            margin-top: 0;
        }

        .my-form {
            margin-bottom: 10px;
        }

        #gallery {
            margin-top: 10px;
        }

        #gallery img {
            width: 150px;
            margin-bottom: 10px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .button {
            display: inline-block;
            padding: 10px;
            background: #00838f;
            cursor: pointer;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .button:hover {
            background: #02a8b8;
        }

        #fileElem {
            display: none;
        }

        .loader-upload {
            border: 4px solid #f3f3f3;
            /* Light grey */
            border-top: 4px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>

    <?php include 'parts/preloader.php'; ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include 'parts/header.php'; ?>
        <?php include 'parts/sidebar.php'; ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Update Sorek OLAP AP2T <span class="badge badge-warning">Development</span></h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Update Data</a>
                            </li>
                            <li class="breadcrumb-item active">Update Sorek OLAP AP2T</li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Upload data</h4>
                                <div class="basic-form">
                                    <p>Langkah-langkah:
                                    <ul>
                                        <li>1. Download Detail Sorek dari Menu Monitoring Tagihan Listrik (OLAP) AP2T ke dalam format <strong>csv</strong></li>
                                        <li>2. Browse/Drag satu atau beberapa File Sorek (tanpa diedit) ke Panel di bawah ini (maks 5 File maks ukuran File 50Mb)</li>
                                        <li>3. Klik tombol Upload, tunggu sampai File berhasil diupload ke Server</li>
                                        <li>4. Silahkan tunggu Progress Update Data yang sedang berjalan sampai <span class="text-success">sukses (hijau)</span></li>
                                    </ul>
                                    </p>
                                    <p>
                                        <!-- <div>Pemantauan data pelunasan yang belum diupload dapat dilakukan <a href="mon-blm-upload-pelunasan.php" class="badge badge-primary" target="_blank">di sini</a></div> -->
                                        <span class="text-warning">*Silahkan gunakan Web Browser (Firefox/Chrome) versi terbaru</span>
                                    </p>



                                    <div id="drop-area">
                                        <form class="my-form">
                                            <p>Drop files here to upload</p>
                                            <input type="file" name="files" id="fileElem" multiple accept=".csv" onchange="handleFiles(this.files)">
                                            <label class="button text-white" for="fileElem">Select some files</label>
                                            <div id="gallery"></div>
                                        </form>
                                        <progress id="progress-bar" max=100 value=0></progress>
                                        <div id="progress"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="result" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row progress-upload d-none">
            <div class="col-12">
                <div id="proses" class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between progress-label mb-2">
                            <span class="msg">Mengupdate Sorek dari File </span>
                        </div>
                        <div class="progress progress--medium">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- #/ container -->
    </div>

    <!--**********************************
            Content body end
        ***********************************-->



    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <?php include 'parts/footer.php'; ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../../assets/plugins/block-ui/jquery.blockUI.js"></script>
    <script src="../../assets/plugins/moment/moment.min.js"></script>

    <!-- <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script> -->
    <script src="../../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script src="../../assets/plugins/dropzone/js/dropzone.min.js"></script>

    <script src="../js/pages/apps.js"></script>
    <!-- <script src="../js/pages/upload-sorek.js?time=<?php echo time() ?>"></script> -->
    <script>
        // ************************ Drag and drop ***************** //
        let dropArea = document.getElementById("drop-area")

        // Prevent default drag behaviors
        ;
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false)
            document.body.addEventListener(eventName, preventDefaults, false)
        })

        // Highlight drop area when item is dragged over it
        ;
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false)
        })

        ;
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false)
        })

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false)

        function preventDefaults(e) {
            e.preventDefault()
            e.stopPropagation()
        }

        function highlight(e) {
            dropArea.classList.add('highlight')
        }

        function unhighlight(e) {
            dropArea.classList.remove('active')
        }

        function handleDrop(e) {
            var dt = e.dataTransfer
            var files = dt.files

            handleFiles(files)
        }

        let uploadProgress = []
        let progressBar = document.getElementById('progress-bar')

        function initializeProgress(numFiles) {
            progressBar.value = 0
            uploadProgress = []

            for (let i = numFiles; i > 0; i--) {
                uploadProgress.push(0)
            }
        }

        function updateProgress(fileNumber, percent) {
            uploadProgress[fileNumber] = percent
            let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
            progressBar.value = total

            // if (progressBar.value == 100) {
            //     progressBar.style.backgroundColor = '#4CAF50';
            // }
        }

        function handleFiles(files) {
            files = [...files]
            initializeProgress(files.length)
            files.forEach(uploadFile)
            files.forEach(previewFile)
        }

        function previewFile(file) {
            let reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onloadend = function() {
                let msg = document.createElement('p')
                msg.innerText = file.name
                document.getElementById('gallery').appendChild(msg)
            }
        }

        function uploadFile(file, i) {
            var url = 'http://10.2.1.103:8080/upload'
            var xhr = new XMLHttpRequest()
            var formData = new FormData()
            xhr.open('POST', url, true)
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

            // Update progress (can be used to show progress indicator)
            xhr.upload.addEventListener("progress", function(e) {
                updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
            })

            xhr.addEventListener('readystatechange', function(e) {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    updateProgress(i, 100)
                    let response = JSON.parse(this.responseText)

                    document.getElementById('progress').innerHTML = 'Upload File Berhasil' // <- Add this
                } else if (xhr.readyState == 4 && xhr.status != 200) {
                    alert('Error')
                }
            })

            formData.append('files', file)

            xhr.send(formData)
        }
    </script>
</body>

</html>