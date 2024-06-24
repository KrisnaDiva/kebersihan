<?php
$title = "Dashboard";
ob_start();
require_once __DIR__ . "/../../koneksi.php";
$koneksi = getKoneksi();
$sql = "SELECT COUNT(*) as jumlah FROM konsumen";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$jumlah_konsumen = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) as jumlah FROM jasa_layanan";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$jumlah_jasa_layanan = $stmt->fetchColumn();
?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li
                                class="swiper-slide card card-slide"
                                data-aos="fade-up"
                                data-aos-delay="700">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-success text-white rounded p-3">
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        Data User
                                        <h2 class="counter" style="visibility: visible;"><?= $jumlah_konsumen ?></h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li
                                class="swiper-slide card card-slide"
                                data-aos="fade-up"
                                data-aos-delay="800">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="bg-info text-white rounded p-3">
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-end">
                                        Data Layanan
                                        <h2 class="counter" style="visibility: visible;"><?= $jumlah_jasa_layanan ?></h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
<?php
$content = ob_get_clean();
include("template.php");
?>