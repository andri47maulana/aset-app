<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/select2/dist/css/select2.min.css">
    <link href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png">
    <link rel="stylesheet" href="https://releases.transloadit.com/uppy/v3.5.0/uppy.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets_ai/css/map_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Leaflet.markercluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

    <!-- Leaflet.markercluster JS -->
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>






    <div id="loading-overlay">
      <div class="spinner"></div>
      <img src="assets/img/thinking.gif" id="loading-data" alt="Loading...">
      <p id="text-data">Baik, saya sedang mencari data anda....</p>
    </div>

    <div id="failed-overlay">
      <div class="spinner"></div>
      <!-- <img src="assets/img/failed.gif" id="loading-data" alt="Loading..."> -->
      <p id="text-data">Maaf, Data tidak ditemukan....</p>
    </div>



<?= $this->section('content'); ?>  
<style type="text/css">
  .overlay-panel {
      position: absolute;
      top: 60px;
      right: 10px;
      width: 400px;
      max-height: 90vh;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: transform 0.3s ease;
      overflow: auto;
    }

    .overlay-title-panel {
      position: absolute;
      top: 10px;
      left: 50px;
      width: 350px;
      max-height: 50vh;
      background-color: rgb(255 255 255 / 42%);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: transform 0.3s ease;
      overflow: auto;
      font-size: 23px;
      font-weight: bold;
    }

    .overlay-hidden {
      transform: translateX(110%);
    }

    .toggle-btn {
      position: absolute;
      top: 15px;
      right: 60px;
      z-index: 1100;
    }

    .toggle-detail-btn {
      position: absolute;
      top: 15px;
      right: 230px;
      z-index: 1100;
    }

    .login-btn {
      position: absolute;
      top: 15px;
      right: 360px;
      z-index: 1100;
    }

    #panelTabs{
      font-size: 12px;
      font-weight: bold;
    }


    .overlay-detail-panel {
      position: absolute;
      bottom: 10px;
      left: 10px;
      width: 800px;
      height: 35vh;
      background: rgb(255 255 255 / 42%);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: transform 0.3s ease;
      overflow: auto;
    }

    .overlay-detail-hidden {
      transform: translateX(-110%);
    }


    .info-slider-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .info-slider {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      gap: 10px;
      padding: 10px 0;
      max-width: 100%;
    }

    .info-item {
      min-width: 120px;
      max-width: 140px;
      text-align: center;
      cursor: pointer;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 8px;
      background: #f9f9f9;
      transition: 0.3s;
    }
    .info-item img {
      width: 100%;
      height: 100px;
      border-radius: 4px;
    }
    .info-item:hover {
      background: #eef;
    }

    .slider-btn {
      position: absolute;
      top: 40%;
      transform: translateY(-50%);
      z-index: 10;
      background: rgba(255,255,255,0.9);
      border: none;
      border-radius: 50%;
      font-size: 24px;
      width: 36px;
      height: 36px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .slider-btn.left {
      left: -10px;
    }
    .slider-btn.right {
      right: -10px;
    }



    .zoom-modal {
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.8);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .media-modal-box {
      display: flex;
      max-width: 90%;
      max-height: 90%;
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      flex-wrap: wrap;
    }

    .media-left {
      flex: 2;
      background: black;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .media-left img, .media-left iframe {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .media-right {
      flex: 1;
      padding: 16px;
      overflow-y: auto;
      max-height: 100%;
    }

    .media-right h5 {
      margin-bottom: 8px;
    }

    .media-right small {
      color: #666;
    }



    .custom-modal {
      position: fixed;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.5);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 10000;
    }
    .modal-content-custom {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
    }



    .label-container {
        display: flex;
        align-items: center;
        background: #f9f9f9;
        border: 0.15em solid #333;
        border-radius: 2em;
        box-shadow: 0 0.2em 0.6em rgba(0, 0, 0, 0.2);
        font-size: 1em; /* Responsive base size */
        max-width: 90vw; /* Prevent overflow on small screens */
    }

    .icon-circle {
        width: 2em;
        height: 2em;
        border-radius: 50%;
        background: white;
        border: 0.15em solid #333;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.6em;
        flex-shrink: 0;
    }

    .pin {
        width: 0.9em;
        height: 1em;
        background: red;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        position: relative;
    }

    .pin::after {
        content: '';
        position: absolute;
        top: 0.25em;
        left: 0.25em;
        width: 0.4em;
        height: 0.4em;
        background: white;
        border-radius: 50%;
    }

    .label-text {
        font-size: 1em;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #aiKesimpulan2{
          background: #fff3f3;
          border-radius: 5px;
    }







</style>  

<!-- Toggle Button -->
<button class="btn btn-warning toggle-btn" id="togglePanel">Informasi</button>
<button class="btn btn-primary toggle-detail-btn" id="toggleDetail">File & Media</button>
<button class="btn btn-success login-btn" id="LoginBtn">Login</button>

<div class="overlay-btn-info">
    <a href="#" onclick="toggleInfo()">
      <img src="assets/img/thinking.gif" id="loading-data" alt="Loading..." height="50" style="margin-top: 40px;">
    </a>
</div>

<div class="overlay-title-panel p-3" id="titlePanel">
  Artificial Intelligence - GIS
</div>

<!-- Panel Overlay dengan Tabs -->
<div class="overlay-panel p-3 overlay-hidden" id="infoPanel">
  <!-- Tabs -->
  <ul class="nav nav-tabs" id="panelTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="ai-tab" data-bs-toggle="tab" data-bs-target="#ai" type="button" role="tab">Tanya AI</button>
    </li>
    
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="draw-tab" data-bs-toggle="tab" data-bs-target="#draw" type="button" role="tab">Tambah Lokasi</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" id="layers-tab" data-bs-toggle="tab" data-bs-target="#layers" type="button" role="tab">Layer</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Fitur Lain</button>
    </li>
    
  </ul>

  <!-- Tab Content -->
  <div class="tab-content mt-3" id="panelTabsContent">
    <div class="tab-pane fade" id="draw" role="tabpanel">
      <div class="d-grid gap-2">
        <input class="form-control" type="text" placeholder="Nama Lokasi / Project" id="judul"/>
        <textarea class="form-control" placeholder="Keterangan/Informasi" id="description"></textarea>
        
        <div class="d-flex flex-wrap gap-1 justify-content-between mb-3">
          <button class="btn btn-outline-primary btn-sm" id="drawMarkerBtn" title="Marker">
            <i class="bi bi-geo-alt-fill"></i>
          </button>
          <button class="btn btn-outline-primary btn-sm" id="drawPolygonBtn" title="Polygon">
            <i class="bi bi-bounding-box-circles"></i>
          </button>
          <button class="btn btn-outline-primary btn-sm" id="drawPolylineBtn" title="Polyline">
            <i class="bi bi-dash-lg"></i>
          </button>
          <button class="btn btn-outline-primary btn-sm" id="drawRectangleBtn" title="Rectangle">
            <i class="bi bi-square-fill"></i>
          </button>
          <button class="btn btn-outline-primary btn-sm" id="drawCircleBtn" title="Circle">
            <i class="bi bi-circle-fill"></i>
          </button>

          <button class="btn btn-outline-secondary btn-sm" id="finishBtn" title="Selesai">
            <i class="bi bi-x-circle"></i>
          </button>
        </div>

      </div>
      <hr>

      <div class="d-grid gap-2">
        <div class="d-flex flex-wrap gap-1 justify-content-between mb-3">
            <button class="btn btn-outline-warning" id="editShapesBtn"><i class="bi bi-pencil-fill"></i> Edit</button>
            <button class="btn btn-outline-danger" id="deleteShapesBtn"><i class="bi bi-trash3"></i>Delete</button>
            <!-- <button class="btn btn-outline-primary" id="uploadBtn"><i class="bi bi-upload"></i> Upload</button> -->
            <button class="btn btn-outline-success" id="saveBtn" title="Simpan"><i class="bi bi-save-fill"></i> Simpan</button>
        </div>
      </div>

      <div class="d-grid gap-2 mt-3">
        
      <!-- <button class="btn btn-danger mt-2" id="clearAllBtn">🗑 Hapus Semua</button> -->
      </div>

      <!-- Tombol tambahan -->
      

    </div>
    <div class="tab-pane fade" id="layers" role="tabpanel">
      <label for="search"><b>Regional:</b></label>
      <select class="form-control " id="regional" onchange="load_shp(this.value)">
              <option value="">-- Pilih Regional --</option>
              <option value="REGIONAL 1">Regional 1</option>
              <option value="REGIONAL 2">Regional 2</option>
              <option value="REGIONAL 3">Regional 3</option>
              <option value="REGIONAL 4">Regional 4</option>
              <option value="REGIONAL 5D">Regional 5</option>
              <option value="REGIONAL 6">Regional 6</option>
              <option value="ALAS_HAK">DATA ALAS HAK</option>
              <option value="GARAPAN_PER_HGU">DATA GARAPAN</option>
              <!-- <option value="REGIONAL 7">Regional 7</option>
              <option value="REGIONAL 8/KEBUN TEBU">Regional 8</option> -->
        </select>
    </div>
    <div class="tab-pane fade" id="info" role="tabpanel">
          <label for="search"><b>Cuaca:</b></label>
          <select class="form-select" style="width: 100%;" id="selectWilayah" name="wilayah"></select>
          <input id="tambahan" class="form-control" type="text" placeholder="tanya cuaca ke AIGR1....."/>
          <button class="btn btn-success btn-sm" onclick="getDataCuaca()">Cari</button>
          <button class="btn btn-success btn-sm" id="btn-pahami" style="display: none;" onclick="ai_pahami()">pahami</button>
          <button class="btn btn-warning btn-sm" id="btn-res" onclick="markers.clearLayers()">Reset</button>
      <hr>
      <hr>
      <div>
         <label for="search"><b>Health Monitoring:</b></label>
          <select class="form-control" style="width: 250px;" id="regional" onchange="load_ndvi(this.value)">
                <option value="">-- Pilih Regional --</option>
                <option value="assets/ndvi/ndvi_reg1.tif">NDVI Regional 1</option>
                <option value="assets/ndvi/ndvi_reg2.tif">NDVI Regional 2</option>
                
          </select>
      </div>
    </div>



    <div class="tab-pane fade show active" id="ai" role="tabpanel">
        <!-- <div  style="overflow: scroll; min-height: 450px; background: white; display: flex; align-items: center; gap: 20px; justify-content: center; padding: 30px;">
            <pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;' id="aiKesimpulan"></pre>
        </div> -->
        <div  style="overflow: scroll; min-height: 450px; background: white;  align-items: center; gap: 20px; justify-content: center; ">
            <pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;' id="aiKesimpulan"></pre>
            <pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;' id="aiKesimpulan2"></pre>
        </div>
        <div style="margin-top: 10px;">
            <textarea placeholder="silahkan ketik pertanyaan atau klik mulai bicara?" class="form-control" id="pertanyaan-lanjutan"></textarea>
            <button class="btn btn-success" onclick="getData()">Tanya Saya</button>
            <button class="btn btn-primary"type="button" id="start">Mulai Bicara</button>
        </div>
        <i style="font-size: 12px;">contoh pertanyaan: <br>Tampilkan kerjasama di jember?</i>
    </div>
  </div>
</div>

<!-- MAP -->
<div id="map"></div>    


<div class="overlay-detail-panel p-3 overlay-detail-hidden" id="detailPanel">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Filter</h5>
    <div>
      <button class="btn btn-sm btn-primary me-2" onclick="openAddDataModal()">➕ Tambah Data</button>
      <button class="btn btn-sm btn-warning" onclick="openUploadMediaModal()">📤 Upload Media</button>
      <!-- <button class="btn btn-sm btn-success" onclick="openUploadMediaModal()">📤 Upload SHP/KML</button> -->
    </div>
  </div>

  <div class="d-flex mb-3">
    <input type="text" class="form-control form-control-sm me-2" placeholder="Cari data...">
    <button class="btn btn-success btn-sm">Cari</button>&nbsp
    <button class="btn btn-primary btn-sm"type="button" id="startDetail">Mulai Bicara</button>
  </div>
  
  <!-- SLIDER DENGAN PANAH -->
  <div class="info-slider-wrapper">
    <button class="slider-btn left" onclick="scrollSlider('left')">❮</button>

    <div class="info-slider" id="infoSlider">
      <!-- ITEM 1 -->
      <div class="info-item" onclick="handleMediaClick(
        'https://data.pu.go.id/sites/default/files/20200703_Infografis%20Banjir%20di%20Indonesia%202012-2019.png',
        'Foto Lapangan',
        'Kondisi lapangan saat siang hari.',
        '📍 Lokasi: Jalan Raya No.1<br>📅 Tanggal: 2024-03-01')">
        <img src="https://data.pu.go.id/sites/default/files/20200703_Infografis%20Banjir%20di%20Indonesia%202012-2019.png" alt="Thumb 1">
        <p>Judul Info 1</p>
      </div>

      <!-- ITEM 2 -->
      <div class="info-item" onclick="handleMediaClick(
        'https://pict.sindonews.net/size/960/salsabila/slider/2021/04/6834/hal-yang-dilakukan-ketika-terjadi-bencana-banjir-bandang-ial.jpg',
        'Foto Evakuasi',
        'Situasi evakuasi warga.',
        '📍 Lokasi: Sungai Besar<br>📅 Tanggal: 2024-03-02')">
        <img src="https://pict.sindonews.net/size/960/salsabila/slider/2021/04/6834/hal-yang-dilakukan-ketika-terjadi-bencana-banjir-bandang-ial.jpg" alt="Thumb 2">
        <p>Judul Info 2</p>
      </div>

      <!-- YOUTUBE -->
      <div class="info-item" onclick="handleMediaClick(
        'https://www.youtube.com/watch?v=kJwAjZutrgM',
        'Video Drone',
        'Perekaman udara kawasan proyek.',
        '📍 Lokasi: Area Timur<br>📅 Tanggal: 2024-03-02')">
        <img src="https://img.youtube.com/vi/kJwAjZutrgM/0.jpg" alt="Video Lokasi">
        <p>Video Lokasi</p>
      </div>
    </div>

 

