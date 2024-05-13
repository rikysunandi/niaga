<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="mdi mdi-chart-bar"></i><span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="index-sar.php">Pemasaran</a></li>
                    <li><a href="index-mekaga.php">Mekanisme Niaga</a></li>
                    <li><a href="index.php">Administrasi Niaga</a></li>
                    <li><a href="index-pola-bayar.php">Pola Bayar</a></li>
                </ul>
            </li>

            <li class="nav-label"><a href="4dx.php">4DX</a></li>
            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-target"></i> <span class="nav-text">WIG</span></a>
                <ul aria-expanded="false">
                    <li><a href="input-wig.php">Input WIG</a></li>
                    <li><a href="daftar-wig.php">Daftar WIG</a></li>
                    <li><a href="input-target-lag.php">Input Target Lag Measures</a></li>
                    <li><a href="input-target-lm.php">Input Target Lead Measures</a></li>
                </ul>
            </li> -->
             <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-flash-outline"></i> <span class="nav-text">Eksekusi</span></a>
                <ul aria-expanded="false">
                    <li><a href="input-realisasi.php">Input Pencapaian LM</a></li>
                    <li><a href="daftar-wig.php">Daftar WIG</a></li>
                </ul>
            </li>
            <li class="nav-label">ADM NIAGA</li>
            <li><a href="rpt-daily-admaga.php"><i class="mdi mdi-chart-bar"></i> <span class="nav-text">Daily Report</span></a>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-cloud-upload"></i> <span class="nav-text">Upload Data</span></a>
                <ul aria-expanded="false">
                    <li class="d-none"><a href="upload-sorek.php">Upload Sorek OLAP AP2T <span class="badge badge-warning">Development</span></a></li>
                    <li><a href="upload-sorek.php">Upload Sorek OLAP AP2T</a></li>
                    <li><a href="update-pelunasan.php">Upload Pelunasan AP2T</a></li>
                    <li><a href="update-peremajaan.php">Upload Peremajaan AP2T</a></li>
                    <!-- <li><a href="job-update-data.php">Monitoring Job Update Data</a></li> -->
                    <li><a href="mon-upload-sorek.php">Monitoring Upload Sorek</a>
                    <li><a href="mon-upload-pelunasan.php">Monitoring Upload Pelunasan</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-md"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="nav-text">Piutang Pelanggan </span> </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="update-pelunasan.php">Update Pelunasan</a>
                            </li> -->
                    <li><a href="mon-dpp.php">Monitoring Data Piutang</a></li>
                    <li><a href="mon-pola-bayar.php">Monitoring Pola Bayar</a></li>
                    <li><a href="rekap-pola-bayar-lunas.php">Rekap Pelunasan Berdasarkan Pola Bayar</a>
                    <li><a href="mon-saldo-tunggakan.php">Monitoring Saldo Tunggakan</a></li>
                    <li><a href="rekap-tgl-bayar.php">Rekap Pelunasan per Tgl Bayar</a>
                    <!-- <li><a href="4dx-piutang.php">4DX Piutang Pelanggan</a> -->
                    <!-- <li><a href="rekap-pola-bayar-tarif-daya.php">Rekap Pola Bayar per Tarif Daya</a></li> -->
                    <!-- <li><a href="input-va.php">Input Virtual Account</a></li> -->
                </ul>
            </li>
            <li class="mega-menu mega-menu-md"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-information-outline"></i><span class="nav-text">Intimasi </span> </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="update-pelunasan.php">Update Pelunasan</a>
                            </li> -->
                <!-- Minimal UP3 dan PLN -->
                <?php if(strlen($_SESSION['unitup'])==0 && substr($_SESSION['username'],0,2)<>'53' ): ?>
                    <li><a href="wo-intimasi.php">Penetapan WO Intimasi</a></li>
                <?php endif; ?>
                    <li><a href="mon-intimasi.php">Monitoring Detail Intimasi</a></li>
                    <li><a href="rekap-intimasi-keterangan.php">Rekap Intimasi per Keterangan</a>
                    <li><a href="efektivitas-intimasi.php">Efektivitas Intimasi</a></li>
                    <li><a href="rekap-intimasi-ulp.php">Rekap Intimasi per ULP</a>
                    <li><a href="rekap-intimasi-koordinator.php">Rekap Intimasi per Koordinator</a></li>
                    <li><a href="rekap-intimasi-petugas.php">Rekap Intimasi per Petugas</a></li>
                    <!-- <li><a href="input-va.php">Input Virtual Account</a></li> -->
                </ul>
            </li>
            <li class="mega-menu mega-menu-md"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-account-remove"></i><span class="nav-text">Pemutusan </span> </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="update-pelunasan.php">Update Pelunasan</a>
                            </li> -->
                    <li><a href="wo-pemutusan.php">Penetapan WO Pemutusan</a></li>
                    <li><a href="reassign-wo-pemutusan.php">Re-Assign WO Pemutusan</a></li>
                    <li><a href="reassign-wo-pemutusan-plg.php">Re-Assign WO Pemutusan per Pelanggan</a></li>
                    <li><a href="mon-wo-pemutusan.php">Monitoring WO Pemutusan</a></li>
                    <li><a href="efektivitas-pemutusan.php">Efektivitas Pemutusan</a></li>
                    <li><a href="rekap-pemutusan-ulp.php">Rekap Pemutusan per Unit</a></li>
                    <li><a href="rekap-pemutusan-keterangan.php">Rekap Pemutusan per Petugas</a></li>
                    <li><a href="mon-pemutusan.php">Monitoring Pemutusan</a></li>
                    <li><a href="mon-shunttrip.php">Monitoring Shunt Trip</a></li>
                    <!-- <li><a href="input-va.php">Input Virtual Account</a></li> -->
                </ul>
            </li>
            <li class="mega-menu mega-menu-md"><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-shuffle"></i><span class="nav-text">Migrasi LPB </span> </a>
                <ul aria-expanded="false">
                    <!-- <li><a href="update-pelunasan.php">Update Pelunasan</a>
                            </li> -->
                    <li><a href="wo-migrasi.php">WO Migrasi LPB</a></li>
                    <li><a href="realisasi-migrasi.php">Realisasi Migrasi LPB</a></li>
                    <li><a href="rekap-migrasi.php">Rekap Migrasi LPB</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-tag-multiple"></i> <span class="nav-text">TS P2TL</span></a>
                <ul aria-expanded="false">
                    <li><a href="index-tsp2tl.php">Dashboard TS P2TL LPB Anomali</a></li>
                    <li><a href="ts-p2tl-paska.php">Dashboard TS P2TL Paskabayar</a></li>
                    <li><a href="mon-ts-p2tl.php">Data TS P2TL</a></li>
                    <!-- <li><a href="mon-ts-p2tl-idpel.php">TS P2TL per Pelanggan</a>
                            </li>
                            <li><a href="rekap-kesesuaian-ts-p2tl.php">Rekap Kesesuaian TS P2TL</a>
                            </li>
                            <li><a href="mon-rupiah-ts-p2tl.php">Monitoring Rupiah TS</a>
                            </li>
                            <li><a href="mon-blocking-token.php">Monitoring Blocking Token</a>
                            </li>
                            <li><a href="rekap-ts-p2tl.php">Rekap Saldo TS P2TL</a>
                            </li> -->
                </ul>
            </li>
            <li class="nav-label">MEKAGA & REVASS</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-download-network"></i> <span class="nav-text">Download & Upload</span></a>
                <ul aria-expanded="false">
                    <li><a href="upload-pemeriksaan-lpb.php">Upload Hasil Pemeriksaan</a></li>
                    <li><a href="mon-pelanggan-belum-diperiksa.php">Download DIL Belum Tagging Priangan</a></li>
                    <li><a href="mon-pelanggan-subsidi.php">Download DIL Subsidi</a></li>
                    <li><a href="mon-upload-pemeriksaan-lpb-ftp.php">Monitoring Upload FTP</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-map-marker-radius"></i> <span class="nav-text">Pemeriksaan LPB</span></a>
                <ul aria-expanded="false">
                    <li><a href="info-pemeriksaan-lpb.php">Info Pemeriksaan LPB</a></li>
                    <li><a href="mon-pemeriksaan-lpb.php">Monitoring Pemeriksaan LPB</a></li>
                    <li><a href="mon-missing-dil.php">Data Tidak Ditemukan Pada DIL</a></li>
                    <li><a href="rekap-pemeriksaan-lpb.php">Rekap per Tanggal Upload</a></li>
                    <li><a href="rekap-pemeriksaan-lpb-all.php">Rekap Pemeriksaan LPB</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-home-map-marker"></i> <span class="nav-text">Foto Rumah</span></a>
                <ul aria-expanded="false">
                    <!-- <li><a href="upload-dil.php">Upload DIL</a>
