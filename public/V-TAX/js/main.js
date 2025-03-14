/**
* Template Name: NiceAdmin
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Updated: Apr 20 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener))
        } else {
            select(el, all).addEventListener(type, listener)
        }
    }

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function (e) {
            select('body').classList.toggle('toggle-sidebar')
        })
    }

    /**
     * Search bar toggle
     */
    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function (e) {
            select('.search-bar').classList.toggle('search-bar-show')
        })
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled')
            } else {
                selectHeader.classList.remove('header-scrolled')
            }
        }
        window.addEventListener('load', headerScrolled)
        onscroll(document, headerScrolled)
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    /**
     * Initiate quill editors
     */
    if (select('.quill-editor-default')) {
        new Quill('.quill-editor-default', {
            theme: 'snow'
        });
    }

    if (select('.quill-editor-bubble')) {
        new Quill('.quill-editor-bubble', {
            theme: 'bubble'
        });
    }

    if (select('.quill-editor-full')) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                        color: []
                    },
                    {
                        background: []
                    }
                    ],
                    [{
                        script: "super"
                    },
                    {
                        script: "sub"
                    }
                    ],
                    [{
                        list: "ordered"
                    },
                    {
                        list: "bullet"
                    },
                    {
                        indent: "-1"
                    },
                    {
                        indent: "+1"
                    }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        });
    }

    /**
     * Initiate TinyMCE Editor
     */

    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

    tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
        editimage_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
        ],
        image_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
        ],
        image_class_list: [{
            title: 'None',
            value: ''
        },
        {
            title: 'Some class',
            value: 'class-name'
        }
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                    text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                    alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                    source2: 'alt.ogg',
                    poster: 'https://www.google.com/logos/google.jpg'
                });
            }
        },
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(needsValidation)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    /**
     * Initiate Datatables
     */
    const datatables = document.querySelectorAll('.datatable');

    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable, {
            searchable: true, // Pastikan pencarian aktif
            fixedHeight: true, // Memastikan search tetap bekerja meski datanya sedikit
            perPage: 5, // Bisa diubah sesuai kebutuhan
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [
                {
                    select: 2,
                    sortSequence: ["desc", "asc"]
                },
                {
                    select: 3,
                    sortSequence: ["desc"]
                },
                {
                    select: 4,
                    cellClass: "green",
                    headerClass: "red"
                }
            ]
        });
    });










    /**
     * Autoresize echart charts
     */
    const mainContainer = select('#main');
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select('.echart', true).forEach(getEchart => {
                    echarts.getInstanceByDom(getEchart).resize();
                })
            }).observe(mainContainer);
        }, 200);
    }

})();



// Fungsi untuk mengambil data dari API Admin
function fetchAdminPaymentCounts() {
    fetch('/api/get-payment-admin', {
        headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') } // Jika menggunakan token
    })
        .then(response => {
            if (!response.ok) throw new Error('Gagal mengambil data');
            return response.json();
        })
        .then(data => {
            // Update elemen dengan ID masing-masing
            document.getElementById("ditolak_feead").innerText = data.ditolak_feead;
            document.getElementById("diterima_feead").innerText = data.diterima_feead;
            document.getElementById("belum_divalidasifeead").innerText = data.belum_divalidasifeead;
            document.getElementById("ditolak_nofeead").innerText = data.ditolak_nofeead;
            document.getElementById("diterima_nofeead").innerText = data.diterima_nofeead;
            document.getElementById("belum_divalidasinofeead").innerText = data.belum_divalidasinofeead;
        })
        .catch(error => console.error('Error:', error));
}

// Jalankan saat halaman dimuat
document.addEventListener("DOMContentLoaded", fetchAdminPaymentCounts);

// Periksa perubahan setiap 5 detik
setInterval(fetchAdminPaymentCounts, 5000);

// end admin span id








//notif am
// Fungsi untuk mengambil data notifikasi dari API
function fetchPaymentCounts() {
    fetch('/api/get-payment-im') // Panggil API baru
        .then(response => response.json())
        .then(data => {
            // Perbarui elemen notifikasi berdasarkan ID
            document.getElementById("nott-ditolak").innerText = data.ditolak_feeam;
            document.getElementById("nott-belumvalidasi").innerText = data.belum_divalidasifeeam;
            document.getElementById("nott-diterima").innerText = data.diterima_feeam;
        })
        .catch(error => console.error('Error:', error));
}

// Jalankan saat halaman dimuat
document.addEventListener("DOMContentLoaded", fetchPaymentCounts);

// Periksa perubahan setiap 5 detik
setInterval(fetchPaymentCounts, 5000);


//nofeeadmin
// Fungsi untuk mengambil data notifikasi dari API
function fetchPaymentCount() {
    fetch('/api/get-payment-am') // Panggil API baru
        .then(response => response.json())
        .then(data => {
            // Perbarui elemen notifikasi berdasarkan ID
            document.getElementById("noti-ditolak").innerText = data.ditolak_nofeeam;
            document.getElementById("noti-belumvalidasi").innerText = data.belum_divalidasinofeeam;
            document.getElementById("noti-diterima").innerText = data.diterima_nofeeam;
        })
        .catch(error => console.error('Error:', error));
}

