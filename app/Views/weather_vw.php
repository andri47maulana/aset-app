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


          <style>

            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                width: 100%;
                height: 100vh; /* Full viewport height */
            }
              
              #loading-overlay, #failed-overlay {
                  position: fixed;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background: rgba(0, 0, 0, 0.5);
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  color: white;
                  font-size: 18px;
                  z-index: 1000;
                  display: none; /* Awalnya tersembunyi */
              }



              .spinner {
                  border: 5px solid rgba(255, 255, 255, 0.3);
                  border-top: 5px solid white;
                  border-radius: 50%;
                  width: 40px;
                  height: 40px;
                  animation: spin 1s linear infinite;
                  margin-right: 10px;
              }

              @keyframes spin {
                  0% { transform: rotate(0deg); }
                  100% { transform: rotate(360deg); }
              }


              <style>
                /* Pastikan parent memiliki posisi relative */
                .map-container {
                    height: 1000px;
                    position: relative;
                    width: 100%;
                }

                /* Overlay input di atas peta */
                .overlay-container {
                    position: absolute;
                    bottom: 50px;
                    left: 20px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    width: 300px;
                }

                /* Overlay input di atas peta */
                .overlay-areal {
                    position: absolute;
                    top: 25px;
                    right: 85px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    width: 1000px;
                }

                .overlay-draw {
                    position: absolute;
                    top: 15px;
                    left: 60px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }


                /* Overlay input di atas peta */
                .overlay-info {
                    position: absolute;
                    top: 125px;
                    right: 85px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    width: 900px;
                    height: 600px;
                }

                .overlay-btn-info{
                    position: absolute;
                    top: 125px;
                    right: 85px;
                    z-index: 2000;
                    background: transparent;
                    width: 100px;
                    height: 100px;
                }

                /* Overlay input di atas peta */
                .overlay-container3 {
                    position: absolute;
                    bottom: 170px;
                    left: 30px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    width: 300px;
                    height: 50%;
                }

                /* Overlay input di atas peta */
                .overlay-kebun{
                    position: absolute;
                    top: 85px;
                    right: 85px;
                    z-index: 1000;
                    background: rgba(255, 255, 255, 0.5);
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    width: 250px;
                }

                .btn-waktu{
                   margin: 10px;
                }


                .small-tooltip {
                    font-size: 7px !important;  /* Ukuran font lebih kecil */
                    padding: 1px 3px; /* Sesuaikan padding */
                    background: transparent;
                    border:none;
                    color: white;
                    display: none;
                }
            </style>
          <style>
            .chat-icon {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease;
            }

            .chat-icon:hover {
                transform: scale(1.1);
            }

            .chat-messages {
              flex-grow: 1;
              overflow-y: auto;
              display: flex;
              flex-direction: column;
              gap: 10px;
            }


            .chat-icon-big {
                width: 300px;
                height: 300px;
                border-radius: 50%;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease;
            }


            .chat-content {
                font-size: 20px;
            }

            

          </style>
          <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
          <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
          <!-- Leaflet.markercluster CSS -->
          <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
          <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

          <!-- Leaflet.markercluster JS -->
          <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
          

          <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>




          <div id="loading-overlay">
            <div class="spinner"></div>
            <img src="assets/img/thinking.gif" class="chat-icon-big" id="loading-data" alt="Loading...">
            <p id="text-data">Baik, saya sedang mencari data anda....</p>
          </div>

          <div id="failed-overlay">
            <div class="spinner"></div>
            <!-- <img src="assets/img/failed.gif" id="loading-data" alt="Loading..."> -->
            <p id="text-data">Maaf, Data tidak ditemukan....</p>
          </div>