> -->
                    <li><a href="rekap-foto-rumah-up.php">Rekap Foto Rumah per ULP</a></li>
                    <li><a href="rekap-foto-rumah.php">Rekap Foto Rumah per Petugas</a></li>
                    <li><a href="mon-foto-rumah.php">Detail Data Foto Rumah</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-map"></i> <span class="nav-text">RPP On Desk</span></a>
                <ul aria-expanded="false">
                    <li><a href="pembentukan-rpp.php">Peta Pembentukan RPP</a></li>
                    <li><a href="urut-langkah-rpp.php">Pembentukan Urut Langkah RPP</a></li>
                    <li><a href="rekap-rpp-up.php">Rekap RPP per ULP</a></li>
                    <li><a href="rekap-rpp.php">Rekap RPP per Petugas</a></li>
                    <li><a href="daftar-rpp.php">Daftar RPP On Desk</a></li>
                    <li><a href="rekomendasi-rpp.php">Rekomendasi RPP</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-map"></i> <span class="nav-text">RPP On Site</span></a>
                <ul aria-expanded="false">
                    <li><a href="pelaksanaan-rpp-onsite.php">Review RPP On Site</a></li>
                    <li><a href="rekap-rpp-onsite.php">Rekap RPP On Site</a></li>
                    <li><a href="rekap-rpp-onsite-petugas.php">Rekap Realisasi per Petugas</a></li>
                    <li><a href="mon-rpp-onsite.php">Detail RPP On Site</a></li>
                    <li><a href="mon-rpp-onsite-sisa.php">Detail Sisa WO</a></li>
                    <!-- <li><a href="urut-langkah-rpp.php">Pembentukan Urut Langkah RPP</a></li>
                    <li><a href="rekap-rpp-onsite.php">Rekap RPP On Site  per ULP</a></li>
                    <li><a href="rekap-rpp.php">Rekap RPP On Site per Petugas</a></li>
                    <li><a href="daftar-rpp.php">Daftar RPP On Site</a></li> -->
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-map"></i> <span class="nav-text">RPP Final</span></a>
                <ul aria-expanded="false">
                    <li><a href="rekap-rpp-final.php">Rekap RPP Final</a></li>
                    <li><a href="urut-langkah-rpp-final.php">Pembentukan Urut Langkah RPP</a></li>
                    <!-- <li><a href="peta-rpp-final.php">Pembentukan RPP Final</a></li> -->
                    <li><a href="pembentukan-rpp-final.php">Peta Pembentukan RPP</a></li>
                    <li><a href="peta-rpp-petugas.php">Peta RPP Petugas</a></li>
                    <!-- <li><a href="rekap-rpp-up-final.php">Rekap RPP per ULP</a></li> -->
                </ul>
            </li>
            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-file-document-box"></i> <span class="nav-text">WO KCT</span></a>
                <ul aria-expanded="false">
                    <li><a href="peta-wo-kct.php">Peta Pembentukan WO</a></li>
                    <li><a href="realisasi-kct.php">Peta Pembentukan WO</a></li>
                </ul>
            </li> -->
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-file-document-box"></i> <span class="nav-text">Pendukung</span></a>
                <ul aria-expanded="false">
                    <li><a href="verifikasi-foto-cater.php">Cek Foto Cater</a></li>
                    <li><a href="peta-kompor.php">Peta Pemilihan Target</a></li>
                    <li><a href="target-kompor.php">Target Kompor Induksi</a></li>
                    <li><a href="rpt-kompor.php">Progress Survey CKPM</a></li>
                    <li><a href="peta-wo-kct.php">Peta Pembentukan WO KCT</a></li>
                    <li><a href="rekap-wo-kct.php">Rekap WO KCT</a></li>
                </ul>
            </li>
            <li class="nav-label">Pemasaran</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-cloud-upload"></i> <span class="nav-text">Update Data</span></a>
                <ul aria-expanded="false">
                    <li><a href="update-dapot.php">Update Daftar Potensi</a></li>
                    <li><a href="update-daftung.php">Update Daftar Tunggu</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-tag-multiple"></i> <span class="nav-text">Monitoring Agenda</span></a>
                <ul aria-expanded="false">
                    <li><a href="info-agenda.php">Info Agenda</a></li>
                    <li><a href="input-rab.php">Update RAB</a></li>
                    <li><a href="update-kondisi.php">Update Kondisi Daftung</a></li>
                    <li><a href="mon-potensi.php">Monitoring Potensi</a></li>
                    <li><a href="mon-usulan-skai.php">Monitoring Usulan Investasi</a></li>
                    <li><a href="mon-rab-perluasan.php">Daftar RAB Perluasan</a></li>
                    <li><a href="mon-agenda-evaluasi.php">Monitoring Agenda (RP BP < RP RAB)</a></li>
                    <li><a href="acuan-material.php">Acuan Perhitungan Material</a></li>
                    <li><a href="acuan-jasa.php">Acuan Perhitungan Jasa</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-forklift"></i> <span class="nav-text">Data Material</span></a>
                <ul aria-expanded="false">
                    <li><a href="mon-kebutuhan-material.php">Monitoring Kebutuhan Material</a></li>
                    <li><a href="rekap-kebutuhan-material.php">Rekap Kebutuhan Material</a></li>
                    <li><a href="rekap-stok-spb-material.php">Rekap Stok Material</a></li>
                    <li><a href="rekap-kekurangan-material.php">Rekap Kekurangan Material</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-hexagon-multiple"></i> <span class="nav-text">Laporan</span></a>
                <ul aria-expanded="false">
                    <li><a href="rekap-agenda-ap.php">Rekap Agenda</a></li>
                    <li><a href="rekap-tmp-ap.php">Rekap Status TMP</a></li>
                    <li><a href="rekap-usulan-skai.php">Usulan SKAI Khusus (FORM 1.A)</a></li>
                    <li><a href="detail-usulan-skai-evaluasi.php">Agenda BP < Investasi (FORM 1.B)</a></li>
                    <li><a href="rekap-realisasi-skai.php">Realisasi SKAI Khusus (FORM 8)</a></li>
                </ul>
            </li>
            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="mdi mdi-application"></i><span class="nav-text">Apps</span> <span class="badge badge-info nav-badge">05</span></a>
                        <ul aria-expanded="false">
                            <li><a href="app-profile.html">Profile</a>
                            </li>
                            <li><a href="app-chat.html">Chat</a>
                            </li>
                            <li><a href="app-calender-event.html">Calendar</a>
                            </li>
                        </ul>
> -->

        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************