// Jalankan saat halaman dimuat
document.addEventListener("DOMContentLoaded", fetchPaymentCount);

// Periksa perubahan setiap 5 detik
setInterval(fetchPaymentCount, 5000);





//script check userwilayah
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("form");
    let initialSelected = new Set();

    // Simpan wilayah yang sudah tercentang saat halaman dimuat
    document.querySelectorAll('input[name="wilayah_id[]"]:checked').forEach(cb => {
        initialSelected.add(cb.value);
    });

    
    // Tambahkan event click ke seluruh baris agar bisa diklik
    document.querySelectorAll('.clickable-row').forEach(row => {
        let checkbox = row.querySelector('input[type="checkbox"]');

        // Simpan status awal checkbox
        if (checkbox) {
            checkbox.dataset.initialChecked = checkbox.checked;
        }

        row.addEventListener("click", function (event) {
            if (!event.target.matches('input[type="checkbox"]')) {
                let checkbox = this.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    // Jika ingin menghapus (uncheck) data lama, tampilkan peringatan
                    if (!checkbox.checked && !confirm("Apakah Anda yakin ingin menghapus wilayah ini?")) {
                        return;
                    }

                    // Jika ingin menghapus centang dari data yang sebelumnya sudah tercentang, beri peringatan
                    if (checkbox.dataset.initialChecked === "true" && checkbox.checked) {
                        if (!confirm("Apakah Anda yakin ingin menghapus data yang sebelumnya sudah dicentang?")) {
                            return;
                        }
                    }

                    // Toggle checkbox
                    checkbox.checked = !checkbox.checked;

                    // Update status awal setelah perubahan
                    checkbox.dataset.initialChecked = checkbox.checked;
                }
            }
        });
    });



    // Saat form disubmit, hanya kirim perubahan
    form.addEventListener("submit", function (event) {
        let selectedNow = new Set();
        document.querySelectorAll('input[name="wilayah_id[]"]:checked').forEach(cb => {
            selectedNow.add(cb.value);
        });

        let toAdd = [...selectedNow].filter(id => !initialSelected.has(id));
        let toRemove = [...initialSelected].filter(id => !selectedNow.has(id));

        // Hapus semua input hidden sebelumnya
        document.querySelectorAll('.hidden-wilayah').forEach(input => input.remove());

        let hiddenContainer = document.createElement("div");
        hiddenContainer.style.display = "none";

        // Simpan wilayah yang masih dipilih
        selectedNow.forEach(id => {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "wilayah_id[]";
            input.value = id;
            input.classList.add("hidden-wilayah");
            hiddenContainer.appendChild(input);
        });

        form.appendChild(hiddenContainer);
    });
});


//script search wilayah $ provinsi serta dropdown provinsi

// Simpan daftar kode provinsi dari dropdown sebagai referensi pencarian
let provinsiOptions = {};
document.querySelectorAll('#kode_prov option').forEach(option => {
    if (option.value) { // Hindari opsi "Semua Provinsi"
        provinsiOptions[option.textContent.toLowerCase()] = option.value;
    }
});

// Filter berdasarkan dropdown Provinsi
document.getElementById('kode_prov').addEventListener('change', function () {
    let selectedKodeProv = this.value;
    let rows = document.querySelectorAll('#wilayahTable tr');

    rows.forEach(row => {
        let kodeProv = row.getAttribute('data-kode-prov');
        row.style.display = (selectedKodeProv === "" || kodeProv === selectedKodeProv) ? "" :
            "none";
    });

    // Kosongkan input pencarian saat dropdown dipilih
    document.getElementById('searchProvinsi').value = "";
});

// Filter berdasarkan input pencarian (Provinsi atau Wilayah)
document.getElementById('searchProvinsi').addEventListener('input', function () {
    let filter = this.value.toLowerCase();
    let matchedKodeProv = [];

    // Cari di dropdown provinsi, cocokkan teks dengan input
    Object.keys(provinsiOptions).forEach(nama_provinsi => {
        if (nama_provinsi.includes(filter)) {
            matchedKodeProv.push(provinsiOptions[nama_provinsi]); // Simpan kode_prov yang cocok
        }
    });

    let rows = document.querySelectorAll('#wilayahTable tr');

    rows.forEach(row => {
        let kodeProv = row.getAttribute('data-kode-prov');
        let namaWilayah = row.getAttribute('data-nama-wilayah');

        // Tampilkan jika kode_prov cocok atau nama wilayah cocok
        let matchProvinsi = matchedKodeProv.includes(kodeProv);
        let matchWilayah = namaWilayah.includes(filter);

        row.style.display = (matchProvinsi || matchWilayah || filter === "") ? "" : "none";
    });

    // Reset dropdown provinsi agar tidak mengganggu pencarian
    document.getElementById('kode_prov').value = "";
});