</div>

<div id="mediaModal" class="zoom-modal" onclick="closeMediaModal()">
  <div class="media-modal-box" onclick="event.stopPropagation()">
    <div class="media-left">
      <img id="zoomedImg" src="" alt="Zoom" style="display: none;">
      <iframe id="zoomedVideo" frameborder="0" allowfullscreen style="display: none;"></iframe>
    </div>
    <div class="media-right">
      <h5 id="mediaTitle">Judul</h5>
      <p id="mediaDesc">Deskripsi informasi atau lokasi di sini...</p>
      <small id="mediaInfo">📍 Lokasi: - <br>📅 Tanggal: -</small>
    </div>
  </div>
</div>


<!-- Modal Tambah Data -->
<div id="addDataModal" class="custom-modal" onclick="closeCustomModal('addDataModal')">
  <div class="modal-content-custom" onclick="event.stopPropagation()">
    <h5>Tambah Data</h5>
    <input type="text" class="form-control mb-2" placeholder="Judul">
    <textarea class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <button class="btn btn-primary btn-sm">Simpan</button>
  </div>
</div>

<!-- Modal Upload Media -->
<div id="uploadMediaModal" class="custom-modal" onclick="closeCustomModal('uploadMediaModal')">
  <div class="modal-content-custom" onclick="event.stopPropagation()">
    <h5>Upload Media</h5>
    <div id="uppyContainer">
      <div class="my-3 border p-3 rounded" id="uploadDashboard"></div>
    </div>
    <!-- <button class="btn btn-secondary btn-sm mt-3" id="uploadBtn">🚀 Upload</button> -->
  </div>
