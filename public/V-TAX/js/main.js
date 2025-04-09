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



//notif diajukan admin
fetch('/api/get-payment-diajukan')
    .then(response => response.json())
    .then(data => {
        // Contoh: tampilkan hasilnya di console
        console.log('Diajukan:', data.diajukan_am);

        // Atau tampilkan ke elemen HTML
        document.getElementById('diajukan-badge').textContent = data.diajukan_am;
    })
    .catch(error => {
        console.error('Gagal ambil data:', error);
    });


//notif ditolak am
fetch('/api/get-payment-ditolak-am')
    .then(response => response.json())
    .then(data => {
        // Contoh: tampilkan hasilnya di console
        console.log('Ditolak-am:', data.ditolak_am);

        // Atau tampilkan ke elemen HTML
        document.getElementById('Ditolak-am').textContent = data.ditolak_am;
    })
    .catch(error => {
        console.error('Gagal ambil data:', error);
    });






//script user wilayah



//
document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("form");
    let wilayahTable = document.getElementById("wilayahTable");
    let searchInput = document.getElementById("searchProvinsi");
    let searchContainer = document.getElementById("searchWilayahContainer");
    let provinsiDropdown = document.getElementById("kode_prov");
    let selectAllCheckbox = document.getElementById("selectAll");

    if (!wilayahTable || !searchContainer || !searchInput || !provinsiDropdown || !selectAllCheckbox) {
        console.error("Elemen yang dibutuhkan tidak ditemukan di halaman.");
        return;
    }

    let rows = wilayahTable.querySelectorAll("tr");


    // Sembunyikan input pencarian & tabel saat pertama kali dimuat
    searchContainer.style.display = "none";
    rows.forEach(row => row.style.display = "none");

    // Event untuk Select All
    selectAllCheckbox.addEventListener("change", function () {
        let visibleCheckboxes = wilayahTable.querySelectorAll('tr[style=""] .wilayah-checkbox');

        visibleCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    });

    // Tambahkan event click ke seluruh baris agar bisa diklik
    document.querySelectorAll('.clickable-row').forEach(row => {
        let checkbox = row.querySelector('input[type="checkbox"]');

        row.addEventListener("click", function (event) {
            if (event.target.closest('input[type="checkbox"]')) return;

            if (checkbox) {
                if (checkbox.checked) {
                    checkbox.checked = false;
                    let confirmUncheck = confirm("Apakah Anda yakin ingin menghapus wilayah ini?");
                    if (!confirmUncheck) {
                        checkbox.checked = true;
                    }
                } else {
                    checkbox.checked = true;
                }
            }
        });
    });

    // Event listener untuk setiap checkbox
    document.querySelectorAll('input[type="checkbox"].wilayah-checkbox').forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            if (!this.checked) {
                let confirmUncheck = confirm("Anda yakin ingin menghapus wilayah ini dari daftar?");
                if (!confirmUncheck) {
                    this.checked = true;
                }
            }

            // Update Select All checkbox status
            updateSelectAllState();
        });
    });

    // Fungsi untuk update status Select All
    function updateSelectAllState() {
        let visibleCheckboxes = wilayahTable.querySelectorAll('tr[style=""] .wilayah-checkbox');
        let checkedCheckboxes = wilayahTable.querySelectorAll('tr[style=""] .wilayah-checkbox:checked');

        selectAllCheckbox.checked = visibleCheckboxes.length > 0 && visibleCheckboxes.length === checkedCheckboxes.length;
    }

    // Saat form disubmit, hanya kirim perubahan
    form.addEventListener("submit", function () {
        let selectedNow = new Set();
        document.querySelectorAll('input[name="wilayah_id[]"]:checked').forEach(cb => {
            selectedNow.add(cb.value);
        });

        let hiddenContainer = document.createElement("div");
        hiddenContainer.style.display = "none";

        selectedNow.forEach(id => {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "wilayah_id[]";
            input.value = id;
            hiddenContainer.appendChild(input);
        });

        form.appendChild(hiddenContainer);
    });

    // Event listener saat provinsi dipilih
    provinsiDropdown.addEventListener("change", function () {
        let selectedKodeProv = this.value;

        rows.forEach(row => row.style.display = "none");
        searchContainer.style.display = "none";

        if (selectedKodeProv) {
            searchContainer.style.display = "block";

            rows.forEach(row => {
                if (row.getAttribute("data-kode-prov") === selectedKodeProv) {
                    row.style.display = "";
                }
            });

            searchInput.value = "";

            // Perbarui status Select All
            updateSelectAllState();
        }
    });

    // Event listener untuk pencarian wilayah
    searchInput.addEventListener("input", function () {
        let filter = this.value.toLowerCase();
        let selectedKodeProv = provinsiDropdown.value;

        if (!selectedKodeProv) {
            rows.forEach(row => row.style.display = "none");
            return;
        }

        rows.forEach(row => {
            let kodeProv = row.getAttribute("data-kode-prov");
            let namaWilayah = row.getAttribute("data-nama-wilayah")?.toLowerCase();

            if (kodeProv === selectedKodeProv && namaWilayah.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Perbarui status Select All
        updateSelectAllState();
    });
});



//script telepon
function onlyAllowNumbers(inputId, minLength = 10) {
    const input = document.getElementById(inputId);

    // Bikin elemen untuk peringatan panjang
    const warning = document.createElement('small');
    warning.classList.add('text-danger');
    warning.style.display = 'none';
    warning.innerText = `Nomor harus minimal ${minLength} digit.`;
    input.parentNode.appendChild(warning);

    input.addEventListener('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });

    input.addEventListener('input', function () {
        // Bersihkan karakter non-angka
        this.value = this.value.replace(/[^0-9]/g, '');

        // Tampilkan atau sembunyikan peringatan
        if (this.value.length > 0 && this.value.length < minLength) {
            warning.style.display = 'block';
        } else {
            warning.style.display = 'none';
        }
    });
}

// Terapkan ke semua input telepon
onlyAllowNumbers('telepon_payment_mitra');
onlyAllowNumbers('telepon_dinas');
onlyAllowNumbers('telepon_rekon_mitra');
