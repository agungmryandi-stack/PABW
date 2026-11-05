document.addEventListener('DOMContentLoaded', function () {
    const tabs   = document.querySelectorAll('#lbTabs .lb-tab');
    const rows   = document.querySelectorAll('#lbBody tr[data-status]');
    const cari   = document.getElementById('lbCari');
    const kosong = document.getElementById('lbKosong');
    const info   = document.getElementById('lbInfo');
    let filter = 'semua';

    function terapkan() {
        const q = cari.value.trim().toLowerCase();
        let tampil = 0;

        rows.forEach(function (r) {
            const cocokStatus = filter === 'semua' || r.dataset.status === filter;
            const cocokCari   = !q || r.dataset.cari.includes(q);
            const ok = cocokStatus && cocokCari;
            r.style.display = ok ? '' : 'none';
            if (ok) tampil++;
        });

        if (rows.length) kosong.style.display = tampil ? 'none' : '';
        info.textContent = 'Menampilkan ' + tampil + ' dari ' + rows.length + ' laporan';
    }

    tabs.forEach(function (t) {
        t.addEventListener('click', function () {
            tabs.forEach(function (x) { x.classList.remove('active'); });
            t.classList.add('active');
            filter = t.dataset.filter;
            terapkan();
        });
    });

    cari.addEventListener('input', terapkan);
});