
<script src="http://localhost/monica/assets/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="http://localhost/monica/assets/js/aigri.js"></script>

<!-- <script src="https://aset-dives-dev.ptpn1.co.id/weather/assets/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="https://aset-dives-dev.ptpn1.co.id/weather/assets/js/aigri.js"></script>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script> -->


<div id="loading-overlay">
    <div class="spinner"></div>
    <img src="assets/img/thinking.gif" id="loading-data" alt="Loading...">
    <p id="text-data">Baik, saya sedang mencari data anda....</p>
  </div>

  <div id="failed-overlay">
    <div class="spinner"></div>
    <p id="text-data">Maaf, Data tidak ditemukan....</p>
  </div>

<div class="overlay-info">
  <div  style="overflow: scroll; min-height: 450px; background: white; display: flex; align-items: center; gap: 20px; justify-content: center; padding: 30px;">
      <pre style='font-family: monospace; white-space: pre-wrap; word-wrap: break-word;' id="aiKesimpulan"></pre>
  </div>
  <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
      <textarea placeholder="Ada hal lain yang ingin anda tanyakan lagi?" class="form-control" id="pertanyaan-lanjutan"></textarea>
      <button class="btn btn-success btn-lg" onclick="getData()">Tanya Saya</button>
      <button type="button" id="start">Mulai Bicara</button>
  </div>
  <i>contoh pertanyaan: ada kerjasama apa saja di regional 1 dan sebutkan alamatnya?</i>
</div>
