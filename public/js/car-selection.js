/* ═══════════════════════════════════════════════════
   Wedriti – Commute Page  |  car-selection.js
════════════════════════════════════════════════════ */

(function () {
  'use strict';

  /* ─── Sort By Dropdown Toggle ─── */
  const sortBtn      = document.getElementById('sortBtn');
  const sortDropdown = document.getElementById('sortDropdown');

  if (sortBtn && sortDropdown) {
    /* Toggle open/closed on button click */
    sortBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      const isOpen = sortDropdown.classList.contains('is-open');
      toggleSortDropdown(!isOpen);
    });

    /* Close when clicking outside */
    document.addEventListener('click', function () {
      toggleSortDropdown(false);
    });

    /* Prevent clicks inside dropdown from closing it */
    sortDropdown.addEventListener('click', function (e) {
      e.stopPropagation();
    });

    /* Select an option */
    sortDropdown.querySelectorAll('.sort-option').forEach(function (opt) {
      opt.addEventListener('click', function () {
        /* Mark selected visually */
        sortDropdown.querySelectorAll('.sort-option').forEach(function (o) {
          o.style.fontWeight = '400';
          o.style.color = '';
        });
        this.style.fontWeight = '700';
        this.style.color = '#4B131F';

        /* Update button label */
        sortBtn.querySelector('span').textContent = this.textContent;

        toggleSortDropdown(false);
      });
    });

    function toggleSortDropdown(open) {
      sortDropdown.classList.toggle('is-open', open);
      sortBtn.setAttribute('aria-expanded', String(open));
    }
  }

  /* ─── Filter Panel: active-state highlight on checked items ─── */
  document.querySelectorAll('.filter-check input[type="checkbox"]').forEach(function (cb) {
    cb.addEventListener('change', function () {
      const label = this.closest('.filter-check');
      if (this.checked) {
        label.querySelector('.check-label').style.color = '#4B131F';
        label.querySelector('.check-label').style.fontWeight = '600';
        label.querySelector('.check-count').style.color = '#750D2B';
      } else {
        label.querySelector('.check-label').style.color = '';
        label.querySelector('.check-label').style.fontWeight = '';
        label.querySelector('.check-count').style.color = '';
      }
    });
  });

  /* ─── Trip Type Radio: subtle card animation on switch ─── */
  document.querySelectorAll('input[name="tripType"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
      /* Could be extended to show/hide relevant fields per trip type */
    });
  });

  /* ─── Swap Button: visually swap From and To field labels ─── */
  const swapBtn = document.querySelector('.swap-btn');
  if (swapBtn) {
    swapBtn.addEventListener('click', function () {
      const fields   = document.querySelectorAll('.search-row:first-of-type .search-field');
      const fromField = fields[0];
      const toField   = fields[1];
      if (!fromField || !toField) return;

      const fromSpan = fromField.querySelector('.field-placeholder');
      const toSpan   = toField.querySelector('.field-placeholder');

      /* Animate swap */
      fromSpan.style.transition = 'opacity 0.15s';
      toSpan.style.transition   = 'opacity 0.15s';
      fromSpan.style.opacity    = '0';
      toSpan.style.opacity      = '0';

      setTimeout(function () {
        const tmp        = fromSpan.textContent;
        fromSpan.textContent = toSpan.textContent;
        toSpan.textContent   = tmp;
        fromSpan.style.opacity = '1';
        toSpan.style.opacity   = '1';
      }, 150);

      /* Rotate the swap button icon as feedback */
      swapBtn.style.transition  = 'transform 0.3s';
      swapBtn.style.transform   = 'rotate(180deg)';
      setTimeout(function () {
        swapBtn.style.transform = 'rotate(0deg)';
      }, 300);
    });
  }

  /* ─── Select Button: highlight chosen card ─── */
  document.querySelectorAll('.select-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      /* Deselect all */
      document.querySelectorAll('.cab-card').forEach(function (card) {
        card.style.outline = '';
        card.querySelector('.select-btn').textContent = 'Select';
        card.querySelector('.select-btn').style.background = '';
        card.querySelector('.select-btn').style.color = '';
      });

      /* Select this one */
      const card = this.closest('.cab-card');
      card.style.outline = '2px solid #750D2B';
      this.textContent   = 'Selected ✓';
      this.style.background = '#750D2B';
      this.style.color      = '#FFFFFF';
    });
  });

})();