<?= $this->section('content'); ?>          


      <!--begin::App Main-->
      <main class="app-main">
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-12">
                <div class="">
                  
                  <div class="">
                    <!-- Elemen Overlay -->
                    
                    <div class="d-flex">
                     
                      <div class="overlay-areal">
                          <div style="display: flex; align-items: center; gap: 10px;">
                              <label for="search"><b>Lokasi:</b></label>
                              <select class="form-control" style="width: 250px;" id="regional" onchange="load_shp(this.value)">
                                  <option value="">-- Pilih Regional --</option>
                                  <option value="REGIONAL 1">Regional 1</option>
                                  <option value="REGIONAL 2">Regional 2</option>
                                  <option value="REGIONAL 3">Regional 3</option>
                                  <option value="REGIONAL 4">Regional 4</option>
                                  <option value="REGIONAL 5D">Regional 5</option>
                                  <option value="REGIONAL 6">Regional 6</option>
                                  <!-- <option value="REGIONAL 7">Regional 7</option>
                                  <option value="REGIONAL 8/KEBUN TEBU">Regional 8</option> -->
                              </select>
                              <select class="form-control" id="selectWilayah" name="wilayah" class="form-control" style="max-width: 500px;"></select>
                              <input id="tambahan" style="width: 400px;" type="text" placeholder="tanya cuaca ke AIGR1....."/>
                              <button class="btn btn-success btn-sm" onclick="getDataMap()">Cari</button>
                              <button class="btn btn-success btn-sm" id="btn-pahami" style="display: none;" onclick="ai_pahami()">pahami</button>
                              <button class="btn btn-warning btn-sm" id="btn-res" onclick="markers.clearLayers()">Reset</button>
                          </div>
                      </div>


                      <div class="overlay-btn-info">
                          <a href="#" onclick="toggleInfo()">
                            <img src="assets/img/thinking.gif" class="chat-icon" id="loading-data" alt="Loading..." height="100">
                          </a>
                      </div>

                      <div class="overlay-info" style="display:none">
                          <div  style="overflow: scroll; height: 450px; background: white; align-items: center; gap: 20px; justify-content: center; padding: 30px;">
                            <div class="chat-messages">
                              <pre style='font-family: monospace; font-size:15px; white-space: pre-wrap; word-wrap: break-word;' id="aiKesimpulan"></pre>
                            </div>
                          </div>
                          <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                              <textarea placeholder="Ada hal lain yang ingin anda tanyakan lagi?" class="form-control" id="pertanyaan-lanjutan"></textarea>
                              <button class="btn btn-success btn-lg" onclick="getData()">Tanya Saya</button>
                              <button type="button" id="start">Mulai Bicara</button>
                          </div>
                          <i>contoh pertanyaan: ada kerjasama apa saja di regional 1 dan sebutkan alamatnya?</i>
                      </div>

                      <!-- <div class="overlay-kebun">
                          <table>
                                <tr>
                                    <th>Kebun</th>
                                </tr>
                          </table>
                      </div> -->

                      <div class="overlay-container" style="display:none">
                          <div style="text-align: center;">
                              <b><?= date("d-m-Y")?> </b>
                              <select class="center">
                                  <option value="">06:00</option>
                                  <option value="">07:00</option>
                                  <option value="">08:00</option>
                              </select>
                          </div>
                          <div style="text-align: center;">
                              <button class="btn btn-success btn-waktu btn-sm" id="btn-hari-ini">Hari Ini</button>
                              <button class="btn btn-default btn-waktu btn-sm" id="btn-besok"><b>Besok</b></button>
                              <button class="btn btn-default btn-waktu btn-sm" id="btn-lusa"><b>Lusa</b></button>
                          </div>
                      </div>
                      <div class="overlay-draw">
                        <label for="search"><b>Health Monitoring:</b></label>
                        <select class="form-control" style="width: 250px;" id="regional" onchange="load_ndvi(this.value)">
                              <option value="">-- Pilih Regional --</option>
                              <option value="assets/ndvi/ndvi_reg1.tif">NDVI Regional 1</option>
                              <option value="assets/ndvi/ndvi_reg2.tif">NDVI Regional 2</option>
                              <option value="assets/ndvi/NDVI_REG3.tif">NDVI Regional 3</option>
                              <option value="assets/ndvi/NDVI_REG4.tif">NDVI Regional 4</option>
                              <option value="assets/ndvi/NDVI_REG5.tif">NDVI Regional 5</option>
                        </select>
                        <pre id="output"></pre>
                      </div>


                      <div class="position-relative" id="map" style="width: 100%;"></div>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex flex-row justify-content-end">
                      
                    </div>
                  </div>
                </div>
              </div>
              

            <!--end::Row-->
          </div>
          <!--end::Container-->
        
    
    <script src="https://unpkg.com/shpjs@latest/dist/shp.js"></script>
    <script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>


    <script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="https://releases.transloadit.com/uppy/v3.5.0/uppy.min.js"></script>
    <script src="https://unpkg.com/georaster"></script>
    <script src="https://unpkg.com/georaster-layer-for-leaflet"></script>

    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5); // Pusat Indonesia

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
                    var layer = L.geoJSON(json, {
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

                    boundsArray.push(layer.getBounds());

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
                      var layer = new GeoRasterLayer({
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
                      url: '<?= base_url("Weather/getWilayah") ?>',
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
         function getDataMap() {
          let reg = $("#regional").val();
          let wil = $("#selectWilayah").val();
          var tambahan = $("#tambahan").val();
          document.getElementById('loading-overlay').style.display = 'flex';
          $("#aiKesimpulan").html('.........');
          $.ajax({
              url: '<?= base_url("Weather/getCuaca") ?>', 
              type: "POST", 
              dataType: "json", 
              data: { 
                  regional: reg,
                  wilayah: wil
              },
              success: async function(response) {
                  try {
                      
                      var data_cuaca = JSON.parse(response.info);
                      //console.log("Data cuaca:", data_cuaca);

                      var filter_waktu = await ai_pahami(); // Menunggu hasil dari ai_pahami()
                      console.log("Filter waktu:", filter_waktu);

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
                  getDataMap();
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

        async function ai_pahami(){
            var data = $('#tambahan').val();

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Weather/ai_pahami") ?>', // Endpoint server
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
            $(".overlay-info").toggle(); 
        }
      
      </script>


    <script type="text/javascript">
        let typed;
        function getData() {
            // Ambil input dari elemen dengan ID #pertanyaan-lanjutan dan ubah ke huruf kecil
            let question = $('#pertanyaan-lanjutan').val().toLowerCase();

            // Deteksi kata kunci menggunakan NLP sederhana
            if (question.includes("kerjasama") || question.includes("kerja sama") || question.includes("aset")) {
                return getDataInfo();
            } else {
                return getDataAi();
            } 

            // else {
            //     return "Maaf, saya tidak memiliki data untuk pertanyaan ini.";
            // }
        }




          async function getDataInfo(){
            var data = $('#pertanyaan-lanjutan').val();
            $("#aiKesimpulan").html("<pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;'>Menganalisa....</pre>");

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Weather/ai_query") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                typed = startTyping(response);

                var data_map = response['data_map'];
                load_gjson(data_map);
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

            // Tampilkan loading overlay sebelum mengirim permintaan
            document.getElementById('loading-overlay').style.display = 'block';

            try {
                let response = await $.ajax({
                    url: '<?= base_url("Weather/ai_jawab") ?>', // Endpoint server
                    type: "POST",
                    dataType: "json",
                    data: { tanya: data }
                });

                
                typed = startTyping(response);

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



        function load_gjson(data){
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
                data.forEach(function(json){ 
                    let gJson=jsonToGeojson(json.geojson);  
                    console.log(gJson);
                    var color_data={};           
                    var layer = L.geoJSON(gJson, {
                        style: function(feature) {
                            var id_color = 1;//json.fileName;//feature.properties.data;
                            return {
                                  color: "blue",
                                  weight: 2,
                                  fillColor: "lightblue",
                                  fillOpacity: 0.5
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            //console.log(feature);
                            //console.log(json);
                            if (feature.properties) {
                                var data_table = json.label;//showDataJSON(feature.properties,json);
                                layer.on('click', function() {
                                    layer.bindPopup(`<ul>` + data_table + `</ul>`).openPopup(); // Menampilkan label permanen di atas marker;
                                });

                                layer.bindTooltip(data_table, { permanent: true, direction: "top", offset: [0, -10],className: "small-tooltip"});
                                L.marker(layer.getBounds().getCenter()).addTo(map).bindPopup("<b>" + data_table + "</b>");
                            }
                        }
                    }).addTo(map);

                    boundsArray.push(layer.getBounds());

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
              console.error("Error loading geojson:", error);
          }
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
                typed = new Typed('#aiKesimpulan', {
                    strings: [response['response']],
                    typeSpeed: 10,
                    loop: false,
                    onComplete: (self) => {
                        self.cursor.remove(); // Hapus cursor setelah selesai mengetik
                    }
                });
            }, 50); // Delay 50ms untuk memastikan elemen kosong
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
                 inputField.value = "";
                recognition.start();
            });
      </script>

    <!-- Leaflet Draw -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>      
    <!-- <script src="<?= base_url(); ?>/assets/js/airisa.js"></script> -->


</html>