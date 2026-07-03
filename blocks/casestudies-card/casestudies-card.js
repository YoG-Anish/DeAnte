document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-btn');
    const grid    = document.querySelector('.case-studies-grid');

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            fetch(caseStudyAjax.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'filter_case_studies',
                    filter: btn.dataset.filter,
                }),
            })
            .then(response => response.text())
            .then(html => {
                grid.innerHTML = html;
            });
        });
    });
});