</div>
        
    
<script src="https://unpkg.com/shpjs@latest/dist/shp.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>


<script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="https://releases.transloadit.com/uppy/v3.5.0/uppy.min.js"></script>
<script src="https://unpkg.com/georaster"></script>
<script src="https://unpkg.com/georaster-layer-for-leaflet"></script>

    <script>

        var map = L.map('map', {
          fullscreenControl: true
        }).setView([-2.5489, 118.0149], 5); // Pusat Indonesia

        // Google Hybrid (Satelit + Nama Jalan & Tempat)
        var googleHybrid = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps | \n Weather : BMKG'
        });

        // Google Maps Standard (Peta Jalan)
        var googleStreets = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps | \n Weather : BMKG'
        });

        // Esri Satelit + Nama Tempat & Batas Wilayah
        var esriSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; Map: Esri & Contributors | \n Weather : BMKG'
        });
        var esriLabels = L.tileLayer('https://services.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; Esri & Contributors | \n Weather : BMKG'
        });
        var satelliteWithLabels = L.layerGroup([esriSatellite, esriLabels]);

        // OpenStreetMap (Peta Jalan)
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors | \n Weather : BMKG'
        });

        satelliteWithLabels.addTo(map);

        var baseMaps = {
            "Google Hybrid (Satelit + Nama Jalan)": googleHybrid,
            "Google Maps (Jalan & Tempat)": googleStreets,
            "Esri Satelit + Nama Wilayah": satelliteWithLabels,
            "Peta Jalan (OSM)": osm,
            "Foto Udara (Drone)" : googleHybrid
        };

        L.control.layers(baseMaps).addTo(map);
        


        var markers = L.featureGroup();//L.markerClusterGroup();

        var marker_cuaca= '';//load_cuaca(info);

        </script>


        <script type="text/javascript">
          const toggleBtn = document.getElementById('togglePanel');
          const panel = document.getElementById('infoPanel');

          toggleBtn.addEventListener('click', () => {
            panel.classList.toggle('overlay-hidden');
          });


         const drawnItems = new L.FeatureGroup();
          map.addLayer(drawnItems);

          let activeDrawer = null;

          function clearActiveDrawer() {
            if (activeDrawer) {
              activeDrawer.disable();
              activeDrawer = null;
            }
          }

          // Handler umum untuk tombol draw
          function setupDrawButton(btnId, drawType) {
            document.getElementById(btnId).addEventListener('click', () => {
              clearActiveDrawer();

              const drawOptions = {
                marker: L.Draw.Marker,
                polygon: L.Draw.Polygon,
                polyline: L.Draw.Polyline,
                rectangle: L.Draw.Rectangle,
                circle: L.Draw.Circle
              };

              const DrawClass = drawOptions[drawType];

              if (DrawClass) {
                activeDrawer = new DrawClass(map);
                activeDrawer.enable();
              }
            });
          }

          // Setup semua tombol draw
          setupDrawButton('drawMarkerBtn', 'marker');
          setupDrawButton('drawPolygonBtn', 'polygon');
          setupDrawButton('drawPolylineBtn', 'polyline');
          setupDrawButton('drawRectangleBtn', 'rectangle');
          setupDrawButton('drawCircleBtn', 'circle');

          // Tangani hasil gambar
          map.on('draw:created', function (e) {
            drawnItems.addLayer(e.layer);
            clearActiveDrawer();
          });

           // map.on('draw:created', function (event) {
           //    const layer = event.layer;
           //    drawnItems.clearLayers();
           //    drawnItems.addLayer(layer);

           //    // 🟡 Zoom otomatis ke area yang diblok
           //    map.fitBounds(layer.getBounds());

           //    // 🔷 Konversi area ke GeoJSON
           //    const polygonGeoJSON = layer.toGeoJSON();

           //    // 🔢 Hitung marker di dalam area
           //    let count = 0;
           //    markers.forEach(marker => {
           //      const pt = turf.point([marker.getLatLng().lng, marker.getLatLng().lat]);
           //      if (turf.booleanPointInPolygon(pt, polygonGeoJSON)) {
           //        count++;
           //        marker.setIcon(L.icon({ iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png', iconSize: [25, 41], iconAnchor: [12, 41] }));
           //      } else {
           //        marker.setIcon(L.icon({ iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-red.png', iconSize: [25, 41], iconAnchor: [12, 41] }));
           //      }
           //    });

           //    alert(`Jumlah marker dalam area: ${count}`);
           //  });

          // // Hapus semua gambar
          // document.getElementById('clearAllBtn').addEventListener('click', () => {
          //   drawnItems.clearLayers();
          //   clearActiveDrawer();
          // });
          

          let editHandler = null;
          let deleteHandler = null;

          // Fungsi umum untuk mematikan mode apapun
          function clearAllModes() {
            if (activeDrawer) {
              activeDrawer.disable();
              activeDrawer = null;
            }
            if (editHandler) {
              editHandler.disable();
              editHandler = null;
            }
            if (deleteHandler) {
              deleteHandler.disable();
              deleteHandler = null;
            }
          }

          // Tombol Edit
          document.getElementById('editShapesBtn').addEventListener('click', () => {
            clearAllModes();
            editHandler = new L.EditToolbar.Edit(map, {
              featureGroup: drawnItems
            });
            editHandler.enable();
          });

          // Tombol Delete
          document.getElementById('deleteShapesBtn').addEventListener('click', () => {
            clearAllModes();
            deleteHandler = new L.EditToolbar.Delete(map, {
              featureGroup: drawnItems
            });
            deleteHandler.enable();
          });


          // Tombol Finish → hentikan mode menggambar tanpa menyimpan
          document.getElementById('finishBtn').addEventListener('click', () => {
            if (activeDrawer) {
              activeDrawer.disable();
              activeDrawer = null;
            }
            if (editHandler) editHandler.disable();
            if (deleteHandler) deleteHandler.disable();
          });

          // Tombol Save → ambil GeoJSON dan tampilkan di console
          document.getElementById('saveBtn').addEventListener('click', () => {
            const geojson = drawnItems.toGeoJSON();
            const geojsonStr = JSON.stringify(geojson, null, 2);
            //console.log("GeoJSON:", geojsonStr);
            //alert("Data tersimpan di console log!");

            var title = $("#judul").val() || "";
            var desc = $("#description").val() || "";
            var saveData = [];
            var data = [];

            saveData={title,
                      data: geojson,
                      desc: desc
                     };

            saveJSONToMysql(saveData);

          });

          function saveJSONToMysql(jsonData){
            console.log(jsonData);
            $.ajax({
                url: "map_ai/saveJson",
                type: "POST",
                data: { jsonData },
                success: function (response) {
                    alert('Data berhasil disimpan');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            }); 

                  
          }

        </script>




        <script type="text/javascript">
            const detailPanel = document.getElementById("detailPanel");
            const toggleDetailBtn = document.getElementById("toggleDetail");
            // Contoh fungsi untuk show/hide
            toggleDetailBtn.addEventListener('click', () => {
              detailPanel.classList.toggle('overlay-detail-hidden');
            });


            function showInfoDetail(id) {
              const detailBox = document.getElementById("infoDetail");
              // Contoh data dummy – bisa diganti API/AI
              const data = {
                1: "Ini adalah detail dari informasi 1. Bisa gambar besar, deskripsi, dsb.",
                2: "Detail info 2. Lokasi, waktu, data lainnya bisa masuk sini."
              };
              detailBox.innerHTML = `<p>${data[id]}</p>`;
            }

            function handleMediaClick(url, title = '', desc = '', info = '') {
              const modal = document.getElementById("mediaModal");
              const img = document.getElementById("zoomedImg");
              const video = document.getElementById("zoomedVideo");

              // Set info
              document.getElementById("mediaTitle").textContent = title;
              document.getElementById("mediaDesc").textContent = desc;
              document.getElementById("mediaInfo").innerHTML = info;

              // Reset all media
              img.style.display = "none";
              video.style.display = "none";
              img.src = '';
              video.src = '';

              // Tampilkan media sesuai jenis
              if (isYouTubeUrl(url)) {
                const videoId = getYouTubeVideoId(url);
                video.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                video.style.display = "block";
              } else {
                img.src = url;
                img.style.display = "block";
              }

              modal.style.display = "flex";
            }

            function isYouTubeUrl(url) {
              return url.includes("youtube.com") || url.includes("youtu.be");
            }

            function getYouTubeVideoId(url) {
              if (url.includes("youtube.com")) {
                return new URL(url).searchParams.get("v");
              } else {
                return url.split("/").pop();
              }
            }

            // Show image
            function zoomImage(src) {
              const modal = document.getElementById("mediaModal");
              document.getElementById("zoomedImg").src = src;
              document.getElementById("zoomedImg").style.display = "block";
              document.getElementById("zoomedVideo").style.display = "none";
              modal.style.display = "flex";
            }

            // Show YouTube
            function zoomYouTube(videoId) {
              const modal = document.getElementById("mediaModal");
              const videoFrame = document.getElementById("zoomedVideo");
              videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
              videoFrame.style.display = "block";
              document.getElementById("zoomedImg").style.display = "none";
              modal.style.display = "flex";
            }

            function closeMediaModal() {
              const modal = document.getElementById("mediaModal");
              document.getElementById("zoomedImg").src = "";
              document.getElementById("zoomedVideo").src = "";
              modal.style.display = "none";
            }

            function scrollSlider(direction) {
              const slider = document.getElementById("infoSlider");
              const scrollAmount = 200;
              if (direction === "left") {
                slider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
              } else {
                slider.scrollBy({ left: scrollAmount, behavior: "smooth" });
              }
            }


            function openAddDataModal() {
              document.getElementById('addDataModal').style.display = 'flex';
            }
            function openUploadMediaModal() {
              document.getElementById('uploadMediaModal').style.display = 'flex';
            }
            function closeCustomModal(id) {
              document.getElementById(id).style.display = 'none';
            }


            let uppy;

            //var uploadButton = document.getElementById('uploadBtn');
            var uppyDashboard = document.getElementById('uploadDashboard');

            document.addEventListener("DOMContentLoaded", () => {
              // Inisialisasi Uppy
              var uppy = new Uppy.Uppy({
                  restrictions: {
                      maxNumberOfFiles: 5,
                      allowedFileTypes: ['image/*', 'application/pdf']
                  }
              });

              uppy.use(Uppy.Dashboard, {
                target: '#uploadDashboard',
                inline: true,
                height: 250, 
                width:350,
                showProgressDetails: true,
              })

              // uppy.use(Uppy.Dashboard, {
              //     target: uppyDashboard,
              //     inline: true,
              //     proudlyDisplayPoweredByUppy: false
              // });

              uppy.use(Uppy.XHRUpload, {
                  endpoint: 'https://your-server.com/upload',
                  fieldName: 'files'
              });

              // Progress upload
              uppy.on('upload-progress', (file, progress) => {
                  console.log(`Progress ${file.name}: ${progress.bytesUploaded}/${progress.bytesTotal}`);
              });

             
               // Event tombol "Upload File"
              // uploadButton.addEventListener("click", function () {
              //     popupContainer.style.display = "block"; // Munculkan popup
              // });

              //Event tombol "Tutup"
              // closeButton.addEventListener("click", function () {
              //     popupContainer.style.display = "none"; // Sembunyikan popup
              // });

              //Event saat upload selesai
              uppy.on("complete", (result) => {
                  console.log("Upload selesai!", result.successful);
                  alert("File berhasil diunggah!");
                  popupContainer.style.display = "none"; // Tutup popup setelah upload
              });
            });

            // function startUpload() {
            //   uppy.upload();
            // }





        </script>




        <script>
        async function load_shp(lokasi){
          document.getElementById('loading-overlay').style.display = 'flex';


          var kebunColors = {};

          // Fungsi untuk menghasilkan warna acak dalam format HEX
          function getRandomColor() {
              return '#' + Math.floor(Math.random()*16777215).toString(16);
          }

          // Fungsi untuk mendapatkan atau menetapkan warna kebun
          function getColor(kebun) {
              if (!kebunColors[kebun]) {
                  kebunColors[kebun] = getRandomColor();
              }
              return kebunColors[kebun];
          }

          // Load SHP
            let boundsArray = [];
             try {
                let geojson = await shp("assets/shp/"+lokasi+".zip");
                let gjson = [];
                if ("type" in geojson) {
                    console.log("Key 'type' ada dalam geojson!");
                    gjson.push(geojson);
                    console.log(geojson);
                }else{
                    gjson = geojson;

                }

                gjson.forEach(function(json){
                    var color_kebun={};           
                    var layers = L.geoJSON(json, {
                        style: function(feature) {
                            var kebun = json.fileName;//feature.properties.KEBUN;
                            return {
                                color: getColor(kebun),
                                weight: 2,
                                fillOpacity: 0.1
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            if (feature.properties) {
                                var data_table = showDataJSON(feature.properties,json);
                                layer.on('click', function() {
                                    layer.bindPopup(`<ul>` + data_table + `</ul>`).openPopup(); // Menampilkan label permanen di atas marker;
                                });

                                layer.bindTooltip(data_table, { permanent: true, direction: "top", offset: [0, -10],className: "small-tooltip"})
                            }
                        }
                    }).addTo(map);

                    boundsArray.push(layers.getBounds());

                });

                setTimeout(() => {
                      document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);


                let targetBounds = boundsArray;
                setTimeout(() => {
                    map.flyToBounds(targetBounds, { duration: 2, easeLinearity: 0.2 });

                    setTimeout(() => {
                        let targetZoom = map.getBoundsZoom(targetBounds);
                        map.setZoom(targetZoom, { animate: true });
                    }, 2000); // Delay agar flyToBounds selesai dulu
                }, 1000); // Delay sebelum geser

          }catch (error) {
              console.error("Error loading SHP:", error);
          }
        }


        function showDataJSON(data,json='') {
            var list ='<li>'+json.fileName+`</li>`;
            for (let key in data) {
                let value = data[key];
                list+=`<li>${key}: <strong>${value}</strong>`;
            }

            return list;
        }

        </script>

        <script type="text/javascript">
            function load_ndvi(file_tiff=''){
                var url_to_geotiff_file = file_tiff;
                if(file_tiff=='ndvi_reg1.tif'){
                    load_shp('REGIONAL 1');
                }

                fetch(url_to_geotiff_file)
                  .then(response => response.arrayBuffer())
                  .then(arrayBuffer => {
                    parseGeoraster(arrayBuffer).then(georaster => {
                      console.log("georaster:", georaster);
                      var layers = new GeoRasterLayer({
                          georaster: georaster,
                          opacity: 1,
                          //pixelValuesToColorFn: values => values[0] > 100 ? '#ff0000' : '#0000ff',
                          resolution: 256,
                          zIndex: 10  // Pastikan ini lebih tinggi dari basemap

                      });
                      layer.addTo(map);
                      map.fitBounds(layer.getBounds());

                  });
                });
            }

        </script>

        <script type="text/javascript">
         $(document).ready(function() {
                $('#selectWilayah').select2({
                  ajax: {
                      url: '<?= base_url("Map_ai/getWilayah") ?>',
                      dataType: 'json', 
                      delay: 250, 
                      data: function(params) {
                        console.log
                          return {
                              search: params.term
                          };
                      },
                      processResults: function(data) {
                          return {
                              results: data.items
                          };
                      }
                  },
                  placeholder: "Pilih Wilayah",
              });

          });
      </script>



      <script>
         function getDataCuaca() {
          let reg = $("#regional").val();
          let wil = $("#selectWilayah").val();
          var tambahan = $("#tambahan").val();
          document.getElementById('loading-overlay').style.display = 'flex';
          $("#aiKesimpulan").html('.........');
          $.ajax({
              url: '<?= base_url("Map_ai/getCuaca") ?>', 
              type: "POST", 
              dataType: "json", 
              data: { 
                  regional: reg,
                  wilayah: wil,
                  tanya: tambahan
              },
              success: async function(response) {
                  try {

                      // console.log("Response:", response);
                      var data_cuaca = JSON.parse(response.cuaca);
                      
                      var filter_waktu = JSON.parse(response.waktu); 

                      console.log(filter_waktu);

                      load_cuaca(data_cuaca,filter_waktu);


                  } catch (error) {
                      console.error("Error parsing data:", error);
                  }

                  setTimeout(() => {
                      document.getElementById('loading-overlay').style.display = 'none';
                  }, 1500);
              },
              error: function(xhr, status, error) {
                  //console.error("Error: " + error); // Menangani error
                  //getDataCuaca();
                  setTimeout(() => {
                      document.getElementById('loading-overlay').style.display = 'none';
                  }, 1500);
              }
          });
      }


      document.getElementById('btn-res').addEventListener('click', function() {
          window.location.reload();
      });


      function cleanTime(obj) {
          if (Array.isArray(obj)) {
              return obj.map(cleanTime);
          } else if (typeof obj === "object" && obj !== null) {
              let newObj = {};
              for (let key in obj) {
                  if (!["utc_datetime", "analysis_date", "datetime"].includes(key)) {
                      newObj[key] = cleanTime(obj[key]);
                  }
              }
              return newObj;
          }
          return obj;
      }


      function load_cuaca(info,waktu){
          var data = info.data;
          var data_filtered =[];
          if (typeof waktu === "object" && Array.isArray(waktu)) {
            
            if(waktu[0].waktu_terdekat!==undefined){
              waktu = waktu = waktu[0].waktu_terdekat;
            }else{
              waktu = waktu[0].waktu;
            }
          }else{
            
            if(waktu.waktu_terdekat!==undefined){
              waktu = waktu.waktu_terdekat;
            }else{
              waktu = waktu.waktu;
            }
          }



          var i = 0;

          // Looping untuk menambahkan marker ke cluster
          markers.clearLayers();

          if(data.length>=1){
            data.forEach(function(item) {
                var customIcon={};
                var status = {};
                var local_time={};
                item.cuaca.forEach(function (cuaca){
                    var key = (item.lokasi?.desa ?? '')+"," +item.lokasi.kotkab+","+item.lokasi.provinsi;
                    cuaca.forEach(function (detail){
                                           //console.log(detail.local_datetime+"===="+waktu);
                           if(detail.local_datetime!=waktu)return;
                           data_filtered[key]=item;

                           customIcon[i] = L.icon({
                             iconUrl: detail.image, 
                             iconSize: [32, 32], 
                             iconAnchor: [16, 32], 
                             popupAnchor: [0, -32] 
                          });

                        status[i] = detail.weather_desc;
                        local_time[i] = detail.local_datetime;
                        //console.log("============");
                    });
                });

                if(Object.keys(status).length==0)return;

                var marker = L.marker([item.lokasi.lat, item.lokasi.lon], { icon: customIcon[i] })
                  // .bindPopup("<b>" + item.lokasi.desa + "</b><br>" + item.lokasi.kecamatan+","+item.lokasi.kotkab+","+item.lokasi.provinsi);
                  .bindPopup("<b>" + status[i] + "</b><br>" +(item.lokasi?.desa ?? '')+"," +item.lokasi.kotkab+","+item.lokasi.provinsi+"<br><span style='font-size:10px'>"+"("+local_time[i]+")</span>");
                markers.addLayer(marker);
                i++;
                //console.log("=======  "+i+"  ======");
                map.addLayer(markers);
            });
          }else{
                
          }

          if(i>0){
            var group = L.featureGroup(markers.getLayers());
            map.fitBounds(group.getBounds());
            return group;
          }else{
             alert('Maaf, data tidak tersedia.');
             return;
          }

          

          
        }
      </script>

      <script type="text/javascript">

        async function ai_cuaca(data_cuaca){
            var data = $('#tambahan').val();

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_cuaca") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data,cuaca:data_cuaca }
                });

                return response; // Mengembalikan hasil dari server

            } catch (error) {
                console.error("Error: ", error);
                return null; // Jika terjadi error, kembalikan null
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }

        async function ai_pahami(){
            var data = $('#tambahan').val();

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_pahami") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                return response; // Mengembalikan hasil dari server

            } catch (error) {
                console.error("Error: ", error);
                return null; // Jika terjadi error, kembalikan null
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }


        function getCurrentDateTime() {
          const now = new Date();
          
          const year = now.getFullYear();
          const month = String(now.getMonth() + 1).padStart(2, '0'); // Menambahkan 0 jika kurang dari 10
          const day = String(now.getDate()).padStart(2, '0');
          const hours = String(now.getHours()).padStart(2, '0');
          const minutes = String(now.getMinutes()).padStart(2, '0');
          const seconds = String(now.getSeconds()).padStart(2, '0');

          return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
      }


      function cleanJSON(jsonString) {
          try {
              // Menghapus karakter aneh seperti backticks (`) atau spasi ekstra
              jsonString = jsonString.replace(/```json|```/g, "").trim();
              jsonString = jsonString.replace(/'"'/g, "").trim();

              //Parsing JSON agar valid
              let jsonData = JSON.parse(jsonString);

              return jsonData;
          } catch (error) {
              console.error("Error parsing JSON:", error);
              return null;
          }
      }


      function toggleInfo() {
            //$(".overlay-info").toggle(); 
            $("#togglePanel").click();
        }
      
      </script>


    <script type="text/javascript">
        let typed;
        async function getData() {
            if (typed) {
                typed.destroy();  // Hancurkan instance sebelumnya
                typed = null;      // Pastikan instance benar-benar dihapus
            }
            // Ambil input dari elemen dengan ID #pertanyaan-lanjutan dan ubah ke huruf kecil
            let question = $('#pertanyaan-lanjutan').val().toLowerCase();

            // Deteksi kata kunci menggunakan NLP sederhana
            if (question.includes("tampilkan") || question.includes("dimana") || question.includes("lokasi")) {
                if (question.includes("kerjasama") || question.includes("kerja sama") || question.includes("aset")) {
                    return getDataInfo(); //table monika
                }else if(question.includes("alas hak") || question.includes("hgu") || question.includes("hgb") || question.includes("sertifikat") || question.includes("garapan")){  
                    await getAsetTanah(); //table map_aset_tanah
                    return getDataset(); //table dataset

                }else{
                    return getDataset(); //table dataset
                }
            }else{
                return getDataAi(); //source openai
            }



            // if (question.includes("kerjasama") || question.includes("kerja sama") || question.includes("aset")) {
            //     return getDataInfo();
            // } else if (question.includes("sop") || question.includes("laba") || question.includes("siapa")) {
            //     return getDataAi();
            // } else if(question.includes("pekerjaan") || question.includes("info")){
            //    await getAsetTanah();
            //    return getDataset();
            // }else if(question.includes("alas hak") || question.includes("hgu") || question.includes("hgb") || question.includes("sertifikat") || question.includes("garapan")){
            //   await getDataset();
            //   return getAsetTanah();
            // }else{
            //    return getDataAi();
            // }

            // else {
            //     return "Maaf, saya tidak memiliki data untuk pertanyaan ini.";
            // }
        }




          async function getDataInfo(){
            var data = $('#pertanyaan-lanjutan').val();
            $("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Menganalisa....</pre>");
            $("#aiKesimpulan2").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'></pre>");
            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_query") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                if (response && typeof response.response === 'string' && response.response.trim() !== '') {
                  typed = startTyping(response);
                } 
                

                var data_map = response['data_map'];
                if(response['data_map']) await load_gjson(data_map);
            } catch (error) {
                console.error("Error: ", error);
                //alert('Maaf, terjadi kesalahan, harap klik tanya lagi');
                getDataInfo();
                return null; 
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }


        async function getDataAi(){
            var data = $('#pertanyaan-lanjutan').val();
            $("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Menganalisa....</pre>");
            $("#aiKesimpulan2").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'></pre>");

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_jawab") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                if (response && typeof response.response === 'string' && response.response.trim() !== '')typed = startTyping(response);

            } catch (error) {
                console.error("Error: ", error);
                //alert('Maaf, terjadi kesalahan, harap klik tanya lagi');
                getDataAi();
                return null; // Jika terjadi error, kembalikan null
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }


        async function load_gjson(data){
          map.eachLayer(function(layer) {
            if (layer._isCustomGeo) {
              console.log(layer._isCustomGeo);
              map.removeLayer(layer);
            }
          });

          document.getElementById('loading-overlay').style.display = 'flex';

          var dataColors = {};

          // Fungsi untuk menghasilkan warna acak dalam format HEX
          function getRandomColor() {
              return '#' + Math.floor(Math.random()*16777215).toString(16);
          }

          // Fungsi untuk mendapatkan atau menetapkan warna data
          function getColor(id_color) {
              if (!dataColors[id_color]) {
                  dataColors[id_color] = getRandomColor();
              }
              return dataColors[data];
          }

          // Load GJSON          
            let boundsArray = [];
             try {
                // data.forEach(function(json){ 
                //     let gJson=jsonToGeojson(json.geojson);
                //     boundsArray.push(geoJsonToMap(gJson,json));
                // });

                if (typeof data === 'string') {
                    data = JSON.parse(data);
                }

                if (Array.isArray(data)) {
                    data.forEach(function(json){ 
                        let gJson=JSON.parse(json.geojson);
                        if(gJson.type!='FeatureCollection'){
                           gJson=jsonToGeojson(json.geojson);
                        };
                        boundsArray.push(geoJsonToMap(gJson,json));
                    });

                    setTimeout(() => {
                          document.getElementById('loading-overlay').style.display = 'none';
                    }, 1500);


                    let targetBounds = boundsArray;
                    setTimeout(() => {
                        map.flyToBounds(targetBounds, { duration: 2, easeLinearity: 0.2 });

                        setTimeout(() => {
                            let targetZoom = map.getBoundsZoom(targetBounds);
                            map.setZoom(targetZoom, { animate: true });
                        }, 2000); // Delay agar flyToBounds selesai dulu
                    }, 1000); // Delay sebelum geser
                }else{
                   console.log(data);
                   alert('Lokasi tidak ditemukan!');
                }

          }catch (error) {
              console.error("Error loading geojson:", error);
          }
        }

        function geoJsonToMap(gJson, json = "") {
            let firstPopupShown = false; // Biar hanya 1 popup otomatis
            const layers = L.geoJSON(gJson, {
              style: function (feature) {
                return {
                  color: "blue",
                  weight: 2,
                  fillColor: "lightblue",
                  fillOpacity: 0.5
                };
              },
              pointToLayer: function (feature, latlng) {
                              return L.circleMarker(latlng, {
                                radius: 5,
                                fillColor: "blue",
                                color: "white",
                                weight: 0.5,
                                opacity: 1,
                                fillOpacity: 0.8
                              });
                            },
              onEachFeature: function (feature, layer) {
                const data_table = json.label || "No label";

                // // Tooltip permanen
                // layer.bindTooltip(data_table, {
                //   permanent: true,
                //   direction: "top",
                //   offset: [0, -10],
                //   className: "small-tooltip"
                // });

                // Coba ambil posisi layer
                let center;
                if (layer.getBounds && typeof layer.getBounds === "function" && layer.getBounds().isValid()) {
                  center = layer.getBounds().getCenter();
                } else if (feature.geometry.type === "Point") {
                  const coords = feature.geometry.coordinates;
                  center = L.latLng(coords[1], coords[0]);
                }

                var customIcon = L.divIcon({
                                      className: '',
                                      html: `
                                          <div class="label-container">
                                              <div class="icon-circle">
                                                  <div class="pin"></div>
                                              </div>
                                              <div class="label-text">${data_table}</b></div>
                                          </div>
                                      `,
                                      iconSize: [160, 40],
                                      iconAnchor: [20, 40]
                                  });
                const marker = L.marker(center, { icon: customIcon }).addTo(map);//.bindPopup(`<b>${data_table}</b>`).openPopup();
                marker.on('click', () => {
                  showDetailInfo(json); // This `json` is correctly scoped
                });

                if (center) {

                  // Tampilkan popup
                  if (!firstPopupShown) {
                    map.setView(center, 13); // Fokus ke lokasi
                    firstPopupShown = true;
                  }
                } else {
                  // Kalau center nggak valid, fallback fitBounds
                  const tempLayer = L.geoJSON(feature).addTo(map);
                  if (!firstPopupShown) {
                    map.fitBounds(tempLayer.getBounds());
                    firstPopupShown = true;
                  }
                }

                layer._isCustomGeo = true;
              }
            }).addTo(map);

            return layers.getBounds(); // Bisa dipakai untuk fitBounds kalau perlu
          }


        function jsonToGeojson(data){
            data = JSON.parse(data);
            
            //data.forEach(item => console.log(item.type));
            var geojson = {
                  "type": "FeatureCollection",
                  "features": data.map(item => {
                    let geometry = {};

                    if (item.type === "Polygon") {
                      geometry = {
                        "type": "Polygon",
                        "coordinates": [
                          item.coordinates.map(coord => [
                            parseFloat(coord.longitude), // Longitude dulu
                            parseFloat(coord.latitude)  // Latitude setelahnya
                          ])
                        ]
                      };
                    } else if (item.type === "Point") {
                      geometry = {
                        "type": "Point",
                        "coordinates": [
                          parseFloat(item.coordinates.longitude), // Longitude
                          parseFloat(item.coordinates.latitude)  // Latitude
                        ]
                      };
                    } else if (item.type === "LineString") {
                      geometry = {
                        "type": "LineString",
                        "coordinates": item.coordinates.map(coord => [
                          parseFloat(coord.longitude),
                          parseFloat(coord.latitude)
                        ])
                      };
                    } else {
                      console.warn(`Tipe geometry ${item.type} tidak dikenali`);
                      return null; // Skip jika tipe tidak dikenali
                    }

                    return {
                      "type": "Feature",
                      "geometry": geometry,
                      "properties": item.properties || {} // Tambahkan properties jika ada
                    };
                  }).filter(feature => feature !== null) // Hapus yang null jika tipe tidak dikenali
                };


            return geojson;

        }

        function showDetailInfo(data){
          console.log(data);
          const detailPanel = document.getElementById("detailPanel");
          detailPanel.classList.toggle('overlay-detail-hidden');
        }


        function startTyping(response) {
            // Hapus Typed.js lama jika ada
            if (typed) {
                typed.destroy();  // Hancurkan instance sebelumnya
                typed = null;      // Pastikan instance benar-benar dihapus
            }

            // Kosongkan elemen sebelum mengetik ulang
            let target = document.querySelector('#aiKesimpulan');
            target.innerHTML = '';

          // Tunggu sebentar agar elemen benar-benar kosong sebelum Typed.js mulai
          setTimeout(() => {
            try {
                typed = new Typed('#aiKesimpulan', {
                  strings: [response['response']],
                  typeSpeed: 10,
                    loop: false,
                onComplete: (self) => {
                    self.cursor.remove(); // Hapus cursor setelah selesai mengetik
                    }
                });
            } catch (error) {
                console.error('Gagal inisialisasi Typed.js:', error);
            }
          }, 50);
    

        }


        function startTyping2(response) {
            // Hapus Typed.js lama jika ada
            // if (typed) {
            //     typed.destroy();  // Hancurkan instance sebelumnya
            //     typed = null;      // Pastikan instance benar-benar dihapus
            // }

            // Kosongkan elemen sebelum mengetik ulang
            let target = document.querySelector('#aiKesimpulan2');
            target.innerHTML = '';

            // Tunggu sebentar agar elemen benar-benar kosong sebelum Typed.js mulai
            // Tunggu sebentar agar elemen benar-benar kosong sebelum Typed.js mulai
          setTimeout(() => {
            try {
                typed = new Typed('#aiKesimpulan', {
                  strings: [response['response']],
                  typeSpeed: 10,
                    loop: false,
                onComplete: (self) => {
                    self.cursor.remove(); // Hapus cursor setelah selesai mengetik
                    }
                });
            } catch (error) {
                console.error('Gagal inisialisasi Typed.js:', error);
            }
          }, 50);
        }

      </script>


      <script>
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'id-ID';
            recognition.interimResults = false;
            recognition.continuous = false; 

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                const inputField = document.getElementById("pertanyaan-lanjutan");
                
                inputField.value = transcript;
                getData();
            };

            recognition.onspeechend = () => {
                recognition.stop(); 
            };

            recognition.onerror = (event) => {
                console.error("Kesalahan:", event.error);
            };

            document.getElementById("start").addEventListener("click", () => {
                const inputField = document.getElementById("pertanyaan-lanjutan");            
                $("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Silahkan Bicara....</pre>");
                $("#aiKesimpulan2").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'></pre>");

                 inputField.value = "";
                recognition.start();
            });
      </script>



      <script type="text/javascript">
        //AIRISA
        async function getDataset(){
            var data = $('#pertanyaan-lanjutan').val();
            //$("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Menganalisa....</pre>");
            $("#aiKesimpulan2").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'></pre>");

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_dataset") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                typed = startTyping2(response);

                var data_map = response['data_map'];
                if(response['data_map']) await load_gjson(data_map);
                //console.log(data_map);
            } catch (error) {
                console.error("Error: ", error);
                //alert('Maaf, terjadi kesalahan, harap klik tanya lagi');
                //getDataInfo();
                return null; 
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }
      </script>

      <script type="text/javascript">
        //AIRISA
        async function getAsetTanah(){
            var data = $('#pertanyaan-lanjutan').val();
            $("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Menganalisa....</pre>");
            $("#aiKesimpulan2").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'></pre>");

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Map_ai/ai_aset_tanah") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                //console.log(response);
                if (response.hasOwnProperty('error')) {
                  console.log(response);
                  alert('Maaf, terjadi gangguan system, mohon ulangi pertanyaannya!');
                }else{
                  typed = startTyping(response);
                }

                

                //var data_map = response['data_map'];
                //load_gjson(data_map);
                //console.log(data_map);
            } catch (error) {
                console.error("Error: ", error);
                //alert('Maaf, terjadi kesalahan, harap klik tanya lagi');
                getAsetTanah();
                return null; 
            } finally {
                setTimeout(() => {
                    document.getElementById('loading-overlay').style.display = 'none';
                }, 1500);
            }
        }
      </script>

    <!-- Leaflet Draw -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>  
    <script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>
    
    <!-- <script src="<?= base_url(); ?>/assets/js/airisa.js"></script> -->


</html>