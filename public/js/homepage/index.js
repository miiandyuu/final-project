const data = [
  {
    content : `
      <h2>Sistem Pendukung Keputusan</h2>
      <p>Sistem pendukung keputusan adalah suatu sistem informasi spesifik yang ditujukan untuk membantu manajemen dalam mengambil keputusan yang berkaitan dengan persoalan yang bersifat semi terstruktur. Sistem ini memiliki fasilitas untuk menghasilkan berbagai alternatif yang secara interaktif digunakan oleh pemakai.</p>
    `,
    image : 'images/homepage/content/spk-content.svg',
    alt : 'Logo Content SPK'
  },
  {
    content : `
      <h2>Metode SAW dan WP</h2>
      <p>Metode <i>Simple Additive Weigthing</i> (SAW) kerap disebut dengan istilah metode penjumlahan terbobot. Metode ini mempunyai konsep dasar mencari penjumlahan terbobot dari ranting kinerja disetiap alternative disemua atributnya.</p>
      <p>Metode <i>Weighted Product</i> (WP) adalah salah satu metode pengambilan keputusan untuk menyelesaikan suatu masalah dengan menggunakan perkalian untuk menghubungkan rating atribut, dimana rating setiap atribut harus dipangkatkan dulu dengan bobot atribut yang bersangkutan.</p>'
    `,
    image : 'images/homepage/content/method-content.svg',
    alt : 'Logo Content Metode'
  },
  {
    content : `
      <h2>Saham dan Saham Syari'ah</h2>
      <p>Saham adalah bukti atas bagian kepemilikan suatu perusahaan, yang artinya, jika kita memiliki saham perusahaan, berarti kira memiliki bagian atas kepemilikan perusahaan tersebut.</p>
      <p>Sedangkan, Saham Syari'ah merupakan efek berbentuk saham yang tidak bertentangan dengan prinsip syari’ah di Pasar Modal.</p>
    `,
    image : 'images/homepage/content/saham-content.svg',
    alt : 'Logo Content Saham'
  },
  {
    content : `
      <h2>Saham Syari'ah JII 70</h2>
      <p>Jakarta Islamic Index 70 (JII70 Index) adalah indeks Saham Syari'ah yang diluncurkan BEI pada tanggal 17 Mei 2018. Konstituen JII70 hanya terdiri dari 70 saham syariah paling likuid yang tercatat di BEI. Sama seperti ISSI, review saham syariah yang menjadi konstituen JII dilakukan sebanyak dua kali dalam setahun, Mei dan November, mengikuti jadwal review DES oleh OJK.</p>
    `,
    image : 'images/homepage/content/jii-content.svg',
    alt : 'Logo Content JII 70'
  },
];

function selectedMenu(key) {
  const BASE_URL = window.location.origin;
  const contentText = document.querySelector('.dynamic-content-text');
  const contentImage = document.querySelector('.dynamic-content-image');

  const selectedData = data[key];
  
  contentText.innerHTML = selectedData.content;
  contentImage.innerHTML = `<img src="${BASE_URL}/${selectedData.image}" alt="${selectedData.alt}" class="img-fluid">`;
}