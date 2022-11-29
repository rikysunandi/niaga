<?php

require 'maxchat.php';

// kirim ke nomor yg sudah ada di kontak
sendText("6282186777723", "saya kenal kamu");

// push ke nomor yg tidak ada di kontak
pushText("6282186777723", "kamu siapa ya?");

// kirim gambar dgn url
sendImg("6282186777723", "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png", "isi caption", "image.png");

// kirim file pdf dgn url
sendFile("6282186777723", "https://training.it.ufl.edu/media/trainingitufledu/documents/uf-health/excel/Excel2016-Beginners.pdf", "image.png");

// kirim link dgn preview
sendLink("6282186777723", "Ini text caption di preview link", "https://web.whatsapp.com/");

?>