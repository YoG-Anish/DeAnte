document.addEventListener('DOMContentLoaded', function () {
    const buttons  = document.querySelectorAll('.filter-btn');
    const grid     = document.querySelector('.case-studies-grid');
    const loadMore = document.querySelector('.load-more-btn');

    function setLoading(isLoading) {
        if (!loadMore) return;
        loadMore.classList.toggle('is-loading', isLoading);
        loadMore.disabled = isLoading;
    }

    function fetchCaseStudies(filter, page, append) {
        setLoading(true);

        fetch(caseStudyAjax.ajax_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'filter_case_studies',
                filter: filter,
                page: page,
                nonce: caseStudyAjax.nonce,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (append) {
                grid.insertAdjacentHTML('beforeend', data.html);
            } else {
                grid.innerHTML = data.html;
            }

            grid.dataset.page   = page;
            grid.dataset.filter = filter;

            if (loadMore) {
                loadMore.style.display = data.has_more ? 'inline-flex' : 'none';
            }

            setLoading(false);
        })
        .catch(() => {
            setLoading(false);
        });
    }

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            fetchCaseStudies(btn.dataset.filter, 1, false);
        });
    });

    if (loadMore) {
        loadMore.addEventListener('click', function () {
            const currentFilter = grid.dataset.filter || 'all';
            const nextPage      = parseInt(grid.dataset.page || '1') + 1;

            fetchCaseStudies(currentFilter, nextPage, true);
        });
    }
});